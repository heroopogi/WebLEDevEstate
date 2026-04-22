@extends('layouts.app')

@section('title', 'DevEstate | Dashboard')

@section('content')
@php
    $stats = [
        [
            'label' => 'Active Listings',
            'value' => $activeListings,
            'helper' => $activeListings > 0 ? 'Published and visible to clients' : 'No listings yet. Start with your first property.',
            'icon' => 'bi-buildings',
            'route' => route('listings'),
            'accent' => '#1F4A7A',
        ],
        [
            'label' => 'Monthly Activity',
            'value' => $newThisMonth,
            'helper' => $newThisMonth > 0 ? $newThisMonth . ' listing' . ($newThisMonth > 1 ? 's' : '') . ' added this month' : 'No new listings this month.',
            'icon' => 'bi-graph-up-arrow',
            'route' => route('listings.create'),
            'accent' => '#D4A017',
        ],
        [
            'label' => 'Average Price',
            'value' => '$' . number_format($averageListingPrice, 0),
            'helper' => $activeListings > 0 ? 'Average asking price across active properties' : 'Add listings to calculate average pricing.',
            'icon' => 'bi-cash-stack',
            'route' => route('listings'),
            'accent' => '#2D5B86',
        ],
        [
            'label' => 'Portfolio Value',
            'value' => '$' . number_format($totalPortfolioValue, 0),
            'helper' => $totalPortfolioValue > 0 ? 'Combined value of your live inventory' : 'Portfolio value will appear here once properties are added.',
            'icon' => 'bi-bank',
            'route' => route('listings'),
            'accent' => '#0F2339',
        ],
    ];

    $latestProperty = $recentProperties->first();


    $maxTrendCount = max(1, $listingTrend->max('count'));
    $totalTrendListings = $listingTrend->sum('count');
@endphp

<section class="dashboard-shell dashboard-shell-wide">
    <div class="dashboard-banner">
        <div class="dashboard-banner-copy">
            <p class="dashboard-eyebrow">Admin Dashboard</p>
            <h1 class="dashboard-heading">Welcome back, {{ session('username', 'Agent') }}.</h1>
            <p class="dashboard-subheading">Track inventory, pricing, reservations, and listing momentum from a control room designed to stay productive on wide screens.</p>
            <div class="dashboard-banner-meta">
                <span class="dashboard-pill">
                    <i class="bi bi-buildings" aria-hidden="true"></i>
                    {{ $activeListings }} active
                </span>
                <span class="dashboard-pill">
                    <i class="bi bi-graph-up-arrow" aria-hidden="true"></i>
                    {{ $newThisMonth }} this month
                </span>
                <span class="dashboard-pill">
                    <i class="bi bi-calendar-check" aria-hidden="true"></i>
                    {{ $unreadReservations }} unread reservation{{ $unreadReservations === 1 ? '' : 's' }}
                </span>
            </div>
        </div>
        <div class="dashboard-banner-actions">
            <a href="{{ route('listings.create') }}" class="btn btn-primary">
                <i class="bi bi-plus-circle-fill" aria-hidden="true"></i>
                <span>+ Add New Property</span>
            </a>
            <a href="{{ route('listings') }}" class="btn btn-secondary" style="color: #FFFFFF; border-color: rgba(255, 255, 255, 0.26); background: rgba(255, 255, 255, 0.08);">
                <i class="bi bi-layout-text-window-reverse" aria-hidden="true"></i>
                <span>Manage Inventory</span>
            </a>
        </div>
    </div>

    @if (($unreadReservations ?? 0) > 0)
        <div class="alert" style="background: #FEF3C7; border-color: #FDE68A; color: #92400E; margin: 0;">
            You have {{ $unreadReservations }} new reservation {{ $unreadReservations > 1 ? 'requests' : 'request' }}.
            <a href="{{ route('reservations') }}" style="font-weight: 700; color: #78350F;">Review reservations</a>
        </div>
    @endif

    <div class="dashboard-three-column">
        <div class="dashboard-primary-column">
            <section class="dashboard-panel dashboard-gradient-panel">
                <div class="dashboard-panel-heading">
                    <div>
                        <h2>Portfolio Snapshot</h2>
                        <p>Live metrics you can click into when it is time to act.</p>
                    </div>
                </div>
                <div class="dashboard-stats-grid">
                    @foreach ($stats as $stat)
                        <a href="{{ $stat['route'] }}" class="dashboard-stat-link">
                            <article class="dashboard-stat-card" style="--card-accent: {{ $stat['accent'] }};">
                                <div class="dashboard-stat-head">
                                    <span class="stat-icon">
                                        <i class="bi {{ $stat['icon'] }}" aria-hidden="true"></i>
                                    </span>
                                    <i class="bi bi-arrow-up-right" aria-hidden="true"></i>
                                </div>
                                <small>{{ $stat['label'] }}</small>
                                <strong>{{ $stat['value'] }}</strong>
                                <p>{{ $stat['helper'] }}</p>
                            </article>
                        </a>
                    @endforeach
                </div>
            </section>

            <section class="dashboard-panel">
                <div class="dashboard-panel-heading">
                    <div>
                        <h2>Recent Activity</h2>
                        <p>The latest listing actions across your portfolio.</p>
                    </div>
                </div>

                @forelse ($recentActivity as $activity)
                    @if ($loop->first)
                        <div class="activity-list">
                    @endif
                        <a href="{{ $activity['url'] }}" class="activity-item">
                            <span class="activity-icon">
                                <i class="bi {{ $activity['icon'] }}" aria-hidden="true"></i>
                            </span>
                            <div class="activity-copy">
                                <strong>{{ $activity['title'] }}</strong>
                                <p>{{ $activity['description'] }}</p>
                                <span class="activity-time">
                                    {{ optional($activity['timestamp'])->diffForHumans() ?? 'Recently' }}
                                </span>
                            </div>
                        </a>
                    @if ($loop->last)
                        </div>
                    @endif
                @empty
                    <div class="empty-state">
                        <strong>No recent activity yet</strong>
                        Activity will appear here after you add or update a property.
                    </div>
                @endforelse
            </section>

            <section class="dashboard-panel dashboard-gradient-panel">
                <div class="dashboard-panel-heading">
                    <div>
                        <h2>Recent Listings Snapshot</h2>
                        <p>Your latest properties stay visible here for quick management without extra clicks.</p>
                    </div>
                </div>

                <div class="property-grid recent-listings-grid">
                    @forelse ($recentProperties as $property)
                        @php
                            $imageSource = \Illuminate\Support\Str::startsWith($property->image ?? '', ['http://', 'https://'])
                                ? $property->image
                                : asset($property->image ?? '');
                        @endphp
                        <a href="{{ route('details', ['slug' => $property->slug]) }}" class="dashboard-card-link">
                            <article class="property-card">
                                <div class="property-media">
                                    <img src="{{ $imageSource }}" alt="{{ $property->name }}">
                                    <span class="property-chip">{{ $property->badge }}</span>
                                </div>
                                <div class="property-body">
                                    <div class="property-meta">
                                        @foreach (array_slice($property->tags ?? [], 0, 3) as $tag)
                                            <span>{{ $tag }}</span>
                                        @endforeach
                                    </div>
                                    <h3>{{ $property->name }}</h3>
                                    <p class="property-summary">{{ $property->summary }}</p>
                                    <div class="price-row">
                                        <span class="price">{{ $property->price }}</span>
                                        <span class="btn btn-primary">
                                            <i class="bi bi-arrow-up-right-circle" aria-hidden="true"></i>
                                            <span>Manage</span>
                                        </span>
                                    </div>
                                </div>
                            </article>
                        </a>
                    @empty
                        <div class="empty-state" style="grid-column: 1 / -1;">
                            <strong>No listings yet</strong>
                            Add a property to start building your dashboard.
                        </div>
                    @endforelse
                </div>
            </section>
        </div>

        <aside class="dashboard-sidebar">
            <div class="dashboard-sidebar-stack">


                <section class="dashboard-panel">
                    <div class="dashboard-panel-heading">
                        <div>
                            <h2>Listings Analytics</h2>
                            <p>Six-month publishing trend across your current portfolio.</p>
                        </div>
                    </div>

                    @if ($totalTrendListings > 0)
                        <div class="analytics-summary">
                            <div>
                                <strong>{{ $totalTrendListings }}</strong>
                                <p>Total listings created in the last six months</p>
                            </div>
                            <span class="dashboard-pill dashboard-pill-soft">
                                <i class="bi bi-bar-chart-line" aria-hidden="true"></i>
                                Monthly trend
                            </span>
                        </div>

                        <div class="chart-bars chart-bars-wide">
                            @foreach ($listingTrend as $point)
                                @php
                                    $barHeight = max(12, ($point['count'] / $maxTrendCount) * 100);
                                    $barWidth = max(12, ($point['count'] / $maxTrendCount) * 100);
                                @endphp
                                <div class="chart-bar-group" title="{{ $point['full_label'] }}: {{ $point['count'] }} listing{{ $point['count'] === 1 ? '' : 's' }}">
                                    <span class="chart-value">{{ $point['count'] }}</span>
                                    <div class="chart-bar">
                                        <span class="chart-fill" style="height: {{ $barHeight }}%; --bar-width: {{ $barWidth }}%;"></span>
                                    </div>
                                    <span class="chart-label">{{ $point['label'] }}</span>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="empty-state">
                            <strong>No data yet — start adding listings</strong>
                            The analytics chart will expand here as soon as new properties are published.
                        </div>
                    @endif
                </section>

                <section class="dashboard-panel dashboard-gradient-panel">
                    <div class="dashboard-panel-heading">
                        <div>
                            <h2>Notifications</h2>
                            <p>Recent alerts from reservations and listing updates.</p>
                        </div>
                    </div>
                    <div class="widget-list">
                        @forelse ($latestOwnedReservations as $reservation)
                            <div class="widget-item">
                                <span class="widget-icon">
                                    <i class="bi {{ ($reservation['status'] ?? 'new') === 'accepted' ? 'bi-check2-circle' : 'bi-bell' }}" aria-hidden="true"></i>
                                </span>
                                <div class="widget-copy">
                                    <strong>{{ $reservation['client_name'] }}</strong>
                                    <p>{{ $reservation['property_name'] }} · {{ ucfirst($reservation['status']) }}</p>
                                    <span>{{ optional($reservation['submitted_at'])->diffForHumans() ?? 'Recently' }}</span>
                                </div>
                            </div>
                        @empty
                            <div class="empty-state">
                                <strong>No alerts right now</strong>
                                New reservations and updates will appear here.
                            </div>
                        @endforelse
                    </div>
                </section>

                <section class="dashboard-panel">
                    <div class="dashboard-panel-heading">
                        <div>
                            <h2>Task List</h2>
                            <p>Keep your admin workflow moving without losing the next step.</p>
                        </div>
                    </div>
                    <div class="task-list">
                        @foreach ($taskItems as $task)
                            <div class="task-item{{ $task['done'] ? ' is-complete' : '' }}">
                                <span class="task-check">
                                    <i class="bi {{ $task['done'] ? 'bi-check-lg' : 'bi-dot' }}" aria-hidden="true"></i>
                                </span>
                                <div class="task-copy">
                                    <strong>{{ $task['title'] }}</strong>
                                    <p>{{ $task['detail'] }}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </section>

                <section class="dashboard-panel dashboard-gradient-panel">
                    <div class="dashboard-panel-heading">
                        <div>
                            <h2>Top Performing Listing</h2>
                            <p>Best current performer based on reservation activity.</p>
                        </div>
                    </div>
                    @if ($topPerformingListing)
                        <div class="top-listing-card">
                            <div class="top-listing-copy">
                                <span class="dashboard-pill dashboard-pill-soft">
                                    <i class="bi bi-star-fill" aria-hidden="true"></i>
                                    Spotlight listing
                                </span>
                                <h3>{{ $topPerformingListing->name }}</h3>
                                <p>{{ $topPerformingListing->summary }}</p>
                            </div>
                            <div class="mini-stats-grid">
                                <div class="mini-stat">
                                    <small>Reservations</small>
                                    <strong>{{ $topListingReservations }}</strong>
                                </div>
                                <div class="mini-stat">
                                    <small>Accepted</small>
                                    <strong>{{ $acceptedReservations }}</strong>
                                </div>
                                <div class="mini-stat">
                                    <small>Conversion</small>
                                    <strong>{{ $conversionRate }}%</strong>
                                </div>
                                <div class="mini-stat">
                                    <small>New Alerts</small>
                                    <strong>{{ $newReservations }}</strong>
                                </div>
                            </div>
                            <a href="{{ route('details', ['slug' => $topPerformingListing->slug]) }}" class="btn btn-primary">
                                <i class="bi bi-arrow-up-right-circle" aria-hidden="true"></i>
                                <span>Open Listing</span>
                            </a>
                        </div>
                    @else
                        <div class="empty-state">
                            <strong>No performance data yet</strong>
                            Add listings and capture reservations to surface a top performer here.
                        </div>
                    @endif
                </section>
            </div>
        </aside>
    </div>
</section>
@endsection
