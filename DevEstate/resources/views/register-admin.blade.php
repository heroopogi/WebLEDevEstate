@extends('layouts.app')

@section('title', 'DevEstate | Create Admin Account')

@section('content')
<div class="hero-card hero-card-login">
    <div class="hero-content">
        <span class="hero-eyebrow">Admin Account Setup</span>
        <h1 class="hero-title hero-title-login">Create your admin account to manage listings.</h1>
        <p class="hero-copy hero-copy-login">Set up your credentials once, then sign in to access the dashboard, reservations, and listing management tools.</p>
        <div class="hero-links">
            <a href="{{ route('login') }}" class="btn btn-secondary">Back to Login</a>
            <a href="{{ route('home') }}" class="btn btn-primary">Client Home</a>
        </div>
    </div>
    <div class="hero-panel hero-panel-login">
        <div class="search-panel search-panel-login">
            <h2 class="login-title">Create Admin Account</h2>
            <p class="login-subtitle">Enter your details below to create a new admin account.</p>

            @if ($errors->any())
                <div class="alert">{{ $errors->first() }}</div>
            @endif

            <form method="POST" action="{{ route('register.admin.submit') }}" class="login-form">
                @csrf
                <div class="form-group">
                    <label for="username" class="form-label">Username</label>
                    <input id="username" name="username" type="text" value="{{ old('username') }}" required class="form-input" />
                </div>

                <div class="form-group">
                    <label for="full_name" class="form-label">Full Name</label>
                    <input id="full_name" name="full_name" type="text" value="{{ old('full_name') }}" required class="form-input" />
                </div>

                <div class="form-group">
                    <label for="password" class="form-label">Password</label>
                    <input id="password" name="password" type="password" required class="form-input" />
                </div>

                <div class="form-group">
                    <label for="password_confirmation" class="form-label">Confirm Password</label>
                    <input id="password_confirmation" name="password_confirmation" type="password" required class="form-input" />
                </div>

                <button type="submit" class="btn btn-primary btn-login">Create Account</button>
            </form>
        </div>
    </div>
</div>
@endsection
