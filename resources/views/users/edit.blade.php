@extends('layouts.master')

@section('content')
    <section class="section">
        <div class="section-header">
            <div class="section-header-back">
                <a href="{{ route('dashboard') }}" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
            </div>

            <h1>Edit User</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                <div class="breadcrumb-item">Edit User</div>
            </div>
        </div>
        <div class="section-body">

            <div class="row">
                {{-- User Section --}}
                <div class="col-12 col-md-12 col-lg-12">
                    <div class="card">
                        <form action="{{ route('users.update', $user->id) }}" method="post" class="needs-validation" novalidate="">
                            @csrf
                            @method('patch')

                            <div class="card-header">
                                <h4>Update User Profile</h4>
                            </div>
                            <div class="card-body">

                                <div class="row">
                                    <div class="form-group col-md-6 col-12">
                                        <label>Name</label>
                                        <input type="text" name="name" value="{{ old('name', $user->name) }}"
                                            class="form-control" required="">
                                    </div>

                                    <div class="form-group col-md-6 col-12">
                                        <label>Email</label>
                                        <input type="email" name="email" value="{{ old('email', $user->email) }}"
                                            class="form-control" required="">
                                    </div>

                                    <div class="form-group col-md-6 col-12">
                                        <label>Role</label>
                                        <select name="role" class="form-control">
                                            <option @selected($user->role == 'admin') value="admin">Admin</option>
                                            <option @selected($user->role == 'user') value="user">User</option>
                                        </select>
                                    </div>

                                </div>

                            </div>
                            <div class="card-footer text-right">
                                <button class="btn btn-primary">Update</button>
                            </div>
                        </form>
                    </div>
                </div>
                {{-- End User Section --}}

                {{-- Password Section --}}
                <div class="col-12 col-md-12 col-lg-12">
                    <div class="card">
                        <form action="{{ route('users.password.update', $user->id) }}" method="post" class="needs-validation"
                            novalidate="">
                            @csrf
                            @method('put')

                            <div class="card-header">
                                <h4>Update Password</h4>
                            </div>
                            <div class="card-body">

                                <div class="row">
                                    <div class="form-group col-md-6 col-12">
                                        <label>{{ __('Current Password') }}</label>
                                        <input type="password" name="current_password" class="form-control" required="">
                                    </div>

                                    <div class="form-group col-md-6 col-12">
                                        <label>{{ __('New Password') }}</label>
                                        <input type="password" name="password" class="form-control" required="">
                                    </div>

                                    <div class="form-group col-md-6 col-12">
                                        <label>{{ __('Confirm Password') }}</label>
                                        <input type="password" name="password_confirmation" class="form-control"
                                            required="">
                                    </div>

                                </div>

                            </div>
                            <div class="card-footer text-right">
                                <button class="btn btn-primary">Update</button>
                            </div>
                        </form>
                    </div>
                </div>
                {{-- End Password Section --}}

            </div>
        </div>
    </section>
@endsection
