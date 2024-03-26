@extends('layouts.master')

@section('content')
    <section class="section">
        <div class="section-header">
            <div class="section-header-back">
                <a href="{{ route('dashboard') }}" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
            </div>
            <h1>Import Items</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{ route('dashboard') }}">Dashboard</a></div>
                <div class="breadcrumb-item"><a href="{{ route('items.index') }}">Items</a></div>
                <div class="breadcrumb-item"><a href="#">Import Items</a></div>
            </div>
        </div>

        <div class="section-body">

            <div class="row">
                {{-- Items Section --}}
                <div class="col-12 col-md-12 col-lg-12">
                    <div class="card">
                        <form action="{{ route('items.import') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <div class="card-header">
                                <h4>Upload Excel File</h4>
                            </div>
                            <div class="card-body">

                                <div class="row">
                                    <div class="form-group col-md-6 col-12">
                                            <input type="file" name="excel_file" class="form-control" />
                                    </div>

                                </div>

                            </div>
                            <div class="card-footer text-right">
                                <button class="btn btn-primary">Import</button>
                            </div>
                        </form>
                    </div>
                </div>
                {{-- End Item Section --}}

            </div>
        </div>
    </section>
@endsection
