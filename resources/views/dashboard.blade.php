@extends('layouts.master')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Welcome Admin</h1>
        </div>
        <div class="row">
            <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                <a href="{{ route('items.index') }}" style="text-decoration:none; color: inherit;">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-primary">
                            <i class="fas fa-sitemap"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Items</h4>
                            </div>
                            <div class="card-body">
                                {{ $items }}
                            </div>
                        </div>
                    </div>
                </a>
            </div>

            <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                <a href="{{ route('clients.index') }}" style="text-decoration:none; color: inherit;">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-info">
                            <i class="fas fa-user"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Clients</h4>
                            </div>
                            <div class="card-body">
                                {{ $clients }}
                            </div>
                        </div>
                    </div>
                </a>
            </div>

            <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                <a href="{{ route('checkouts.index') }}" style="text-decoration:none; color: inherit;">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-warning">
                            <i class="fas fa-sign-out-alt"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Checkout Items</h4>
                            </div>
                            <div class="card-body">
                                {{ $checkouts }}
                            </div>
                        </div>
                    </div>
                </a>
            </div>

            <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                <a href="{{ route('reports.index') }}" style="text-decoration:none; color: inherit;">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-secondary">
                            <i class="fas fa-newspaper"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Reports</h4>
                            </div>
                            <div class="card-body">
                                {{ $reports }}
                            </div>
                        </div>
                    </div>
                </a>
            </div>

            <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                <a href="{{ route('checkouts.create') }}" style="text-decoration:none; color: inherit;">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-danger">
                            <i class="fas fa-folder-plus"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Create new Checkout</h4>
                            </div>
                        </div>
                    </div>
                </a>
            </div>



        </div>
        <div class="section-body">
        </div>
    </section>
@endsection
