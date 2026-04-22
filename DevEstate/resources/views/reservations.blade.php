@extends('layouts.app')

@section('title', 'DevEstate | Reservations')

@section('content')
<section class="hero">
    <span class="eyebrow">Client Requests</span>
    <h1>Reservation Requests</h1>
    <p>Review reservation requests submitted by clients and contact them directly using the provided details.</p>
</section>

<div class="page-card">
    <h2 class="section-title">Pending Reservations</h2>

    @if (session('status'))
        <div class="alert" style="margin-bottom: 1rem; background: #DCFCE7; border-color: #BBF7D0; color: #166534;">
            {{ session('status') }}
        </div>
    @endif

    @if($reservations->isEmpty())
        <div class="alert" style="background: #EFF6FF; border-color: #BFDBFE; color: #1E3A8A;">
            No pending reservation requests.
        </div>
    @else
        <div class="feature-grid">
            @foreach($reservations as $reservation)
                <article class="quick-card">
                    <div class="reservation-status-pill reservation-status-{{ strtolower($reservation['status'] ?? 'new') }}">
                        {{ strtoupper($reservation['status'] ?? 'NEW') }}
                    </div>
                    <h3>{{ $reservation['client_name'] ?? 'Unknown Client' }}</h3>
                    <p class="quick-card-copy"><strong>Property:</strong> {{ $reservation['property_name'] ?? 'Unknown Property' }}</p>
                    <p class="quick-card-copy"><strong>Contact:</strong> {{ $reservation['contact_number'] ?? 'N/A' }}</p>
                    <p class="quick-card-copy"><strong>Submitted:</strong> {{ !empty($reservation['submitted_at']) ? \Carbon\Carbon::parse($reservation['submitted_at'])->format('M d, Y h:i A') : 'Unknown' }}</p>

                    @if(($reservation['status'] ?? 'new') !== 'accepted' && !empty($reservation['id']))
                        <form method="POST" action="{{ route('reservations.accept', ['id' => $reservation['id']]) }}" style="margin-top: 0.8rem;">
                            @csrf
                            <button type="submit" class="btn btn-primary">Accept</button>
                        </form>
                    @elseif(($reservation['status'] ?? 'new') !== 'accepted')
                        <p class="quick-card-copy" style="margin-top: 0.8rem; color: #92400E; font-weight: 700;">
                            Cannot accept: reservation ID missing.
                        </p>
                    @else
                        <p class="quick-card-copy" style="margin-top: 0.8rem; color: #166534; font-weight: 700;">
                            Accepted{{ !empty($reservation['accepted_at']) ? ' on ' . \Carbon\Carbon::parse($reservation['accepted_at'])->format('M d, Y h:i A') : '' }}
                        </p>
                    @endif
                </article>
            @endforeach
        </div>
    @endif
</div>
@endsection
