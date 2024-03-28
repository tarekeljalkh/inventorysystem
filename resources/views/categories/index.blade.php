@extends('layouts.master')

@section('content')
    <section class="section">
        <div class="section-header">
            <div class="section-header-back">
                <a href="{{ route('dashboard') }}" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
            </div>
            <h1>Categories ({{ $categories->count() }})</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{ route('dashboard') }}">Dashboard</a></div>
                <div class="breadcrumb-item"><a href="#">Categories</a></div>
            </div>
        </div>

        <div class="section-body">

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>All Categories ({{ $categories->count() }})</h4>
                            <div class="card-header-action">
                                @if (auth()->user()->role == 'admin')

                                <a href="{{ route('categories.create') }}" class="btn btn-success">Create New <i
                                        class="fas fa-plus"></i></a>
                                    @endif
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="categories" class="display nowrap" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            @if (auth()->user()->role == 'admin')
                                                <th>Action</th>
                                            @endif
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($categories as $category)
                                            <tr>
                                                <td>{{ $category->name }}</td>
                                                @if (auth()->user()->role == 'admin')
                                                    <td>
                                                        <a href="{{ route('categories.edit', $category->id) }}"
                                                            class="btn btn-primary"><i class="fas fa-pencil-alt"></i></a>
                                                        <a href="{{ route('categories.destroy', $category->id) }}"
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
    <script>
        new DataTable('#categories', {
            layout: {
                topStart: {
                    buttons: ['excel', 'pdf', 'print']
                }
            }
        });
    </script>
@endpush
