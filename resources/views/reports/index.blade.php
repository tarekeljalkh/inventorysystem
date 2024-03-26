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
                <div class="breadcrumb-item"><a href="#">Reports</a></div>
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
                                    <input type="date" id="start_date" name="start_date" class="form-control"
                                        value="{{ request('start_date') }}">
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="end_date">To:</label>
                                    <input type="date" id="end_date" name="end_date" class="form-control"
                                        value="{{ request('end_date') }}">
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="client_id">Client:</label>
                                    <select id="client_id" name="client_id" class="form-control select2">
                                        <option value="">Select Client</option>
                                        @foreach ($clients as $client)
                                            <option value="{{ $client->id }}"
                                                @if (request('client_id') == $client->id) selected @endif>
                                                {{ $client->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary">Filter</button>
                        </form>
                    </div>


                    <div class="card-body">

                        <div class="table-responsive">
                            <table id="reports" class="display nowrap" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Client</th>
                                        <th>Items Count</th>
                                        <th>Date</th>
                                        <th>Return Date</th>
                                        <!-- Add more columns as needed -->
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($filteredCheckouts as $checkout)
                                        <tr>
                                            <td>{{ $checkout->id }}</td>
                                            <td>{{ $checkout->client->name }}</td>
                                            <td>
                                                @foreach ($checkout->items as $item)
                                                    <span class="badge badge-info">{{ $item->name }}
                                                        ({{ $item->pivot->quantity }})
                                                    </span>
                                                @endforeach
                                            </td>

                                            <td>{{ $checkout->created_at->format('d-m-Y') }}</td>
                                            <td>
                                                @if (isset($checkout->return_date))
                                                    {{ Carbon\Carbon::parse($checkout->return_date)->format('d-m-Y') }}
                                                @else
                                                    <span class="badge badge-primary">Not Returned Yet</span>
                                                @endif
                                            </td>
                                            <!-- Add more columns as needed -->
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
        new DataTable('#reports', {
            layout: {
                topStart: {
                    buttons: ['excel', 'pdf', 'print']
                }
            }
        });
    </script>
@endpush
