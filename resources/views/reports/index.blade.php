@extends('layouts.master')

@section('content')
<section class="section">
    <div class="section-header">
        <div class="section-header-back">
            <a href="{{ route('dashboard') }}" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
        </div>
        <h1>Reports</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="{{ route('dashboard') }}">Dashboard</a></div>
            <div class="breadcrumb-item">Reports</div>
        </div>
    </div>

    <div class="section-body">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4>Filter Report</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('reports.index') }}" method="GET">
                        <div class="row">
                            <div class="form-group col-md-4">
                                <label for="start_date">From:</label>
                                <input type="date" id="start_date" name="start_date" class="form-control" value="{{ request('start_date') }}">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="end_date">To:</label>
                                <input type="date" id="end_date" name="end_date" class="form-control" value="{{ request('end_date') }}">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="client_id">Select Client:</label>
                                <select id="client_id" name="client_id" class="form-control select2">
                                    <option value="">All Clients</option>
                                    @foreach ($clients as $client)
                                        <option value="{{ $client->id }}" @if (request('client_id') == $client->id) selected @endif>
                                            {{ $client->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Filter</button>
                    </form>
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="reports" style="width:100%">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Client</th>
                                    <th>Checkout By</th>
                                    <th>Items, Returns, & Check-ins</th>
                                    <th>Date</th>
                                    <th>Returned By</th>
                                    <th>Return Date</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($filteredCheckouts as $checkout)
                                    <tr>
                                        <td>{{ $checkout->id }}</td>
                                        <td>{{ $checkout->client->name }}</td>
                                        <td>{{ $checkout->checkout_user }}</td>
                                        <td>
                                            @foreach ($checkout->items as $item)
                                                @php
                                                    $remaining = $item->pivot->quantity - $item->pivot->returned_quantity;
                                                @endphp
                                                <div>
                                                    <span>{{ $item->name }} - Checked Out: {{ $item->pivot->quantity }}</span>
                                                    <br><span class="text-warning">Remaining: {{ $remaining }}</span>
                                                    @if (!empty($item->pivot->notes))
                                                        <br><small>Notes: {{ $item->pivot->notes }}</small>
                                                    @endif
                                                </div>
                                            @endforeach
                                        </td>
                                        <td>{{ $checkout->created_at->format('d-m-Y') }}</td>
                                        <td>{{ $checkout->returned_by_user ?? 'Not Returned Yet' }}</td>
                                        <td>{{ $checkout->return_date ? \Carbon\Carbon::parse($checkout->return_date)->format('d-m-Y') : 'Not Returned Yet' }}</td>
                                        <td>
                                            <a href="{{ route('checkouts.show', $checkout->id) }}" class="btn btn-info btn-sm"><i class="fas fa-eye"></i> View</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        $('#reports').DataTable({
            responsive: true,
            "scrollX": true,
            dom: 'Bfrtip', // Define the DataTables elements
            buttons: [
                'excel', 'pdf', 'print'
            ]
        });
    });
</script>
@endpush
