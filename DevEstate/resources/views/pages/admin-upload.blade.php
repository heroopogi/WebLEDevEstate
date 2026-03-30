@extends('layouts.app', ['title' => 'DevEstate | Admin Upload'])

@section('content')
<div class="card">
    <p class="eyebrow">Admin Upload Page</p>
    <h1>Media Standards</h1>
    <p>{{ $adminUpload->success_message }}</p>
    <div class="grid grid-2" style="margin-top:1rem;">
        <div class="card">
            <h3>Recommended Format</h3>
            <p>{{ $adminUpload->recommended_format }}</p>
        </div>
        <div class="card">
            <h3>Resolution</h3>
            <p>{{ $adminUpload->recommended_resolution }}</p>
        </div>
    </div>
    <div class="actions"><a class="btn btn-primary" href="{{ route('dashboards.index') }}">Go To Dashboard</a></div>
</div>
@endsection
