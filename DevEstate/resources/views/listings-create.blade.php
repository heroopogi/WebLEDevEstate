@extends('layouts.app')

@section('title', 'DevEstate | Add Listing')

@section('content')
<section class="hero">
    <span class="eyebrow">Admin Listing Form</span>
    <h1>Add a new property listing.</h1>
    <p>Create a listing with an uploaded image, selling details, and feature highlights that will appear on the client-facing pages.</p>
</section>

<div class="page-card">
    <h2 class="section-title">Listing Information</h2>

    @if ($errors->any())
        <div class="alert" style="margin-bottom: 1rem;">
            {{ $errors->first() }}
        </div>
    @endif

    <form method="POST" action="{{ route('listings.store') }}" enctype="multipart/form-data" class="login-form">
        @csrf

        <div class="form-grid">
            <div class="form-group">
                <label for="name" class="form-label">Property Name</label>
                <input id="name" name="name" type="text" value="{{ old('name') }}" required class="form-input" />
            </div>
            <div class="form-group">
                <label for="price" class="form-label">Price</label>
                <input id="price" name="price" type="text" value="{{ old('price') }}" placeholder="$780,000" required class="form-input" />
            </div>
        </div>

        <div class="form-grid">
            <div class="form-group">
                <label for="badge" class="form-label">Badge</label>
                <input id="badge" name="badge" type="text" value="{{ old('badge') }}" placeholder="Featured listing" required class="form-input" />
            </div>
            <div class="form-group">
                <label for="image" class="form-label">Property Image</label>
                <input id="image" name="image" type="file" accept=".jpg,.jpeg,.png,.webp,image/jpeg,image/png,image/webp" required class="form-input" />
                <p class="form-note" style="text-align: left; margin-top: 0.5rem;">Choose an image from your files. Max size: 5 MB.</p>
            </div>
        </div>

        <div class="form-group">
            <label for="summary" class="form-label">Summary</label>
            <textarea id="summary" name="summary" required class="form-input">{{ old('summary') }}</textarea>
        </div>

        <div class="form-group">
            <label for="description" class="form-label">Full Description</label>
            <textarea id="description" name="description" required class="form-input">{{ old('description') }}</textarea>
        </div>

        <div class="form-group">
            <label for="tags" class="form-label">Tags</label>
            <input id="tags" name="tags" type="text" value="{{ old('tags') }}" placeholder="4 Beds, 3 Baths, Private Garage" required class="form-input" />
            <p class="form-note" style="text-align: left; margin-top: 0.5rem;">Use commas to separate tags.</p>
        </div>

        <div class="form-grid">
            <div class="form-group">
                <label for="detail_labels_0" class="form-label">Detail Label 1</label>
                <input id="detail_labels_0" name="detail_labels[]" type="text" value="{{ old('detail_labels.0', 'Floor Area') }}" required class="form-input" />
            </div>
            <div class="form-group">
                <label for="detail_values_0" class="form-label">Detail Value 1</label>
                <input id="detail_values_0" name="detail_values[]" type="text" value="{{ old('detail_values.0') }}" required class="form-input" />
            </div>
        </div>

        <div class="form-grid">
            <div class="form-group">
                <label for="detail_labels_1" class="form-label">Detail Label 2</label>
                <input id="detail_labels_1" name="detail_labels[]" type="text" value="{{ old('detail_labels.1', 'Bedrooms') }}" required class="form-input" />
            </div>
            <div class="form-group">
                <label for="detail_values_1" class="form-label">Detail Value 2</label>
                <input id="detail_values_1" name="detail_values[]" type="text" value="{{ old('detail_values.1') }}" required class="form-input" />
            </div>
        </div>

        <div class="form-grid">
            <div class="form-group">
                <label for="detail_labels_2" class="form-label">Detail Label 3</label>
                <input id="detail_labels_2" name="detail_labels[]" type="text" value="{{ old('detail_labels.2', 'Location') }}" required class="form-input" />
            </div>
            <div class="form-group">
                <label for="detail_values_2" class="form-label">Detail Value 3</label>
                <input id="detail_values_2" name="detail_values[]" type="text" value="{{ old('detail_values.2') }}" required class="form-input" />
            </div>
        </div>

        <div class="form-grid">
            <div class="form-group">
                <label for="detail_labels_3" class="form-label">Detail Label 4</label>
                <input id="detail_labels_3" name="detail_labels[]" type="text" value="{{ old('detail_labels.3', 'Style') }}" required class="form-input" />
            </div>
            <div class="form-group">
                <label for="detail_values_3" class="form-label">Detail Value 4</label>
                <input id="detail_values_3" name="detail_values[]" type="text" value="{{ old('detail_values.3') }}" required class="form-input" />
            </div>
        </div>

        <div class="form-actions">
            <button type="submit" class="btn btn-primary">Save Listing</button>
            <a href="{{ route('listings') }}" class="btn btn-secondary" style="color: var(--navy); border-color: var(--border);">Cancel</a>
        </div>
    </form>
</div>
@endsection
