@extends('layouts.app', ['title' => 'DevEstate | Login'])

@section('content')
<div class="card">
    <p class="eyebrow">Login Page</p>
    <h1>{{ $login->headline }}</h1>
    <p>{{ $login->subheadline }}</p>
    <div class="grid grid-2" style="margin-top:1rem;">
        <div class="card">
            <h3>Email</h3>
            <p>{{ $login->email_hint }}</p>
        </div>
        <div class="card">
            <h3>Password</h3>
            <p>{{ $login->password_hint }}</p>
        </div>
    </div>
</div>
@endsection
