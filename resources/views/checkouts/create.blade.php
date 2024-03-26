@extends('layouts.master')

@section('content')
<section class="section">
    <div class="section-header">
        <div class="section-header-back">
            <a href="{{ route('dashboard') }}" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
        </div>
        <h1>Check Out Items</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="{{ route('dashboard') }}">Dashboard</a></div>
            <div class="breadcrumb-item"><a href="{{ route('items.index') }}">Items</a></div>
            <div class="breadcrumb-item">Check Out</div>
        </div>
    </div>

    <div class="section-body">
        <div class="row">
            <div class="col-12 col-md-12 col-lg-12">
                <div class="card">
                    <form action="{{ route('checkouts.store') }}" method="POST">
                        @csrf
                        <div class="card-header">
                            <h4>Select Items and Client</h4>
                        </div>
                        <div class="card-body">
                            {{-- Items Selection Section --}}
                            @foreach ($items as $item)
                            <div class="form-group">
                                <label>{{ $item->name }} (Available: {{ $item->quantity }})</label>
                                <input type="number" name="items[{{ $item->id }}]" class="form-control" placeholder="Quantity" min="0" max="{{ $item->quantity }}">
                            </div>
                            @endforeach

                            {{-- Client Selection --}}
                            <div class="form-group">
                                <label for="client_id">Client:</label>
                                <select name="client_id" id="client_id" class="form-control" required>
                                    @foreach ($clients as $client)
                                    <option value="{{ $client->id }}">{{ $client->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="card-footer text-right">
                            <button type="submit" class="btn btn-primary">Check Out</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
