@extends('layouts.master')
@push('css')
    @livewireStyles
@endpush

@section('content')
    <section class="section">
        <div class="section-header">
            <div class="section-header-back">
                <a href="{{ route('dashboard') }}" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
            </div>
            <h1>Checkout Items</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{ route('dashboard') }}">Dashboard</a></div>
                <div class="breadcrumb-item"><a href="#">Checkout Items</a></div>
            </div>

        </div>

        <div class="section-body">
            <div class="row">
                <!-- The Livewire component will be responsible for rendering the product grid and cart inside these containers -->
                @livewire('point-of-sale')
            </div>
        </div>
    </section>
@endsection
@push('scripts')
    @livewireScripts
@endpush
