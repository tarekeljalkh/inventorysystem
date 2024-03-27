@extends('layouts.master')

@section('content')
    <section class="section">
        <div class="section-header">
            <div class="section-header-back">
                <a href="{{ route('dashboard') }}" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
            </div>
            <h1>Checkout Items</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{ route('dashboard') }}">Dashboard</a></div>
                <div class="breadcrumb-item">Checkout Items</div>
            </div>
        </div>

        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>All Checkout Transactions</h4>
                            <div class="card-header-action">
                                <a href="{{ route('checkouts.create') }}" class="btn btn-success">Checkout New <i
                                        class="fas fa-plus"></i></a>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="checkouts" class="display nowrap" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>Checkout ID</th>
                                            <th>Client Name</th>
                                            <th>Checkout By</th>
                                            <th>Date</th>
                                            <th>Items Count</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($checkouts as $checkout)
                                            <tr>
                                                <td>{{ $checkout->id }}</td>
                                                <td>{{ $checkout->client->name }}</td>
                                                <td>{{ $checkout->user->name }}</td>
                                                <td>{{ $checkout->created_at->format('d-m-Y') }}</td>
                                                <td>
                                                    @foreach ($checkout->items as $item)
                                                        <span class="badge badge-info">{{ $item->name }}
                                                            ({{ $item->pivot->quantity }})</span>
                                                    @endforeach
                                                </td>
                                                <td>
                                                    <a href="{{ route('checkouts.show', $checkout->id) }}"
                                                        class="btn btn-info"><i class="fas fa-eye"></i> View</a>
                                                    <form action="{{ route('return_to_stock', $checkout->id) }}"
                                                        method="POST" style="display:inline-block;">
                                                        @csrf
                                                        <button type="submit"
                                                            class="btn btn-warning return-to-stock">Return to Stock</button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection


@push('scripts')
    <script>
        new DataTable('#checkouts', {
            layout: {
                topStart: {
                    buttons: ['excel', 'pdf', 'print']
                }
            }
        });
    </script>
@endpush
