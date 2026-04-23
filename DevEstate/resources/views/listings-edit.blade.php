@extends('layouts.app')

@section('title', 'DevEstate | Update Listing')

@section('content')
<section class="hero">
    <span class="eyebrow">Manage Listing</span>
    <h1>Update property information.</h1>
    <p>Adjust the listing details here. You can keep the current image or upload a new one.</p>
</section>

<div class="page-card">
    <h2 class="section-title">Edit Listing</h2>

    @if ($errors->any())
        <div class="alert" style="margin-bottom: 1rem;">
            {{ $errors->first() }}
        </div>
    @endif

    <form method="POST" action="{{ route('listings.update', ['slug' => $property->slug]) }}" enctype="multipart/form-data" class="login-form">
        @csrf
        @method('PUT')

        <div class="form-grid">
            <div class="form-group">
                <label for="name" class="form-label">Property Name</label>
                <input id="name" name="name" type="text" value="{{ old('name', $property->name) }}" required class="form-input" />
            </div>
            <div class="form-group">
                <label for="price" class="form-label">Price</label>
                <input id="price" name="price" type="text" value="{{ old('price', preg_replace('/[^0-9]/', '', (string) $property->getRawOriginal('price'))) }}" required class="form-input" />
            </div>
        </div>

        <div class="form-grid">
            <div class="form-group">
                <label for="badge" class="form-label">Badge</label>
                <input id="badge" name="badge" type="text" value="{{ old('badge', $property->badge) }}" required class="form-input" />
            </div>
            <div class="form-group">
                <label for="image" class="form-label">Replace Property Image</label>
                <input id="image" name="image" type="file" accept=".jpg,.jpeg,.png,.webp,image/jpeg,image/png,image/webp" class="form-input" />
                <p class="form-note" style="text-align: left; margin-top: 0.5rem;">Leave this blank to keep the current image.</p>
            </div>
        </div>

        <div class="form-group">
            <label for="summary" class="form-label">Summary</label>
            <textarea id="summary" name="summary" required class="form-input">{{ old('summary', $property->summary) }}</textarea>
        </div>

        <div class="form-group">
            <label for="description" class="form-label">Full Description</label>
            <textarea id="description" name="description" required class="form-input">{{ old('description', $property->description) }}</textarea>
        </div>

        <div class="form-group">
            <label for="tags" class="form-label">Tags</label>
            <input id="tags" name="tags" type="text" value="{{ old('tags', implode(', ', $property->tags ?? [])) }}" required class="form-input" />
        </div>

        @for ($i = 0; $i < 4; $i++)
            <div class="form-grid">
                <div class="form-group">
                    <label for="detail_labels_{{ $i }}" class="form-label">Detail Label {{ $i + 1 }}</label>
                    <input id="detail_labels_{{ $i }}" name="detail_labels[]" type="text" value="{{ old('detail_labels.' . $i, $property->details[$i]['label'] ?? '') }}" required class="form-input" />
                </div>
                <div class="form-group">
                    <label for="detail_values_{{ $i }}" class="form-label">Detail Value {{ $i + 1 }}</label>
                    <input id="detail_values_{{ $i }}" name="detail_values[]" type="text" value="{{ old('detail_values.' . $i, $property->details[$i]['value'] ?? '') }}" required class="form-input" />
                </div>
            </div>
        @endfor

        <div class="form-actions">
            <button type="submit" class="btn btn-primary">Update Listing</button>
            <a href="{{ route('details', ['slug' => $property->slug]) }}" class="btn btn-secondary" style="color: var(--navy); border-color: var(--border);">Back to Manage Listing</a>
        </div>
    </form>
</div>
@endsection
