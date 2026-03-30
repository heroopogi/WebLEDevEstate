@extends('layouts.app', ['title' => 'DevEstate | Mobile'])

@section('content')
<div class="card">
    <p class="eyebrow">Mobile Page</p>
    <h1>{{ $mobile->property_name }}</h1>
    <p>{{ $mobile->description }}</p>
    <div class="meta">
        <span>{{ $mobile->tag_one }}</span>
        <span>{{ $mobile->tag_two }}</span>
        <span>{{ $mobile->active_tab }} tab active</span>
    </div>
    <div class="actions"><span class="price">${{ number_format((float) $mobile->price, 0) }}</span></div>
</div>
@endsection
