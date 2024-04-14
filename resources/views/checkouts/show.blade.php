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
            <!-- Card for Size and Image Upload Controls -->
            <div class="card">
                <div class="card-header">
                    <h4>Adjust Invoice Size & Upload Image</h4>
                </div>
                <div class="card-body">
                    <div class="form-inline justify-content-center">
                        <div class="form-group mb-2">
                            <label for="invoiceWidth" class="mr-2">Width (mm):</label>
                            <input type="number" class="form-control" id="invoiceWidth" placeholder="Width in mm"
                                value="210">
                        </div>
                        <div class="form-group mx-sm-3 mb-2">
                            <label for="invoiceHeight" class="mr-2">Height (mm):</label>
                            <input type="number" class="form-control" id="invoiceHeight" placeholder="Height in mm"
                                value="297">
                        </div>
                        <div class="form-group mx-sm-3 mb-2">
                            <label for="invoiceImage" class="btn btn-info">Choose Image</label>
                            <input type="file" id="invoiceImage" class="form-control-file d-none"
                                onchange="adjustSize()">
                        </div>
                        <button type="button" class="btn btn-primary mb-2" onclick="adjustSize()">Apply Size</button>
                    </div>
                </div>
                <div class="card-footer text-md-right">
                    <button class="btn btn-primary btn-icon icon-left" onclick="window.print()"><i class="fas fa-print"></i>
                        Print</button>
                </div>
            </div>
            <div class="invoice">
                <div class="invoice-print" id="invoicePrint">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="invoice-title">
                                <h2>Invoice</h2>
                                <div class="invoice-number">Order #{{ $checkout->id }}</div>

                                <div id="imageContainer" style="text-align: center; margin: 20px 0;">
                                    <!-- Image will be displayed here -->
                                </div>

                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-md-6">
                                    <address>
                                        <strong>Billed To:</strong><br>
                                        {{ $checkout->client->name }}<br>
                                        <!-- Additional details here -->
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
                                        <th>Image</th>
                                        <th class="text-center">Quantity</th>
                                    </tr>
                                    @foreach ($checkout->items as $index => $item)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td>{{ $item->name }}</td>
                                            <td><img style="width: 100px" src="{{ $item->image }}" alt="{{ $item->name }}"></td>
                                            <td class="text-center">{{ $item->pivot->quantity }}</td>
                                        </tr>
                                    @endforeach
                                </table>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

            <hr>


        </div>
    </section>

    <style>
        @media print {
            body * {
                visibility: hidden;
            }

            .invoice,
            .invoice * {
                visibility: visible;
            }

            .invoice {
                position: absolute;
                left: 0;
                top: 0;
                width: 100%;
                height: auto;
            }

            #invoicePrint {
                border: none;
            }
        }
    </style>
@endsection

@push('scripts')
    <script>
        function adjustSize() {
            const width = document.getElementById('invoiceWidth').value || 210; // Default A4 width in mm
            const height = document.getElementById('invoiceHeight').value || 297; // Default A4 height in mm
            const invoicePrint = document.getElementById('invoicePrint');

            // Convert mm to pixels for on-screen display (approximation, 1mm = 3.78px)
            invoicePrint.style.width = `${width * 3.78}px`;
            invoicePrint.style.height = `${height * 3.78}px`;

            const imageInput = document.getElementById('invoiceImage');
            const imageContainer = document.getElementById('imageContainer');
            imageContainer.innerHTML = ''; // Clear previous image

            if (imageInput.files && imageInput.files[0]) {
                const reader = new FileReader();

                reader.onload = function(e) {
                    const img = document.createElement('img');
                    img.src = e.target.result;
                    img.style.maxWidth = '100%'; // Ensure the image fits in the invoice
                    img.style.height = 'auto';
                    imageContainer.appendChild(img);
                };

                reader.readAsDataURL(imageInput.files[0]);
            }
        }
    </script>
@endpush
