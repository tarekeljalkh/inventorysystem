@extends('layouts.master')

@section('content')
    <section class="section">
        <div class="section-header">
            <div class="section-header-back">
                <a href="{{ route('dashboard') }}" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
            </div>
            <h1>Edit Item</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{ route('dashboard') }}">Dashboard</a></div>
                <div class="breadcrumb-item"><a href="{{ route('items.index') }}">Items</a></div>
                <div class="breadcrumb-item"><a href="#">Edit Item</a></div>
            </div>
        </div>

        <div class="section-body">

            <div class="row">
                {{-- Item Section --}}
                <div class="col-12 col-md-12 col-lg-12">
                    <div class="card">
                        <form action="{{ route('items.update', $item->id) }}" method="post" class="needs-validation"
                            novalidate="" enctype="multipart/form-data">
                            @method('put')
                            @csrf

                            <div class="card-header">
                                <h4>Edit Doctor</h4>
                            </div>
                            <div class="card-body">

                                <div class="row">
                                    <div class="form-group col-md-12 col-12">
                                        <label>Image</label>
                                        <div id="image-preview" class="image-preview">
                                            <label for="image-upload" id="image-label">Choose File</label>
                                            <input type="file" name="image" id="image-upload" />
                                        </div>
                                    </div>
                                </div>

                                <div class="row">

                                    <div class="form-group col-md-6 col-12">
                                        <label>Name</label>
                                        <input type="text" name="name" class="form-control"
                                            value="{{ $item->name }}" required="">
                                    </div>

                                    <div class="form-group col-md-6 col-12">
                                        <label>quantity</label>
                                        <input type="number" name="quantity" class="form-control"
                                            value="{{ $item->quantity }}" required="">
                                    </div>

                                </div>


                            </div>
                            <div class="card-footer text-right">
                                <button class="btn btn-primary">Update</button>
                            </div>
                        </form>
                    </div>
                </div>
                {{-- End Item Section --}}


            </div>
        </div>
    </section>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            $('.image-preview').css({
                'background-image': 'url({{ asset($item->image) }})',
                'background-size': 'cover',
                'background-position': 'center center'
            })
        })
    </script>
@endpush
