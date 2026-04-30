@extends('layouts.app')

@section('title', 'DevEstate | Details')

@section('content')
@php
    $agentName = optional($property->user)->full_name ?: optional($property->user)->name ?: 'Unknown Agent';
    $propertyName = $property->name ?: 'Untitled Property';
    $propertyBadge = $property->badge ?: 'Featured Listing';
    $propertyPrice = $property->price ?: 'Price on request';
    $propertyDescription = $property->description ?: 'No description available for this property yet.';
    $propertySummary = $property->summary ?: $propertyDescription;
    $propertyImage = $property->image ? asset($property->image) : asset('images/CompanyLOGO.png');
    $propertyTags = is_array($property->tags ?? null) ? $property->tags : [];
    $propertyDetails = collect(is_array($property->details ?? null) ? $property->details : [])
        ->filter(fn ($detail) => is_array($detail) && filled($detail['label'] ?? null) && filled($detail['value'] ?? null))
        ->values();
    $detailIcons = [
        'price' => 'bi-cash-coin',
        'bedroom' => 'bi-door-open',
        'bedrooms' => 'bi-door-open',
        'bathroom' => 'bi-droplet',
        'bathrooms' => 'bi-droplet',
        'size' => 'bi-aspect-ratio',
        'area' => 'bi-aspect-ratio',
        'location' => 'bi-geo-alt',
        'parking' => 'bi-car-front',
        'garage' => 'bi-car-front',
        'type' => 'bi-house-door',
    ];
@endphp
<div class="page-card detail-card">
    @if (session('reservation_status'))
        <div class="alert" style="margin-bottom: 1rem; background: #DCFCE7; border-color: #BBF7D0; color: #166534;">
            {{ session('reservation_status') }}
        </div>
    @endif
    @if (session('status'))
        <div class="alert" style="margin-bottom: 1rem; background: #DCFCE7; border-color: #BBF7D0; color: #166534;">
            {{ session('status') }}
        </div>
    @endif
    <div class="detail-hero">
        <div class="detail-visual">
            <img src="{{ $propertyImage }}" alt="{{ $propertyName }}">
        </div>
        <div class="detail-main">
            <div class="detail-heading">
                <span class="eyebrow">
                    <i class="bi bi-stars" aria-hidden="true"></i>
                    <span>{{ $propertyBadge }}</span>
                </span>
                <h3>{{ $propertyName }}</h3>
                <div class="detail-meta">
                    @foreach ($propertyTags as $tag)
                        <span>
                            <i class="bi bi-check2-circle" aria-hidden="true"></i>
                            <span>{{ $tag }}</span>
                        </span>
                    @endforeach
                </div>
            </div>

            <div class="detail-highlights">
                <div class="detail-highlight-card detail-highlight-price">
                    <span class="detail-highlight-label">
                        <i class="bi bi-cash-stack" aria-hidden="true"></i>
                        <span>Asking Price</span>
                    </span>
                    <strong>{{ $propertyPrice }}</strong>
                </div>
                <div class="detail-highlight-card">
                    <span class="detail-highlight-label">
                        <i class="bi bi-person-badge" aria-hidden="true"></i>
                        <span>Listed By</span>
                    </span>
                    <strong>{{ $agentName }}</strong>
                </div>
            </div>

            <p class="detail-description detail-lead">
                {{ $propertyDescription }}
            </p>
        </div>
    </div>

    <div class="detail-list">
        <div class="detail-item">
            <span>
                <i class="bi bi-cash-coin" aria-hidden="true"></i>
                <span>Price</span>
            </span>
            <strong>{{ $propertyPrice }}</strong>
        </div>
        @foreach ($propertyDetails as $detail)
            @php
                $detailLabel = strtolower($detail['label'] ?? '');
                $detailIcon = 'bi-house-gear';
                foreach ($detailIcons as $keyword => $icon) {
                    if (str_contains($detailLabel, $keyword)) {
                        $detailIcon = $icon;
                        break;
                    }
                }
            @endphp
            <div class="detail-item">
                <span>
                    <i class="bi {{ $detailIcon }}" aria-hidden="true"></i>
                    <span>{{ $detail['label'] }}</span>
                </span>
                <strong>{{ $detail['value'] }}</strong>
            </div>
        @endforeach
    </div>

    <div class="detail-sections">
        <section class="detail-section">
            <div class="detail-section-heading">
                <i class="bi bi-file-earmark-text" aria-hidden="true"></i>
                <div>
                    <h4>Property Overview</h4>
                    <p>Key context to help clients understand the home faster.</p>
                </div>
            </div>
            <p class="detail-description detail-section-copy">{{ $propertySummary }}</p>
        </section>

        <section class="detail-section detail-feature-section">
            <div class="detail-section-heading">
                <i class="bi bi-compass" aria-hidden="true"></i>
                <div>
                    <h4>Why This Listing Stands Out</h4>
                    <p>Quick cues for comfort, trust, and decision-making.</p>
                </div>
            </div>
            <div class="detail-feature-grid">
                <div class="detail-feature-card">
                    <i class="bi bi-shield-check" aria-hidden="true"></i>
                    <strong>Verified Listing</strong>
                    <span>Presented with agent-backed information and a clear pricing snapshot.</span>
                </div>
                <div class="detail-feature-card">
                    <i class="bi bi-house-heart" aria-hidden="true"></i>
                    <strong>Move-In Appeal</strong>
                    <span>Important property facts are grouped up front so buyers can compare faster.</span>
                </div>
                <div class="detail-feature-card">
                    <i class="bi bi-chat-dots" aria-hidden="true"></i>
                    <strong>Easy Next Step</strong>
                    <span>Reserve interest or return to browsing without losing your place.</span>
                </div>
            </div>
        </section>
    </div>

    <div class="inline-actions">
        @if (session('logged_in'))
            <a href="{{ route('listings.edit', ['slug' => $property->slug]) }}" class="btn btn-secondary" style="color: var(--navy); border-color: var(--border);">
                <i class="bi bi-pencil-square" aria-hidden="true"></i>
                <span>Update Listing</span>
            </a>
        @else
            <button type="button" class="btn btn-primary reservation-open" data-reservation-open>
                <i class="bi bi-calendar2-check" aria-hidden="true"></i>
                <span>Reserve This Property</span>
            </button>
        @endif
        <a href="{{ route('listings') }}" class="btn {{ session('logged_in') ? 'btn-primary' : 'btn-secondary' }}" style="{{ session('logged_in') ? '' : 'color: var(--navy); border-color: var(--border); background: #FFFFFF;' }}">
            <i class="bi bi-arrow-left-circle" aria-hidden="true"></i>
            <span>{{ session('logged_in') ? 'Back to Listings' : 'Continue Browsing' }}</span>
        </a>
    </div>
</div>

@if (!session('logged_in'))
    @php
        $hasReservationErrors = $errors->has('client_name') || $errors->has('contact_number') || $errors->has('slug');
    @endphp
    <div class="reservation-overlay {{ $hasReservationErrors ? 'is-open' : '' }}" data-reservation-overlay>
        <div class="reservation-panel" role="dialog" aria-modal="true" aria-labelledby="reservation-title">
            <div class="reservation-panel-header">
                <h2 id="reservation-title">
                    <i class="bi bi-calendar2-check" aria-hidden="true"></i>
                    <span>Reserve {{ $property->name }}</span>
                </h2>
                <button type="button" class="reservation-close" aria-label="Close reservation panel" data-reservation-close>&times;</button>
            </div>
            <p class="reservation-panel-copy">Enter your details and we will contact you to confirm your reservation.</p>
            <form method="POST" action="{{ route('reservations.store') }}" class="reservation-form">
                @csrf
                <input type="hidden" name="slug" value="{{ $property->slug }}">

                @if ($hasReservationErrors)
                    <div class="alert" style="margin-bottom: 0.75rem; background: #FEE2E2; border-color: #FECACA; color: #991B1B;">
                        Please review the form fields and try again.
                    </div>
                @endif

                <label class="form-label" for="client_name">
                    <i class="bi bi-person" aria-hidden="true"></i>
                    <span>Full Name</span>
                </label>
                <input
                    id="client_name"
                    name="client_name"
                    type="text"
                    class="form-input"
                    value="{{ old('client_name') }}"
                    placeholder="Enter your full name"
                    required
                >
                @error('client_name')
                    <p class="reservation-error">{{ $message }}</p>
                @enderror

                <label class="form-label" for="contact_number">
                    <i class="bi bi-telephone" aria-hidden="true"></i>
                    <span>Contact Number</span>
                </label>
                <div class="input-group">
                    <span class="input-group-text">+63</span>
                    <input
                        id="contact_number"
                        name="contact_number"
                        type="tel"
                        class="form-input form-control"
                        value="{{ old('contact_number') }}"
                        placeholder="e.g. 9171234567"
                        inputmode="numeric"
                        pattern="[0-9]{10}"
                        minlength="10"
                        maxlength="10"
                        required
                    >
                </div>
                @error('contact_number')
                    <p class="reservation-error">{{ $message }}</p>
                @enderror

                <div class="form-actions">
                    <button type="submit" class="btn btn-primary" data-reservation-submit>
                        <i class="bi bi-send-check" aria-hidden="true"></i>
                        <span>Submit Reservation</span>
                    </button>
                    <button type="button" class="btn btn-secondary reservation-cancel" data-reservation-close>
                        <i class="bi bi-x-circle" aria-hidden="true"></i>
                        <span>Cancel</span>
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        (() => {
            const overlay = document.querySelector('[data-reservation-overlay]');
            const openButton = document.querySelector('[data-reservation-open]');
            const closeButtons = document.querySelectorAll('[data-reservation-close]');
            const reservationForm = document.querySelector('.reservation-form');
            const submitButton = document.querySelector('[data-reservation-submit]');
            const submitButtonLabel = submitButton ? submitButton.innerHTML : '';

            if (!overlay || !openButton) {
                return;
            }

            const openPanel = () => {
                overlay.classList.add('is-open');
                document.body.style.overflow = 'hidden';
            };

            const closePanel = () => {
                overlay.classList.remove('is-open');
                document.body.style.overflow = '';
            };

            openButton.addEventListener('click', openPanel);

            closeButtons.forEach((button) => {
                button.addEventListener('click', closePanel);
            });

            overlay.addEventListener('click', (event) => {
                if (event.target === overlay) {
                    closePanel();
                }
            });

            if (reservationForm && submitButton) {
                reservationForm.addEventListener('submit', () => {
                    submitButton.disabled = true;
                    submitButton.innerHTML = 'Submitting...';
                });

                window.addEventListener('pageshow', () => {
                    submitButton.disabled = false;
                    submitButton.innerHTML = submitButtonLabel;
                });
            }
        })();
    </script>
@endif
@endsection
