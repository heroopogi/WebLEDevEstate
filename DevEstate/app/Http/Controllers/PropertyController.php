<?php

namespace App\Http\Controllers;

use App\Models\Property;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;

class PropertyController extends Controller
{
    protected function currentUserId()
    {
        return session('user_id');
    }

    protected function findOwnedProperty(string $slug)
    {
        return Property::where('slug', $slug)
            ->where('user_id', $this->currentUserId())
            ->firstOrFail();
    }

    protected function ensureLoggedIn()
    {
        if (!session('logged_in')) {
            return redirect()->route('login');
        }

        if (!$this->currentUserId()) {
            return redirect()->route('login');
        }

        return null;
    }

    public function index(Request $request)
    {
        $filters = $this->normalizeFilters($request);

        if (session('logged_in')) {
            $properties = Property::with('user')
                ->where('user_id', $this->currentUserId())
                ->latest()
                ->get();
        } else {
            $properties = Property::with('user')
                ->latest()
                ->get();
        }

        if ($this->hasActiveFilters($filters)) {
            $properties = $this->applyFilters($properties, $filters);
        }

        return view('listings', [
            'properties' => $properties,
            'filters' => $filters,
            'hasActiveFilters' => $this->hasActiveFilters($filters),
        ]);
    }

    protected function normalizeFilters(Request $request): array
    {
        return [
            'search' => trim((string) $request->input('search', '')),
            'property_type' => trim(Str::lower((string) $request->input('property_type', ''))),
            'price_range' => trim((string) $request->input('price_range', '')),
            'bedrooms' => (int) $request->input('bedrooms', 0),
        ];
    }

    protected function hasActiveFilters(array $filters): bool
    {
        return $filters['search'] !== ''
            || $filters['property_type'] !== ''
            || $filters['price_range'] !== ''
            || $filters['bedrooms'] > 0;
    }

    protected function applyFilters(Collection $properties, array $filters): Collection
    {
        return $properties
            ->filter(function (Property $property) use ($filters) {
                if ($filters['search'] !== '' && !$this->propertyMatchesSearch($property, $filters['search'])) {
                    return false;
                }

                if ($filters['property_type'] !== '' && !$this->propertyMatchesType($property, $filters['property_type'])) {
                    return false;
                }

                if ($filters['price_range'] !== '' && !$this->propertyMatchesPriceRange($property, $filters['price_range'])) {
                    return false;
                }

                if ($filters['bedrooms'] > 0 && $this->extractBedrooms($property) < $filters['bedrooms']) {
                    return false;
                }

                return true;
            })
            ->values();
    }

    protected function propertyMatchesSearch(Property $property, string $search): bool
    {
        $haystack = Str::lower($this->propertySearchText($property));

        foreach (preg_split('/\s+/', Str::lower(trim($search))) as $term) {
            if ($term === '') {
                continue;
            }

            if (!str_contains($haystack, $term)) {
                return false;
            }
        }

        return true;
    }

    protected function propertyMatchesType(Property $property, string $propertyType): bool
    {
        $needle = str_replace('-', ' ', Str::lower(trim($propertyType)));
        $haystack = Str::lower($this->propertySearchText($property));

        return $needle === '' || str_contains($haystack, $needle);
    }

    protected function propertyMatchesPriceRange(Property $property, string $priceRange): bool
    {
        $price = $this->extractPrice($property->price);

        return match ($priceRange) {
            '500k' => $price > 0 && $price <= 500000,
            '800k' => $price > 0 && $price <= 800000,
            '1200k' => $price > 0 && $price <= 1200000,
            '1200k-plus' => $price >= 1200000,
            default => true,
        };
    }

    protected function propertySearchText(Property $property): string
    {
        $tags = collect($property->tags ?? [])
            ->implode(' ');

        $details = collect($property->details ?? [])
            ->map(function ($detail) {
                if (!is_array($detail)) {
                    return '';
                }

                return trim(($detail['label'] ?? '') . ' ' . ($detail['value'] ?? ''));
            })
            ->implode(' ');

        return implode(' ', array_filter([
            $property->name,
            $property->badge,
            $property->summary,
            $property->description,
            $tags,
            $details,
        ]));
    }

    protected function extractPrice(string $price): float
    {
        $numeric = preg_replace('/[^0-9.]/', '', $price);

        return is_numeric($numeric) ? (float) $numeric : 0;
    }

    protected function extractBedrooms(Property $property): int
    {
        $sources = array_merge(
            $property->tags ?? [],
            collect($property->details ?? [])
                ->map(fn ($detail) => is_array($detail) ? ($detail['value'] ?? '') : '')
                ->all()
        );

        $bedrooms = collect($sources)
            ->map(function ($source) {
                if (preg_match('/(\d+)\s*(bed|beds|room|rooms|suite|suites)/i', (string) $source, $matches)) {
                    return (int) $matches[1];
                }

                return 0;
            })
            ->max();

        return (int) $bedrooms;
    }

    public function create()
    {
        if ($redirect = $this->ensureLoggedIn()) {
            return $redirect;
        }

        return view('listings-create');
    }

    public function store(Request $request)
    {
        if ($redirect = $this->ensureLoggedIn()) {
            return $redirect;
        }

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'image' => 'required|image|mimes:jpg,jpeg,png,webp|max:5120',
            'badge' => 'required|string|max:255',
            'price' => 'required|string|max:255',
            'summary' => 'required|string',
            'description' => 'required|string',
            'tags' => 'required|string',
            'detail_labels' => 'required|array|size:4',
            'detail_labels.*' => 'required|string|max:255',
            'detail_values' => 'required|array|size:4',
            'detail_values.*' => 'required|string|max:255',
        ]);

        $baseSlug = Str::slug($validated['name']);
        $slug = $baseSlug;
        $counter = 1;

        while (Property::where('slug', $slug)->exists()) {
            $slug = $baseSlug . '-' . $counter;
            $counter++;
        }

        $imageDirectory = public_path('images/listings');

        if (!File::exists($imageDirectory)) {
            File::makeDirectory($imageDirectory, 0755, true);
        }

        $imageFile = $request->file('image');
        $imageName = $slug . '-' . time() . '.' . $imageFile->getClientOriginalExtension();
        $imageFile->move($imageDirectory, $imageName);

        $tags = collect(explode(',', $validated['tags']))
            ->map(fn ($tag) => trim($tag))
            ->filter()
            ->values()
            ->all();

        $details = collect($validated['detail_labels'])
            ->zip($validated['detail_values'])
            ->map(fn ($pair) => [
                'label' => $pair[0],
                'value' => $pair[1],
            ])
            ->all();

        Property::create([
            'user_id' => $this->currentUserId(),
            'slug' => $slug,
            'name' => $validated['name'],
            'image' => 'images/listings/' . $imageName,
            'badge' => $validated['badge'],
            'price' => $validated['price'],
            'summary' => $validated['summary'],
            'description' => $validated['description'],
            'tags' => $tags,
            'details' => $details,
        ]);

        return redirect()
            ->route('listings')
            ->with('status', 'Listing added successfully.');
    }

    public function edit($slug)
    {
        if ($redirect = $this->ensureLoggedIn()) {
            return $redirect;
        }

        $property = $this->findOwnedProperty($slug);

        return view('listings-edit', compact('property'));
    }

    public function update(Request $request, $slug)
    {
        if ($redirect = $this->ensureLoggedIn()) {
            return $redirect;
        }

        $property = $this->findOwnedProperty($slug);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:5120',
            'badge' => 'required|string|max:255',
            'price' => 'required|string|max:255',
            'summary' => 'required|string',
            'description' => 'required|string',
            'tags' => 'required|string',
            'detail_labels' => 'required|array|size:4',
            'detail_labels.*' => 'required|string|max:255',
            'detail_values' => 'required|array|size:4',
            'detail_values.*' => 'required|string|max:255',
        ]);

        $newBaseSlug = Str::slug($validated['name']);
        $newSlug = $newBaseSlug;
        $counter = 1;

        while (Property::where('slug', $newSlug)->where('id', '!=', $property->id)->exists()) {
            $newSlug = $newBaseSlug . '-' . $counter;
            $counter++;
        }

        $imagePath = $property->image;

        if ($request->hasFile('image')) {
            $imageDirectory = public_path('images/listings');

            if (!File::exists($imageDirectory)) {
                File::makeDirectory($imageDirectory, 0755, true);
            }

            if ($property->image && File::exists(public_path($property->image))) {
                File::delete(public_path($property->image));
            }

            $imageFile = $request->file('image');
            $imageName = $newSlug . '-' . time() . '.' . $imageFile->getClientOriginalExtension();
            $imageFile->move($imageDirectory, $imageName);
            $imagePath = 'images/listings/' . $imageName;
        }

        $tags = collect(explode(',', $validated['tags']))
            ->map(fn ($tag) => trim($tag))
            ->filter()
            ->values()
            ->all();

        $details = collect($validated['detail_labels'])
            ->zip($validated['detail_values'])
            ->map(fn ($pair) => [
                'label' => $pair[0],
                'value' => $pair[1],
            ])
            ->all();

        $property->update([
            'slug' => $newSlug,
            'name' => $validated['name'],
            'image' => $imagePath,
            'badge' => $validated['badge'],
            'price' => $validated['price'],
            'summary' => $validated['summary'],
            'description' => $validated['description'],
            'tags' => $tags,
            'details' => $details,
        ]);

        return redirect()
            ->route('details', ['slug' => $property->slug])
            ->with('status', 'Listing updated successfully.');
    }

    public function destroy($slug)
    {
        if ($redirect = $this->ensureLoggedIn()) {
            return $redirect;
        }

        $property = $this->findOwnedProperty($slug);

        if ($property->image && File::exists(public_path($property->image))) {
            File::delete(public_path($property->image));
        }

        $property->delete();

        return redirect()
            ->route('listings')
            ->with('status', 'Listing deleted successfully.');
    }

    public function show($slug)
    {
        if (session('logged_in')) {
            $property = Property::with('user')->where('slug', $slug)
                ->where('user_id', $this->currentUserId())
                ->firstOrFail();
        } else {
            $property = Property::with('user')->where('slug', $slug)->firstOrFail();
        }

        return view('details', compact('property'));
    }
}
