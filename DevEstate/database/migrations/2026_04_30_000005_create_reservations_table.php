<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        if (!Schema::hasTable('reservations')) {
            Schema::create('reservations', function (Blueprint $table) {
                $table->uuid('id')->primary();
                $table->foreignId('property_id')->nullable()->constrained('properties')->nullOnDelete();
                $table->string('property_slug')->index();
                $table->string('property_name');
                $table->string('client_name');
                $table->string('contact_number', 32);
                $table->string('status')->default('new')->index();
                $table->boolean('is_read')->default(false)->index();
                $table->timestamp('submitted_at')->nullable()->index();
                $table->timestamp('confirmed_at')->nullable();
                $table->timestamp('done_at')->nullable();
                $table->timestamps();
            });
        }

        $reservationPath = storage_path('app/reservations.json');

        if (!File::exists($reservationPath)) {
            return;
        }

        $decoded = json_decode(File::get($reservationPath), true);

        if (!is_array($decoded)) {
            return;
        }

        foreach ($decoded as $item) {
            if (!is_array($item) || empty($item['id']) || empty($item['property_slug'])) {
                continue;
            }

            $propertyId = \App\Models\Property::where('slug', $item['property_slug'])->value('id');
            $status = $item['status'] ?? 'new';

            if ($status === 'accepted') {
                $status = 'confirmed';
            }

            \App\Models\Reservation::query()->updateOrCreate(
                ['id' => (string) $item['id']],
                [
                    'property_id' => $propertyId,
                    'property_slug' => (string) $item['property_slug'],
                    'property_name' => (string) ($item['property_name'] ?? 'Unknown Property'),
                    'client_name' => (string) ($item['client_name'] ?? 'Unknown Client'),
                    'contact_number' => (string) ($item['contact_number'] ?? ''),
                    'status' => $status,
                    'is_read' => (bool) ($item['is_read'] ?? false),
                    'submitted_at' => $item['submitted_at'] ?? null,
                    'confirmed_at' => $item['confirmed_at'] ?? ($item['accepted_at'] ?? null),
                    'done_at' => $item['done_at'] ?? null,
                    'created_at' => $item['submitted_at'] ?? now(),
                    'updated_at' => now(),
                ]
            );
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reservations');
    }
};
