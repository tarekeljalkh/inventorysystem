@extends('layouts.master')

@section('content')
    <section class="section">
        <div class="section-header">
            <div class="section-header-back">
                <a href="{{ route('dashboard') }}" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
            </div>
            <h1>Users ({{ $users->count() }})</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{ route('dashboard') }}">Dashboard</a></div>
                <div class="breadcrumb-item"><a href="#">Users</a></div>
            </div>
        </div>

        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>All Users ({{ $users->count() }})</h4>
                            <div class="card-header-action">
                                <a href="{{ route('users.create') }}" class="btn btn-success">Create New <i
                                        class="fas fa-plus"></i></a>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="clients" class="display nowrap" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Role</th>
                                            <th>Checkouts</th>
                                            <th>Returns</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($users as $user)
                                            <tr>
                                                <td>{{ $user->name }}</td>
                                                <td>{{ $user->email }}</td>
                                                <td>{{ $user->role }}</td>
                                                <td>
                                                    @foreach ($user->checkouts as $checkout)
                                                        <a href="{{ route('checkouts.show', $checkout->id) }}">
                                                            <div class="badge badge-info">
                                                                Checkout ID: {{ $checkout->id }}
                                                                <br>
                                                                @foreach ($checkout->items as $item)
                                                                    {{ $item->name }} ({{ $item->pivot->quantity }}),
                                                                @endforeach
                                                            </div>
                                                        </a>
                                                    @endforeach
                                                </td>
                                                <td>
                                                    @foreach ($user->returnedCheckouts as $returned)
                                                        <a href="{{ route('checkouts.show', $returned->id) }}">
                                                            <div class="badge badge-info">
                                                                Checkout ID: {{ $returned->id }}
                                                                <br>
                                                                @foreach ($returned->items as $item)
                                                                    {{ $item->name }} ({{ $item->pivot->quantity }}),
                                                                @endforeach
                                                            </div>
                                                        </a>
                                                    @endforeach
                                                </td>

                                                <td>
                                                    <a href="{{ route('users.edit', $user->id) }}"
                                                        class="btn btn-primary"><i class="fas fa-pencil-alt"></i></a>
                                                    <a href="{{ route('users.destroy', $user->id) }}"
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
        new DataTable('#clients', {
            layout: {
                topStart: {
                    buttons: ['excel', 'pdf', 'print']
                }
            }
        });
    </script>
@endpush
