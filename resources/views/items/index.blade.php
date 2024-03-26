@extends('layouts.master')

@section('content')
    <section class="section">
        <div class="section-header">
            <div class="section-header-back">
                <a href="{{ route('dashboard') }}" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
            </div>
            <h1>Items ({{ $items->count() }})</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{ route('dashboard') }}">Dashboard</a></div>
                <div class="breadcrumb-item"><a href="#">Items</a></div>
            </div>
        </div>

        <div class="section-body">

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>All Items ({{ $items->count() }})</h4>
                            <div class="card-header-action">

                                <a href="{{ route('items.create') }}" class="btn btn-success">Create New <i
                                        class="fas fa-plus"></i></a>

                                <a href="{{ route('items.import.index') }}" class="btn btn-info">Import Excel <i
                                        class="fas fa-upload"></i></a>

                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="items" class="display nowrap" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Quantity</th>
                                            <th>Image</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($items as $item)
                                            <tr>
                                                <td>{{ $item->name }}</td>
                                                <td>{{ $item->quantity }}</td>
                                                <td>
                                                    @if ($item->image)
                                                        <img style="width: 50px" src="{{ asset($item->image) }}">
                                                    @else
                                                        <span class="badge badge-info">No Image</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    <a href="{{ route('items.edit', $item->id) }}"
                                                        class="btn btn-primary"><i class="fas fa-pencil-alt"></i></a>
                                                    <a href="{{ route('items.destroy', $item->id) }}"
                                                        class="btn btn-danger delete-item"><i class="fas fa-trash"></i></a>
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
        new DataTable('#items', {
            layout: {
                topStart: {
                    buttons: ['excel', 'pdf', 'print']
                }
            }
        });
    </script>
@endpush
