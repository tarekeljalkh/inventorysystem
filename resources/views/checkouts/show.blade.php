@extends('layouts.master')

@section('content')
    <section class="section">
        <div class="section-header">
            <div class="section-header-back">
                <a href="{{ route('dashboard') }}" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
            </div>

            <h1>Invoice</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{ route('dashboard') }}">Dashboard</a></div>
                <div class="breadcrumb-item">Invoice</div>
            </div>
        </div>

        <div class="section-body">
            <div class="invoice">
                <div class="invoice-print">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="invoice-title">
                                <h2>Invoice</h2>
                                <div class="invoice-number">Order #{{ $checkout->id }}</div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-md-6">
                                    <address>
                                        <strong>Billed To:</strong><br>
                                        {{ $checkout->client->name }}<br>
                                        <!-- Add client address details here -->
                                    </address>
                                </div>
                                <div class="col-md-6 text-md-right">
                                    <address>
                                        <strong>Residency Number:</strong><br>
                                        {{ $checkout->client->residency_number }}<br>
                                    </address>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <address>
                                        <strong>Phone Number:</strong><br>
                                        {{ $checkout->client->mobile }}<br>
                                    </address>
                                </div>
                                <div class="col-md-6 text-md-right">
                                    <address>
                                        <strong>Order Date:</strong><br>
                                        {{ $checkout->created_at->format('F j, Y') }}<br><br>
                                    </address>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row mt-4">
                        <div class="col-md-12">
                            <div class="section-title">Order Summary</div>
                            <p class="section-lead">All items here cannot be deleted.</p>
                            <div class="table-responsive">
                                <table class="table table-striped table-hover table-md">
                                    <tr>
                                        <th data-width="40">#</th>
                                        <th>Item</th>
                                        <th class="text-center">Quantity</th>
                                    </tr>
                                    @foreach ($checkout->items as $index => $item)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td>{{ $item->name }}</td>
                                            <td class="text-center">{{ $item->pivot->quantity }}</td>
                                        </tr>
                                    @endforeach
                                </table>


                            </div>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="text-md-right">
                    @if (!$checkout->return_date)
                        <form action="{{ route('checkouts.return', $checkout->id) }}" method="POST"
                            style="display:inline-block;">
                            @csrf
                            <button type="submit" class="btn btn-warning return-to-stock">Return to Stock</button>
                        </form>
                    @endif

                    <button class="btn btn-primary btn-icon icon-left" onclick="window.print()"><i class="fas fa-print"></i>
                        Print</button>
                </div>
            </div>
        </div>
    </section>


    <style>
        @media print {
            body * {
                visibility: hidden;
            }

            .invoice-print,
            .invoice-print * {
                visibility: visible;
            }

            .invoice-print {
                position: absolute;
                left: 0;
                top: 0;
                width: 210mm;
                /* A4 width */
                height: 297mm;
                /* A4 height */
            }
        }
    </style>
@endsection
