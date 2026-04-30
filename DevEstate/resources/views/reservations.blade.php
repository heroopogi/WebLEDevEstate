@extends('layouts.app')

@section('title', 'DevEstate | Reservations')

@section('content')
@php
    $activeCount = $activeReservations->count();
    $newCount = $activeReservations->where('status', 'new')->count();
    $confirmedCount = $activeReservations->where('status', 'confirmed')->count();
    $historyCount = $reservationHistory->count();
@endphp
<style>
    .reservation-shell {
        display: grid;
        gap: 1.5rem;
    }

    .reservation-board {
        background: rgba(255, 255, 255, 0.98);
        border: 1px solid rgba(217, 226, 236, 0.9);
        border-radius: 30px;
        box-shadow: 0 20px 40px rgba(15, 23, 42, 0.08);
        padding: 1.5rem;
    }

    .reservation-board-topbar {
        display: flex;
        align-items: flex-start;
        justify-content: space-between;
        gap: 1rem;
        flex-wrap: wrap;
        margin-bottom: 1.25rem;
    }

    .reservation-breadcrumb {
        display: flex;
        align-items: center;
        gap: 0.75rem;
        flex-wrap: wrap;
        color: var(--navy);
    }

    .reservation-breadcrumb h2 {
        margin: 0;
        font-size: clamp(1.6rem, 3vw, 2rem);
        line-height: 1.15;
    }

    .reservation-breadcrumb span {
        color: var(--text-muted);
        font-weight: 600;
    }

    .reservation-board-copy {
        margin: 0.45rem 0 0;
        color: var(--text-muted);
        line-height: 1.6;
        max-width: 62ch;
    }

    .reservation-view-controls {
        display: inline-flex;
        align-items: center;
        gap: 0.4rem;
        padding: 0.3rem;
        border-radius: 999px;
        border: 1px solid rgba(16, 42, 68, 0.14);
        background: #F8FAFD;
    }

    .reservation-view-pill {
        display: inline-flex;
        align-items: center;
        gap: 0.45rem;
        min-height: 42px;
        padding: 0.65rem 0.95rem;
        border-radius: 999px;
        color: var(--navy);
        font-size: 0.92rem;
        font-weight: 700;
    }

    .reservation-view-pill.is-active {
        background: #D9ECFF;
        box-shadow: inset 0 0 0 2px #2D7EDB;
    }

    .reservation-filter-row {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 0.8rem;
        flex-wrap: wrap;
        margin-bottom: 1rem;
    }

    .reservation-filter-chips {
        display: flex;
        gap: 0.7rem;
        flex-wrap: wrap;
    }

    .reservation-chip {
        display: inline-flex;
        align-items: center;
        gap: 0.45rem;
        min-height: 42px;
        padding: 0.65rem 1rem;
        border-radius: 14px;
        border: 1px solid rgba(16, 42, 68, 0.18);
        background: #FFFFFF;
        color: var(--navy);
        font-size: 0.92rem;
        font-weight: 700;
    }

    .reservation-chip strong {
        font-weight: 800;
    }

    .reservation-sort {
        display: inline-flex;
        align-items: center;
        gap: 0.45rem;
        color: var(--text-muted);
        font-weight: 700;
    }

    .reservation-table {
        width: 100%;
        border-collapse: collapse;
        table-layout: fixed;
    }

    .reservation-table thead th {
        padding: 0.95rem 1rem;
        border-bottom: 1px solid rgba(217, 226, 236, 0.95);
        color: var(--text-muted);
        font-size: 0.9rem;
        font-weight: 800;
        text-align: left;
    }

    .reservation-table tbody td {
        padding: 1rem;
        border-bottom: 1px solid rgba(217, 226, 236, 0.85);
        vertical-align: middle;
        color: var(--navy);
    }

    .reservation-table tbody tr {
        transition: background 0.18s ease;
    }

    .reservation-table tbody tr:hover {
        background: #FAFCFF;
    }

    .reservation-name-cell {
        display: flex;
        align-items: center;
        gap: 0.9rem;
        min-width: 0;
    }

    .reservation-name-icon {
        width: 44px;
        height: 44px;
        flex: 0 0 44px;
        border-radius: 14px;
        display: grid;
        place-items: center;
        background: linear-gradient(180deg, #FBF2D4 0%, #F4E2A6 100%);
        color: #8B6B1B;
    }

    .reservation-name-copy {
        min-width: 0;
    }

    .reservation-name-copy strong,
    .reservation-owner-cell strong {
        display: block;
        font-size: 1rem;
        line-height: 1.3;
        color: var(--navy);
    }

    .reservation-name-copy span,
    .reservation-owner-cell span,
    .reservation-muted {
        display: block;
        margin-top: 0.2rem;
        color: var(--text-muted);
        line-height: 1.45;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
    }

    .reservation-owner-cell {
        min-width: 0;
    }

    .reservation-contact-cell {
        color: var(--navy);
        font-weight: 700;
    }

    .reservation-status-pill {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        min-height: 34px;
        padding: 0.45rem 0.8rem;
        border-radius: 999px;
        font-size: 0.78rem;
        font-weight: 800;
        letter-spacing: 0.06em;
        width: fit-content;
        margin: 0;
    }

    .reservation-status-new {
        background: #F3E8BE;
        color: #8B6B1B;
    }

    .reservation-status-accepted,
    .reservation-status-confirmed {
        background: #DCFCE7;
        color: #166534;
    }

    .reservation-status-done {
        background: #DBEAFE;
        color: #1D4ED8;
    }

    .reservation-actions-cell {
        width: 1%;
        white-space: nowrap;
    }

    .reservation-actions {
        display: flex;
        align-items: center;
        justify-content: flex-end;
        gap: 0.65rem;
        flex-wrap: wrap;
    }

    .reservation-actions form {
        margin: 0;
    }

    .reservation-empty {
        padding: 1.25rem 1rem 0.5rem;
    }

    .reservation-divider {
        height: 1px;
        background: rgba(217, 226, 236, 0.9);
        margin: 0.5rem 0;
    }

    @media (max-width: 1100px) {
        .reservation-table {
            min-width: 980px;
        }

        .reservation-table-wrap {
            overflow-x: auto;
        }
    }

    @media (max-width: 720px) {
        .reservation-board {
            padding: 1rem;
            border-radius: 22px;
        }

        .reservation-breadcrumb h2 {
            font-size: 1.45rem;
        }
    }
</style>
<section class="hero">
    <span class="eyebrow">Client Requests</span>
    <h1>Reservation Requests</h1>
    <p>Review reservation requests submitted by clients and contact them directly using the provided details.</p>
</section>

<div class="reservation-shell">
    <section class="reservation-board">
        <div class="reservation-board-topbar">
            <div>
                <div class="reservation-breadcrumb">
                    <span>Reservations</span>
                    <i class="bi bi-chevron-right" aria-hidden="true"></i>
                    <h2>Active Appointments</h2>
                </div>
                <p class="reservation-board-copy">A list-style queue for current requests. Confirm new client bookings, then mark them done after the appointment is completed.</p>
            </div>
        </div>

        <div class="reservation-filter-row">
            <div class="reservation-filter-chips">
                <span class="reservation-chip"><strong>{{ $activeCount }}</strong> Active</span>
                <span class="reservation-chip"><strong>{{ $newCount }}</strong> New</span>
                <span class="reservation-chip"><strong>{{ $confirmedCount }}</strong> Confirmed</span>
            </div>
            <div class="reservation-sort">
                <i class="bi bi-arrow-down-up" aria-hidden="true"></i>
                <span>Sorted by latest submitted</span>
            </div>
        </div>

        @if (session('status'))
            <div class="alert" style="margin-bottom: 1rem; background: #DCFCE7; border-color: #BBF7D0; color: #166534;">
                {{ session('status') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="alert" style="margin-bottom: 1rem;">
                {{ $errors->first() }}
            </div>
        @endif

        @if($activeReservations->isEmpty())
            <div class="reservation-empty">
                <div class="alert" style="background: #EFF6FF; border-color: #BFDBFE; color: #1E3A8A;">
                    No active appointments right now.
                </div>
            </div>
        @else
            <div class="reservation-table-wrap">
                <table class="reservation-table">
                    <thead>
                        <tr>
                            <th style="width: 32%;">Client</th>
                            <th style="width: 21%;">Property</th>
                            <th style="width: 13%;">Status</th>
                            <th style="width: 16%;">Submitted</th>
                            <th style="width: 12%;">Contact</th>
                            <th style="width: 20%; text-align: right;">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($activeReservations as $reservation)
                            <tr>
                                <td>
                                    <div class="reservation-name-cell">
                                        <span class="reservation-name-icon">
                                            <i class="bi bi-person-badge" aria-hidden="true"></i>
                                        </span>
                                        <div class="reservation-name-copy">
                                            <strong>{{ $reservation['client_name'] ?? 'Unknown Client' }}</strong>
                                            <span>
                                                @if (($reservation['status'] ?? 'new') === 'confirmed' && !empty($reservation['confirmed_at']))
                                                    Confirmed {{ \Carbon\Carbon::parse($reservation['confirmed_at'])->format('M d, Y h:i A') }}
                                                @else
                                                    Waiting for admin confirmation
                                                @endif
                                            </span>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="reservation-owner-cell">
                                        <strong>{{ $reservation['property_name'] ?? 'Unknown Property' }}</strong>
                                        <span>{{ $reservation['property_slug'] ?? 'No property slug' }}</span>
                                    </div>
                                </td>
                                <td>
                                    <span class="reservation-status-pill reservation-status-{{ strtolower($reservation['status'] ?? 'new') }}">
                                        {{ strtoupper($reservation['status'] ?? 'NEW') }}
                                    </span>
                                </td>
                                <td>
                                    <span class="reservation-muted">{{ !empty($reservation['submitted_at']) ? \Carbon\Carbon::parse($reservation['submitted_at'])->format('M d, Y') : 'Unknown' }}</span>
                                    <span class="reservation-muted">{{ !empty($reservation['submitted_at']) ? \Carbon\Carbon::parse($reservation['submitted_at'])->format('h:i A') : '' }}</span>
                                </td>
                                <td class="reservation-contact-cell">
                                    {{ $reservation['contact_number'] ?? 'N/A' }}
                                </td>
                                <td class="reservation-actions-cell">
                                    <div class="reservation-actions">
                                        @if (($reservation['status'] ?? 'new') === 'new' && !empty($reservation['id']))
                                            <form method="POST" action="{{ route('reservations.confirm', ['id' => $reservation['id']]) }}">
                                                @csrf
                                                <button type="submit" class="btn btn-primary">Confirm</button>
                                            </form>
                                        @elseif(($reservation['status'] ?? 'new') === 'new')
                                            <span class="reservation-muted">ID missing</span>
                                        @endif

                                        @if (($reservation['status'] ?? 'new') === 'confirmed' && !empty($reservation['id']))
                                            <form method="POST" action="{{ route('reservations.done', ['id' => $reservation['id']]) }}">
                                                @csrf
                                                <button type="submit" class="btn btn-secondary" style="color: var(--navy); border-color: var(--border);">Done</button>
                                            </form>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </section>

    <section class="reservation-board">
        <div class="reservation-board-topbar">
            <div>
                <div class="reservation-breadcrumb">
                    <span>Reservations</span>
                    <i class="bi bi-chevron-right" aria-hidden="true"></i>
                    <h2>Appointment History</h2>
                </div>
                <p class="reservation-board-copy">Completed appointments stay in this archive-style list so you can review past client meetings and outcomes.</p>
            </div>
            <div class="reservation-filter-chips">
                <span class="reservation-chip"><strong>{{ $historyCount }}</strong> Completed</span>
            </div>
        </div>

        @if($reservationHistory->isEmpty())
            <div class="reservation-empty">
                <div class="alert" style="background: #EFF6FF; border-color: #BFDBFE; color: #1E3A8A;">
                    No completed appointments yet.
                </div>
            </div>
        @else
            <div class="reservation-table-wrap">
                <table class="reservation-table">
                    <thead>
                        <tr>
                            <th style="width: 26%;">Client</th>
                            <th style="width: 20%;">Property</th>
                            <th style="width: 12%;">Status</th>
                            <th style="width: 14%;">Submitted</th>
                            <th style="width: 14%;">Confirmed</th>
                            <th style="width: 14%;">Completed</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($reservationHistory as $reservation)
                            <tr>
                                <td>
                                    <div class="reservation-name-cell">
                                        <span class="reservation-name-icon">
                                            <i class="bi bi-check2-circle" aria-hidden="true"></i>
                                        </span>
                                        <div class="reservation-name-copy">
                                            <strong>{{ $reservation['client_name'] ?? 'Unknown Client' }}</strong>
                                            <span>{{ $reservation['contact_number'] ?? 'N/A' }}</span>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="reservation-owner-cell">
                                        <strong>{{ $reservation['property_name'] ?? 'Unknown Property' }}</strong>
                                        <span>{{ $reservation['property_slug'] ?? 'No property slug' }}</span>
                                    </div>
                                </td>
                                <td>
                                    <span class="reservation-status-pill reservation-status-{{ strtolower($reservation['status'] ?? 'done') }}">
                                        {{ strtoupper($reservation['status'] ?? 'DONE') }}
                                    </span>
                                </td>
                                <td>
                                    <span class="reservation-muted">
                                        {{ !empty($reservation['submitted_at']) ? \Carbon\Carbon::parse($reservation['submitted_at'])->format('M d, Y h:i A') : 'Unknown' }}
                                    </span>
                                </td>
                                <td>
                                    <span class="reservation-muted">
                                        {{ !empty($reservation['confirmed_at']) ? \Carbon\Carbon::parse($reservation['confirmed_at'])->format('M d, Y h:i A') : 'Not recorded' }}
                                    </span>
                                </td>
                                <td>
                                    <span class="reservation-muted">
                                        {{ !empty($reservation['done_at']) ? \Carbon\Carbon::parse($reservation['done_at'])->format('M d, Y h:i A') : 'Not recorded' }}
                                    </span>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </section>
</div>
@endsection
