@extends('layouts.app')

@section('title', 'DevEstate | Login')

@section('content')
<style>
    .password-field {
        position: relative;
    }

    .password-field .form-input {
        padding-right: 3.5rem;
    }

    .password-toggle {
        position: absolute;
        top: 50%;
        right: 0.85rem;
        transform: translateY(-50%);
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 2.5rem;
        height: 2.5rem;
        border: 0;
        background: transparent;
        color: var(--text-muted);
        cursor: pointer;
    }

    .password-toggle:hover,
    .password-toggle:focus-visible {
        color: var(--navy);
    }

    .password-toggle:focus-visible {
        outline: 2px solid rgba(212, 160, 23, 0.45);
        outline-offset: 2px;
        border-radius: 999px;
    }

    .password-toggle i {
        font-size: 1.1rem;
        line-height: 1;
    }
</style>
<div class="hero-card hero-card-login">
    <div class="hero-content">
        <span class="hero-eyebrow">Real Estate Agent Access</span>
        <h1 class="hero-title hero-title-login">Agent login for listing and property management.</h1>
        <p class="hero-copy hero-copy-login">Sign in as an agent to add house listings, update property information, and manage client-facing inventory.</p>
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
                    <div class="password-field">
                        <input id="password" name="password" type="password" required autocomplete="current-password" class="form-input" />
                        <button type="button" class="password-toggle" data-password-toggle aria-label="Show password" aria-pressed="false">
                            <i class="bi bi-eye" aria-hidden="true"></i>
                        </button>
                    </div>
                </div>
                <div class="login-action-row" style="display:flex; align-items:center; gap:0.75rem; flex-wrap:wrap;">
                    <button type="submit" class="btn btn-primary btn-login">Sign In</button>
                </div>
                <p class="form-note">
                    No account yet?
                    <a href="{{ route('register.admin') }}" style="font-weight: 700; color: var(--navy);">Create admin account</a>
                </p>
            </form>
        </div>
    </div>
</div>
<script>
    (() => {
        const passwordInput = document.querySelector('#password');
        const passwordToggle = document.querySelector('[data-password-toggle]');

        if (!passwordInput || !passwordToggle) {
            return;
        }

        const toggleIcon = passwordToggle.querySelector('i');

        passwordToggle.addEventListener('click', () => {
            const isHidden = passwordInput.type === 'password';

            passwordInput.type = isHidden ? 'text' : 'password';
            passwordToggle.setAttribute('aria-label', isHidden ? 'Hide password' : 'Show password');
            passwordToggle.setAttribute('aria-pressed', isHidden ? 'true' : 'false');

            if (toggleIcon) {
                toggleIcon.className = isHidden ? 'bi bi-eye-slash' : 'bi bi-eye';
            }
        });
    })();
</script>
@endsection
