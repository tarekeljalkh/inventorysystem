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
                                @if (auth()->user()->role == 'admin')
                                    <a href="{{ route('items.create') }}" class="btn btn-success">Create New <i
                                            class="fas fa-plus"></i></a>

                                    <a href="{{ route('items.import.index') }}" class="btn btn-info">Import Excel <i
                                            class="fas fa-upload"></i></a>


                                    <a href="{{ route('categories.items.export') }}" class="btn btn-warning">Export To Excel
                                        Sheet <i class="fas fa-download"></i></a>
                                @endif
                            </div>
                        </div>
                        <div class="card-body">
                            @if (auth()->user()->role == 'admin')
                                <div class="mb-3">
                                    <label for="category_filter" class="form-label">Filter by Category:</label>
                                    <select id="category_filter" class="form-select">
                                        <option value="">All Categories</option>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            @endif
                            <div class="table-responsive">
                                <table id="items" class="display nowrap" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Quantity</th>
                                            <th>Out Quantity</th>
                                            <th>Category</th>
                                            <th>Image</th>
                                            @if (auth()->user()->role == 'admin')
                                                <th>Action</th>
                                            @endif
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($items as $item)
                                            <tr data-category-id="{{ $item->category_id }}">
                                                <td>{{ $item->name }}</td>
                                                <td>{{ $item->quantity }}</td>
                                                <td>{{ $item->out_quantity }}</td>
                                                <td>{{ $item->category->name }}</td>
                                                <td>
                                                    @if ($item->image)
                                                        <img style="width: 50px" src="{{ asset($item->image) }}">
                                                    @else
                                                        <img style="width: 50px" src="{{ asset('uploads/no_image.png') }}">
                                                    @endif
                                                </td>
                                                @if (auth()->user()->role == 'admin')
                                                    <td>
                                                        <a href="{{ route('items.edit', $item->id) }}"
                                                            class="btn btn-primary"><i class="fas fa-pencil-alt"></i></a>
                                                        <a href="{{ route('items.destroy', $item->id) }}"
                                                            class="btn btn-danger delete-item"><i
                                                                class="fas fa-trash"></i></a>
                                                    </td>
                                                @endif
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
    @if (auth()->user()->role == 'admin')
        <script>
            $(document).ready(function() {
                // Category filter functionality
                $('#category_filter').change(function() {
                    var categoryId = $(this).val();
                    $('#items tbody tr').each(function() {
                        if (categoryId === '' || $(this).data('category-id') == categoryId) {
                            $(this).show();
                        } else {
                            $(this).hide();
                        }
                    });
                });

                // DataTable initialization with explicit column definitions
                var table = $('#items').DataTable({
                    dom: 'Bfrtip', // Defines the table control elements to appear on the page
                    buttons: [
                        'excel', 'pdf', 'print'
                    ],
                    columnDefs: [{
                            targets: [0, 1, 2, 3],
                            sortable: true
                        }, // Enable sorting on all columns except 'Action'
                        {
                            targets: [4],
                            sortable: false,
                            orderable: false
                        } // Disables sorting on 'Action' column if present
                    ],
                    order: [
                        [2, 'asc']
                    ] // Default sorting on the Category column
                });

                // Attach to the Excel button a pre-sorting functionality, if necessary
                table.buttons().container().on('click', 'button', function() {
                    let button = table.button($(this).index());
                    if (button.node().className.indexOf('buttons-excel') !== -1) {
                        table.order([
                            [2, 'asc']
                        ]).draw();
                    }
                });
            });
        </script>
    @else
        <script>
            new DataTable('#items', {
                layout: {
                    topStart: {
                        buttons: ['excel', 'pdf', 'print']
                    }
                }
            });
        </script>
    @endif
@endpush

{{--
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
@endpush --}}
