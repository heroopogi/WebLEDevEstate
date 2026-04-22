<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use Illuminate\Support\Str;

class Property extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'slug',
        'name',
        'image',
        'badge',
        'price',
        'summary',
        'description',
        'tags',
        'details',
    ];

    public function getImageAttribute($value): string
    {
        if (!empty($value)) {
            return (string) $value;
        }

        return (string) ($this->attributes['image_path'] ?? '');
    }

    public function getSummaryAttribute($value): string
    {
        if (!empty($value)) {
            return (string) $value;
        }

        return Str::limit(trim((string) ($this->attributes['description'] ?? '')), 110, '...');
    }

    public function getPriceAttribute($value): string
    {
        $numericPrice = preg_replace('/[^0-9.]/', '', (string) $value);

        if ($numericPrice !== '' && is_numeric($numericPrice)) {
            return '$' . number_format((float) $numericPrice, 0);
        }

        return (string) $value;
    }

    public function getTagsAttribute($value): array
    {
        if (is_array($value)) {
            return $value;
        }

        if ($value === null || $value === '') {
            return [];
        }

        $decoded = json_decode($value, true);

        if (json_last_error() === JSON_ERROR_NONE && is_array($decoded)) {
            return $decoded;
        }

        if ($value !== null && $value !== '') {
            return array_values(array_filter(array_map('trim', explode(',', (string) $value))));
        }

        $tags = [];

        if (!empty($this->attributes['bedrooms'])) {
            $tags[] = $this->attributes['bedrooms'] . ' Bed' . ((int) $this->attributes['bedrooms'] === 1 ? '' : 's');
        }

        if (!empty($this->attributes['bathrooms'])) {
            $tags[] = $this->attributes['bathrooms'] . ' Bath' . ((int) $this->attributes['bathrooms'] === 1 ? '' : 's');
        }

        if (!empty($this->attributes['parking_spaces'])) {
            $tags[] = $this->attributes['parking_spaces'] . ' Parking';
        }

        return $tags;
    }

    public function getDetailsAttribute($value): array
    {
        if (is_array($value)) {
            return $value;
        }

        if ($value === null || $value === '') {
            return [];
        }

        $decoded = json_decode($value, true);

        if (is_array($decoded)) {
            return $decoded;
        }

        return array_values(array_filter([
            !empty($this->attributes['floor_area']) ? ['label' => 'Floor Area', 'value' => $this->attributes['floor_area'] . ' sqm'] : null,
            !empty($this->attributes['lot_area']) ? ['label' => 'Lot Area', 'value' => $this->attributes['lot_area'] . ' sqm'] : null,
            !empty($this->attributes['location']) ? ['label' => 'Location', 'value' => $this->attributes['location']] : null,
            !empty($this->attributes['property_type']) ? ['label' => 'Style', 'value' => $this->attributes['property_type']] : null,
        ]));
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
