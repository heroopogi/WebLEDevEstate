@extends('layouts.app')

@section('title', 'DevEstate | Details')

@section('content')
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
    <div class="detail-visual">
        <img src="{{ asset($property->image) }}" alt="{{ $property->name }}">
    </div>
    <span class="eyebrow">{{ $property->badge }}</span>
    <h3>{{ $property->name }}</h3>
    <div class="detail-meta">
        @foreach (($property->tags ?? []) as $tag)
            <span>{{ $tag }}</span>
        @endforeach
    </div>
    <p class="detail-description" style="margin-bottom: 1rem;">
        Listed by:
        <strong>{{ optional($property->user)->full_name ?: optional($property->user)->name ?: 'Unknown Agent' }}</strong>
    </p>
    <p class="detail-description">
        {{ $property->description }}
    </p>
    <div class="detail-list">
        <div class="detail-item">
            <span>Price</span>
            <strong>{{ $property->price }}</strong>
        </div>
        @foreach (($property->details ?? []) as $detail)
            <div class="detail-item">
                <span>{{ $detail['label'] }}</span>
                <strong>{{ $detail['value'] }}</strong>
            </div>
        @endforeach
    </div>
    <p class="detail-description">{{ $property->summary }}</p>
    <div class="inline-actions">
        @if (session('logged_in'))
            <a href="{{ route('listings.edit', ['slug' => $property->slug]) }}" class="btn btn-secondary" style="color: var(--navy); border-color: var(--border);">Update Listing</a>
        @else
            <button type="button" class="btn btn-primary reservation-open" data-reservation-open>Reserve This Property</button>
        @endif
        <a href="{{ route('listings') }}" class="btn btn-primary">{{ session('logged_in') ? 'Back to listings' : 'Continue browsing' }}</a>
    </div>
</div>

@if (!session('logged_in'))
    @php
        $hasReservationErrors = $errors->has('client_name') || $errors->has('contact_number') || $errors->has('slug');
    @endphp
    <div class="reservation-overlay {{ $hasReservationErrors ? 'is-open' : '' }}" data-reservation-overlay>
        <div class="reservation-panel" role="dialog" aria-modal="true" aria-labelledby="reservation-title">
            <div class="reservation-panel-header">
                <h2 id="reservation-title">Reserve {{ $property->name }}</h2>
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

                <label class="form-label" for="client_name">Full Name</label>
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

                <label class="form-label" for="contact_number">Contact Number</label>
                <input
                    id="contact_number"
                    name="contact_number"
                    type="tel"
                    class="form-input"
                    value="{{ old('contact_number') }}"
                    placeholder="e.g. 0917 123 4567"
                    required
                >
                @error('contact_number')
                    <p class="reservation-error">{{ $message }}</p>
                @enderror

                <div class="form-actions">
                    <button type="submit" class="btn btn-primary" data-reservation-submit>Submit Reservation</button>
                    <button type="button" class="btn btn-secondary reservation-cancel" data-reservation-close>Cancel</button>
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
                    submitButton.textContent = 'Submitting...';
                });
            }
        })();
    </script>
@endif
@endsection
