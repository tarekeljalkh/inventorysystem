@extends('layouts.master')

@section('content')
    <section class="section">
        <div class="section-header">
            <div class="section-header-back">
                <a href="{{ route('dashboard') }}" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
            </div>
            <h1>Edit Category</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{ route('dashboard') }}">Dashboard</a></div>
                <div class="breadcrumb-item"><a href="{{ route('categories.index') }}">Categories</a></div>
                <div class="breadcrumb-item"><a href="#">Edit Category</a></div>
            </div>
        </div>

        <div class="section-body">

            <div class="row">
                {{-- Category Section --}}
                <div class="col-12 col-md-12 col-lg-12">
                    <div class="card">
                        <form action="{{ route('categories.update', $category->id) }}" method="post" class="needs-validation"
                            novalidate="">
                            @method('put')
                            @csrf

                            <div class="card-header">
                                <h4>Edit Category</h4>
                            </div>
                            <div class="card-body">

                                <div class="row">

                                    <div class="form-group col-md-6 col-12">
                                        <label>Name</label>
                                        <input type="text" name="name" class="form-control"
                                            value="{{ $category->name }}" required="">
                                    </div>

                                </div>


                            </div>
                            <div class="card-footer text-right">
                                <button class="btn btn-primary">Update</button>
                            </div>
                        </form>
                    </div>
                </div>
                {{-- End Category Section --}}


            </div>
        </div>
    </section>
@endsection
