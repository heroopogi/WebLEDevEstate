<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title ?? 'DevEstate' }}</title>
    <style>
        :root {
            --navy: #1E3A5F;
            --gold: #D4A017;
            --bg: #F5F7FA;
            --card: #FFFFFF;
            --text: #1F2937;
            --muted: #475569;
            --border: #E2E8F0;
            --radius: 16px;
        }
        * { box-sizing: border-box; }
        body { margin: 0; font-family: Manrope, Arial, sans-serif; background: var(--bg); color: var(--text); }
        a { text-decoration: none; color: inherit; }
        .container { width: min(1100px, calc(100% - 2rem)); margin: 0 auto; }
        .site-header { background: var(--navy); color: #fff; position: sticky; top: 0; }
        .topbar { min-height: 72px; display: flex; align-items: center; justify-content: space-between; gap: 1rem; }
        .brand { font-weight: 800; letter-spacing: .03em; }
        .nav { display: flex; flex-wrap: wrap; gap: .75rem; }
        .nav a { padding: .45rem .7rem; border-radius: 999px; background: rgba(255,255,255,.12); font-size: .88rem; }
        main { padding: 2rem 0 4rem; }
        .grid { display: grid; gap: 1rem; }
        .grid-2 { grid-template-columns: repeat(2, minmax(0, 1fr)); }
        .grid-3 { grid-template-columns: repeat(3, minmax(0, 1fr)); }
        .card { background: var(--card); border: 1px solid var(--border); border-radius: var(--radius); padding: 1.2rem; }
        .eyebrow { color: var(--gold); font-weight: 800; text-transform: uppercase; font-size: .8rem; letter-spacing: .08em; margin: 0; }
        h1, h2, h3 { color: var(--navy); margin: .35rem 0 .6rem; }
        p { color: var(--muted); line-height: 1.6; margin: 0; }
        .meta { margin-top: .8rem; display: flex; flex-wrap: wrap; gap: .5rem; }
        .meta span { background: #E2E8F0; border-radius: 999px; padding: .3rem .65rem; font-size: .8rem; color: #334155; font-weight: 700; }
        .price { color: var(--gold); font-weight: 800; font-size: 1.2rem; }
        .actions { margin-top: 1rem; display: flex; gap: .6rem; flex-wrap: wrap; }
        .btn { border-radius: 10px; padding: .55rem .85rem; font-weight: 700; }
        .btn-primary { background: var(--navy); color: #fff; }
        .btn-accent { background: var(--gold); color: #fff; }
        .footer { color: #64748B; text-align: center; padding: 1.5rem 0 2.5rem; font-size: .9rem; }
        @media (max-width: 900px) { .grid-2, .grid-3 { grid-template-columns: 1fr; } }
    </style>
</head>
<body>
<header class="site-header">
    <div class="container topbar">
        <a class="brand" href="{{ route('home.index') }}">DevEstate</a>
        <nav class="nav">
            <a href="{{ route('home.index') }}">Home</a>
            <a href="{{ route('listings.index') }}">Listings</a>
            <a href="{{ route('details.index') }}">Details</a>
            <a href="{{ route('maps.index') }}">Map</a>
            <a href="{{ route('admin-uploads.index') }}">Admin Upload</a>
            <a href="{{ route('dashboards.index') }}">Dashboard</a>
            <a href="{{ route('logins.index') }}">Login</a>
            <a href="{{ route('mobiles.index') }}">Mobile</a>
        </nav>
    </div>
</header>
<main>
    <div class="container">
        @yield('content')
    </div>
</main>
<footer class="footer">DevEstate section pages split into database-backed Laravel views.</footer>
</body>
</html>
