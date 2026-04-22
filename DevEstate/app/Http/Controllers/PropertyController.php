<?php

namespace App\Http\Controllers;

use App\Models\Property;
use Illuminate\Http\Request;
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

    public function index()
    {
        if (session('logged_in')) {
            $properties = Property::with('user')->where('user_id', $this->currentUserId())->latest()->get();
        } else {
            $properties = Property::with('user')->latest()->get();
        }

        return view('listings', compact('properties'));
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
