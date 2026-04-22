@extends('layouts.app')

@section('title', 'DevEstate | Login')

@section('content')
<div class="hero-card hero-card-login">
    <div class="hero-content">
        <span class="hero-eyebrow">Real Estate Agent Access</span>
        <h1 class="hero-title hero-title-login">Agent login for listing and property management.</h1>
        <p class="hero-copy hero-copy-login">Sign in as an agent to add house listings, update property information, and manage client-facing inventory.</p>
        <div class="hero-links">
            <a href="{{ route('home') }}" class="btn btn-secondary">Client Home</a>
            <a href="{{ route('listings') }}" class="btn btn-primary">Browse Client Listings</a>
        </div>
    </div>
    <div class="hero-panel hero-panel-login">
        <div class="search-panel search-panel-login">
            <h2 class="login-title">Agent Sign In</h2>
            <p class="login-subtitle">Enter your agent credentials to open the admin dashboard.</p>
            @if (session('status'))
                <div class="alert" style="margin-bottom: 1rem; background: #DCFCE7; border-color: #BBF7D0; color: #166534;">
                    {{ session('status') }}
                </div>
            @endif
            @if ($errors->any())
                <div class="alert">{{ $errors->first() }}</div>
            @endif
            <form method="POST" action="{{ route('login.submit') }}" class="login-form">
                @csrf
                <div class="form-group">
                    <label for="username" class="form-label">Username</label>
                    <input id="username" name="username" type="text" value="{{ old('username') }}" required autofocus class="form-input" />
                </div>
                <div class="form-group">
                    <label for="password" class="form-label">Password</label>
                    <input id="password" name="password" type="password" required autocomplete="current-password" class="form-input" />
                </div>
                <button type="submit" class="btn btn-primary btn-login">Sign In</button>
                <p class="form-note">
                    No account yet?
                    <a href="{{ route('register.admin') }}" style="font-weight: 700; color: var(--navy);">Create admin account</a>
                </p>
            </form>
        </div>
    </div>
</div>
@endsection
