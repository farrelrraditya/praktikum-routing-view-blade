@extends('layouts.app')

@section('title', 'Home')

@section('content')

    <h1>Home</h1>
    <p>Selamat datang di portfolio saya.</p>

@endsection

@push('scripts')
<script>
    console.log('Home page loaded');
</script>
@endpush