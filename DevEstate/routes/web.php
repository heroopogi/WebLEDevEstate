<?php

use App\Models\Property;
use App\Models\Reservation;
use App\Models\User;
use App\Http\Controllers\PropertyController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group.
|
*/

Route::get('/', function () {
    if (session('logged_in')) {
        return redirect()->route('properties');
    }
    return view('guest-dashboard');
})->name('home');

Route::get('/login', function () {
    if (session('logged_in')) {
        return redirect()->route('properties');
    }
    return view('login');
})->name('login');

Route::get('/register-admin', function () {
    if (session('logged_in')) {
        return redirect()->route('properties');
    }

    return view('register-admin');
})->name('register.admin');

Route::post('/login', function (Request $request) {
    $request->validate([
        'username' => 'required|string',
        'password' => 'required|string',
    ]);

    if (!User::query()->exists()) {
        return redirect()
            ->route('register.admin')
            ->with('status', 'Create your first admin account before signing in.');
    }

    $username = trim((string) $request->input('username'));
    $user = User::query()
        ->where(function ($query) use ($username) {
            $query->whereRaw('LOWER(name) = LOWER(?)', [$username])
                ->orWhereRaw('LOWER(full_name) = LOWER(?)', [$username])
                ->orWhereRaw('LOWER(email) = LOWER(?)', [$username]);
        })
        ->first();

    if ($user && Hash::check($request->input('password'), $user->password)) {
        $request->session()->put('logged_in', true);
        $request->session()->put('username', $user->full_name ?: $user->name);
        $request->session()->put('user_id', $user->id);

        return redirect()->route('properties');
    }

    return back()->withErrors(['credentials' => 'Invalid username or password'])->withInput();
})->name('login.submit');

Route::post('/register-admin', function (Request $request) {
    $validated = $request->validate([
        'username' => 'required|string|max:255|unique:users,name',
        'full_name' => 'required|string|max:255',
        'password' => 'required|string|min:6|confirmed',
    ]);

    $baseEmail = Str::slug($validated['username'], '.') . '@devestate.local';
    $generatedEmail = $baseEmail;
    $counter = 1;

    while (User::where('email', $generatedEmail)->exists()) {
        $generatedEmail = Str::slug($validated['username'], '.') . '+' . $counter . '@devestate.local';
        $counter++;
    }

    User::create([
        'name' => $validated['username'],
        'full_name' => $validated['full_name'],
        'email' => $generatedEmail,
        'password' => Hash::make($validated['password']),
    ]);

    return redirect()
        ->route('login')
        ->with('status', 'Admin account created successfully. You can now sign in.');
})->name('register.admin.submit');

Route::post('/logout', function (Request $request) {
    $request->session()->flush();
    return redirect()->route('home');
})->name('logout');

Route::get('/properties', function () {
    if (!session('logged_in')) {
        return redirect()->route('home');
    }

    $currentUserId = session('user_id');

    if (!$currentUserId) {
        return redirect()->route('login');
    }

    $properties = Property::where('user_id', $currentUserId)->latest()->get();
    $activeListings = $properties->count();

    $totalPortfolioValue = $properties->sum(function ($property) {
        $numericPrice = preg_replace('/[^0-9.]/', '', $property->price);

        return is_numeric($numericPrice) ? (float) $numericPrice : 0;
    });

    $averageListingPrice = $activeListings > 0
        ? $totalPortfolioValue / $activeListings
        : 0;

    $newThisMonth = $properties->filter(function ($property) {
        return optional($property->created_at)->isCurrentMonth();
    })->count();

    $recentProperties = $properties->take(3);
    $ownedSlugs = $properties->pluck('slug')->all();
    $ownedReservations = Reservation::query()
        ->whereIn('property_slug', $ownedSlugs)
        ->orderByDesc('submitted_at')
        ->get();
    $unreadReservations = Reservation::query()
        ->whereIn('property_slug', $ownedSlugs)
        ->where('is_read', false)
        ->count();
    $recentActivity = $properties
        ->sortByDesc(fn ($property) => optional($property->updated_at)->timestamp ?? 0)
        ->take(4)
        ->values()
        ->map(function ($property) {
            $createdAt = $property->created_at;
            $updatedAt = $property->updated_at ?? $createdAt;
            $wasUpdated = $createdAt && $updatedAt && $updatedAt->diffInMinutes($createdAt) > 1;

            return [
                'title' => $wasUpdated ? 'Updated listing details' : 'Added a new property',
                'description' => ($wasUpdated ? 'Saved fresh changes to ' : 'Published ') . $property->name,
                'timestamp' => $updatedAt,
                'url' => route('details', ['slug' => $property->slug]),
                'icon' => $wasUpdated ? 'bi-pencil-square' : 'bi-house-add',
            ];
        });
    $listingTrend = collect(range(5, 0))
        ->map(function ($monthsAgo) use ($properties) {
            $month = now()->copy()->startOfMonth()->subMonths($monthsAgo);
            $count = $properties->filter(function ($property) use ($month) {
                return optional($property->created_at)?->format('Y-m') === $month->format('Y-m');
            })->count();

            return [
                'label' => $month->format('M'),
                'full_label' => $month->format('F Y'),
                'count' => $count,
            ];
        });
    $latestOwnedReservations = $ownedReservations->take(3)->map(function ($reservation) {
        return [
            'client_name' => $reservation->client_name ?: 'Unknown client',
            'property_name' => $reservation->property_name ?: 'Unknown property',
            'status' => $reservation->status ?: 'new',
            'submitted_at' => $reservation->submitted_at,
        ];
    });
    $topPerformingListing = $properties
        ->sortByDesc(function ($property) use ($ownedReservations) {
            return $ownedReservations->where('property_slug', $property->slug)->count();
        })
        ->first();
    $topListingReservations = $topPerformingListing
        ? $ownedReservations->where('property_slug', $topPerformingListing->slug)->count()
        : 0;
    $acceptedReservations = $ownedReservations->where('status', 'confirmed')->count();
    $newReservations = $ownedReservations->where('status', 'new')->count();
    $conversionRate = $ownedReservations->count() > 0
        ? round(($acceptedReservations / $ownedReservations->count()) * 100)
        : 0;
    $taskItems = collect([
        [
            'title' => 'Add your next property',
            'detail' => $activeListings > 0 ? 'Keep your portfolio fresh with a new listing.' : 'Start populating the platform with your first listing.',
            'done' => $activeListings > 0,
        ],
        [
            'title' => 'Review reservation requests',
            'detail' => $unreadReservations > 0 ? $unreadReservations . ' unread reservation' . ($unreadReservations > 1 ? 's' : '') . ' need attention.' : 'No unread reservations right now.',
            'done' => $unreadReservations === 0,
        ],
        [
            'title' => 'Complete listing media',
            'detail' => $properties->contains(fn ($property) => str_contains((string) $property->image, 'listings/'))
                ? 'Custom uploaded listing photos are already in use.'
                : 'Upload custom listing photos to strengthen presentation.',
            'done' => $properties->contains(fn ($property) => str_contains((string) $property->image, 'listings/')),
        ],
    ]);

    return view('dashboard', [
        'activeListings' => $activeListings,
        'newThisMonth' => $newThisMonth,
        'averageListingPrice' => $averageListingPrice,
        'totalPortfolioValue' => $totalPortfolioValue,
        'recentProperties' => $recentProperties,
        'recentActivity' => $recentActivity,
        'listingTrend' => $listingTrend,
        'latestOwnedReservations' => $latestOwnedReservations,
        'topPerformingListing' => $topPerformingListing,
        'topListingReservations' => $topListingReservations,
        'acceptedReservations' => $acceptedReservations,
        'newReservations' => $newReservations,
        'conversionRate' => $conversionRate,
        'taskItems' => $taskItems,
        'unreadReservations' => $unreadReservations,
    ]);
})->name('properties');

Route::get('/listings', [PropertyController::class, 'index'])->name('listings');
Route::get('/listings/create', [PropertyController::class, 'create'])->name('listings.create');
Route::post('/listings', [PropertyController::class, 'store'])->name('listings.store');
Route::get('/listings/{slug}/edit', [PropertyController::class, 'edit'])->name('listings.edit');
Route::put('/listings/{slug}', [PropertyController::class, 'update'])->name('listings.update');
Route::delete('/listings/{slug}', [PropertyController::class, 'destroy'])->name('listings.destroy');

Route::get('/details/{slug}', [PropertyController::class, 'show'])->name('details');
Route::post('/reservations', function (Request $request) {
    $validated = $request->validate([
        'slug' => 'required|string|exists:properties,slug',
        'client_name' => 'required|string|max:255',
        'contact_number' => ['required', 'digits:10'],
    ]);

    $property = Property::where('slug', $validated['slug'])->firstOrFail();

    Reservation::create([
        'id' => (string) Str::uuid(),
        'property_id' => $property->id,
        'property_slug' => $property->slug,
        'property_name' => $property->name,
        'client_name' => $validated['client_name'],
        'contact_number' => '+63'.$validated['contact_number'],
        'submitted_at' => now()->toDateTimeString(),
        'is_read' => false,
        'status' => 'new',
    ]);

    return redirect()
        ->route('details', ['slug' => $property->slug])
        ->with('reservation_status', 'Reservation request sent successfully. Our team will contact you soon.');
})->name('reservations.store');

Route::get('/reservations', function () {
    if (!session('logged_in')) {
        return redirect()->route('login');
    }

    $currentUserId = session('user_id');

    if (!$currentUserId) {
        return redirect()->route('login');
    }

    $ownedSlugs = Property::where('user_id', $currentUserId)->pluck('slug')->all();

    $reservations = Reservation::query()
        ->whereIn('property_slug', $ownedSlugs)
        ->orderByDesc('submitted_at')
        ->get();

    if ($reservations->where('is_read', false)->isNotEmpty()) {
        Reservation::query()
            ->whereIn('property_slug', $ownedSlugs)
            ->where('is_read', false)
            ->update(['is_read' => true]);

        $reservations = Reservation::query()
            ->whereIn('property_slug', $ownedSlugs)
            ->orderByDesc('submitted_at')
            ->get();
    }

    return view('reservations', [
        'activeReservations' => $reservations->where('status', '!=', 'done')->values(),
        'reservationHistory' => $reservations->where('status', 'done')->values(),
    ]);
})->name('reservations');

Route::post('/reservations/{id}/confirm', function (string $id) {
    if (!session('logged_in')) {
        return redirect()->route('login');
    }

    $currentUserId = session('user_id');

    if (!$currentUserId) {
        return redirect()->route('login');
    }

    $ownedSlugs = Property::where('user_id', $currentUserId)->pluck('slug')->all();

    $confirmedReservation = Reservation::query()->find($id);

    if (
        !$confirmedReservation
        || !in_array($confirmedReservation->property_slug ?? '', $ownedSlugs, true)
    ) {
        return redirect()
            ->route('reservations')
            ->withErrors(['reservation' => 'You are not allowed to confirm this reservation.']);
    }

    $confirmedReservation->update([
        'status' => 'confirmed',
        'is_read' => true,
        'confirmed_at' => now(),
    ]);

    return redirect()
        ->route('reservations')
        ->with('status', 'Appointment confirmed successfully.');
})->name('reservations.confirm');

Route::post('/reservations/{id}/done', function (string $id) {
    if (!session('logged_in')) {
        return redirect()->route('login');
    }

    $currentUserId = session('user_id');

    if (!$currentUserId) {
        return redirect()->route('login');
    }

    $ownedSlugs = Property::where('user_id', $currentUserId)->pluck('slug')->all();

    $completedReservation = Reservation::query()->find($id);

    if (
        !$completedReservation
        || !in_array($completedReservation->property_slug ?? '', $ownedSlugs, true)
    ) {
        return redirect()
            ->route('reservations')
            ->withErrors(['reservation' => 'You are not allowed to complete this reservation.']);
    }

    $completedReservation->update([
        'status' => 'done',
        'is_read' => true,
        'done_at' => now(),
    ]);

    return redirect()
        ->route('reservations')
        ->with('status', 'Appointment marked as done.');
})->name('reservations.done');
