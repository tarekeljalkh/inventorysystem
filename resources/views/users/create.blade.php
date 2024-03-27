@extends('layouts.master')

@section('content')
    <section class="section">
        <div class="section-header">
            <div class="section-header-back">
                <a href="{{ route('dashboard') }}" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
            </div>

            <h1>Create User</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                <div class="breadcrumb-item">Create User</div>
            </div>
        </div>
        <div class="section-body">

            <div class="row">
                <div class="col-12 col-md-12 col-lg-12">
                    <div class="card">
                        <form action="{{ route('users.store') }}" method="post" class="needs-validation" novalidate="">
                            @csrf

                            <div class="card-header">
                                <h4>Create User</h4>
                            </div>
                            <div class="card-body">

                                {{-- User Section --}}
                                <div class="row">
                                    <div class="form-group col-md-6 col-12">
                                        <label>Name</label>
                                        <input type="text" name="name" value="{{ old('name') }}"
                                            class="form-control" required="">
                                    </div>

                                    <div class="form-group col-md-6 col-12">
                                        <label>Email</label>
                                        <input type="email" name="email" value="{{ old('email') }}"
                                            class="form-control" required="">
                                    </div>

                                    <div class="form-group col-md-6 col-12">
                                        <label>Role</label>
                                        <select name="role" class="form-control">
                                            <option value="admin">Admin</option>
                                            <option value="user">User</option>
                                        </select>
                                    </div>

                                </div>
                                {{-- End User Section --}}


                                {{-- Password Section --}}
                                <div class="row">

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
                                {{-- End Password Section --}}


                            </div>
                            <div class="card-footer text-right">
                                <button class="btn btn-primary">Create</button>
                            </div>
                        </form>
                    </div>
                </div>


            </div>
        </div>
    </section>
@endsection
