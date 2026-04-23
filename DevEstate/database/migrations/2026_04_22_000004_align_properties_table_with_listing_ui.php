<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        $driver = Schema::getConnection()->getDriverName();
        $hasLegacyImagePath = Schema::hasColumn('properties', 'image_path');
        $hasLegacyBedrooms = Schema::hasColumn('properties', 'bedrooms');
        $hasLegacyBathrooms = Schema::hasColumn('properties', 'bathrooms');
        $hasLegacyParkingSpaces = Schema::hasColumn('properties', 'parking_spaces');
        $hasLegacyFloorArea = Schema::hasColumn('properties', 'floor_area');
        $hasLegacyLotArea = Schema::hasColumn('properties', 'lot_area');
        $hasLegacyLocation = Schema::hasColumn('properties', 'location');
        $hasLegacyPropertyType = Schema::hasColumn('properties', 'property_type');
        $hasUserId = Schema::hasColumn('properties', 'user_id');

        Schema::table('properties', function (Blueprint $table) {
            if (!Schema::hasColumn('properties', 'image')) {
                $table->string('image')->nullable()->after('slug');
            }

            if (!Schema::hasColumn('properties', 'summary')) {
                $table->text('summary')->nullable()->after('price');
            }

            if (!Schema::hasColumn('properties', 'tags')) {
                $table->json('tags')->nullable()->after('summary');
            }

            if (!Schema::hasColumn('properties', 'details')) {
                $table->json('details')->nullable()->after('tags');
            }
        });

        if ($driver !== 'sqlite') {
            DB::statement("ALTER TABLE properties MODIFY price VARCHAR(255) NOT NULL");
        }

        $firstUserId = DB::table('users')->orderBy('id')->value('id');

        DB::table('properties')
            ->orderBy('id')
            ->chunkById(100, function ($properties) use (
                $firstUserId,
                $hasLegacyImagePath,
                $hasLegacyBedrooms,
                $hasLegacyBathrooms,
                $hasLegacyParkingSpaces,
                $hasLegacyFloorArea,
                $hasLegacyLotArea,
                $hasLegacyLocation,
                $hasLegacyPropertyType,
                $hasUserId
            ) {
                foreach ($properties as $property) {
                    $tags = [];

                    if (!empty($property->tags)) {
                        $decodedTags = json_decode($property->tags, true);

                        if (is_array($decodedTags)) {
                            $tags = $decodedTags;
                        }
                    }

                    if (empty($tags)) {
                        if ($hasLegacyBedrooms && !empty($property->bedrooms)) {
                            $tags[] = $property->bedrooms . ' Bed' . ((int) $property->bedrooms === 1 ? '' : 's');
                        }

                        if ($hasLegacyBathrooms && !empty($property->bathrooms)) {
                            $tags[] = $property->bathrooms . ' Bath' . ((int) $property->bathrooms === 1 ? '' : 's');
                        }

                        if ($hasLegacyParkingSpaces && !empty($property->parking_spaces)) {
                            $tags[] = $property->parking_spaces . ' Parking';
                        }
                    }

                    $details = [];

                    if (!empty($property->details)) {
                        $decodedDetails = json_decode($property->details, true);

                        if (is_array($decodedDetails)) {
                            $details = $decodedDetails;
                        }
                    }

                    if (empty($details)) {
                        $details = array_values(array_filter([
                            $hasLegacyFloorArea && !empty($property->floor_area) ? ['label' => 'Floor Area', 'value' => $property->floor_area . ' sqm'] : null,
                            $hasLegacyLotArea && !empty($property->lot_area) ? ['label' => 'Lot Area', 'value' => $property->lot_area . ' sqm'] : null,
                            $hasLegacyLocation && !empty($property->location) ? ['label' => 'Location', 'value' => $property->location] : null,
                            $hasLegacyPropertyType && !empty($property->property_type) ? ['label' => 'Style', 'value' => $property->property_type] : null,
                        ]));
                    }

                    $numericPrice = preg_replace('/[^0-9.]/', '', (string) $property->price);
                    $formattedPrice = is_numeric($numericPrice) && $numericPrice !== ''
                        ? '$' . number_format((float) $numericPrice, 0)
                        : (string) $property->price;

                    $summary = trim((string) ($property->summary ?: ''));

                    if ($summary === '') {
                        $summary = Str::limit(trim((string) $property->description), 110, '...');
                    }

                    $updates = [
                        'price' => $formattedPrice,
                        'image' => $property->image ?: ($hasLegacyImagePath ? $property->image_path : null),
                        'summary' => $summary,
                        'tags' => json_encode(array_values($tags)),
                        'details' => json_encode(array_values($details)),
                    ];

                    if ($hasUserId && $firstUserId && empty($property->user_id)) {
                        $updates['user_id'] = $firstUserId;
                    }

                    DB::table('properties')
                        ->where('id', $property->id)
                        ->update($updates);
                }
            });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        $driver = Schema::getConnection()->getDriverName();

        DB::statement("UPDATE properties SET price = REPLACE(REPLACE(REPLACE(price, '$', ''), ',', ''), ' ', '')");

        if ($driver !== 'sqlite') {
            DB::statement("ALTER TABLE properties MODIFY price BIGINT UNSIGNED NOT NULL");
        }

        Schema::table('properties', function (Blueprint $table) {
            if (Schema::hasColumn('properties', 'details')) {
                $table->dropColumn('details');
            }

            if (Schema::hasColumn('properties', 'tags')) {
                $table->dropColumn('tags');
            }

            if (Schema::hasColumn('properties', 'summary')) {
                $table->dropColumn('summary');
            }

            if (Schema::hasColumn('properties', 'image')) {
                $table->dropColumn('image');
            }
        });
    }
};
