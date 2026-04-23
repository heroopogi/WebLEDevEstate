<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use Illuminate\Support\Str;

class Property extends Model
{
    use HasFactory;

    protected const DEFAULT_IMAGES = [
        'skyline-ridge-home' => 'images/house1.jpg',
        'parklane-condo' => 'images/house2.jpg',
        'harbor-crest-penthouse' => 'images/house3.jpg',
        'riverbend-villa' => 'images/house4.jpg',
        'mountain-view-cottage' => 'images/house5.jpg',
    ];

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

    protected $casts = [
        'tags' => 'array',
        'details' => 'array',
    ];

    public function getImageAttribute($value): string
    {
        if (!empty($value)) {
            return (string) $value;
        }

        if (!empty($this->attributes['image_path'])) {
            return (string) $this->attributes['image_path'];
        }

        $slug = (string) ($this->attributes['slug'] ?? '');

        return self::DEFAULT_IMAGES[$slug] ?? 'images/CompanyLOGO.png';
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
