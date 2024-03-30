@extends('layouts.master')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Return Items to Stock from Checkout #{{ $checkout->id }}</h1>
        </div>
        <div class="section-body">
            <form action="{{ route('checkouts.process_return', $checkout->id) }}" method="POST">
                @csrf
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Item Name</th>
                                <th>Checked Out Quantity</th>
                                <th>Remaining to Return</th>
                                <th>Return Quantity</th>
                                <th>Notes</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($checkout->items as $item)
                                @php
                                    $remainingToReturn = $item->pivot->quantity - $item->pivot->returned_quantity;
                                @endphp
                                @if ($remainingToReturn > 0)
                                    <!-- Display only items with quantity left to return -->
                                    <tr>
                                        <td>{{ $item->name }}</td>
                                        <td>{{ $item->pivot->quantity }}</td>
                                        <td>{{ $remainingToReturn }}</td>
                                        <td>
                                            <input type="number" name="returns[{{ $item->id }}][quantity]"
                                                class="form-control" min="0" max="{{ $remainingToReturn }}">
                                        </td>
                                        <td>
                                            <textarea name="returns[{{ $item->id }}][notes]" class="form-control" placeholder="Add notes here..."></textarea>
                                        </td>
                                    </tr>
                                @endif
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- Add Returned By field here -->
                <div class="form-group">
                    <label for="returnedBy">Returned By</label>
                    <input type="text" class="form-control" id="returnedBy" name="returned_by"
                        placeholder="Enter name or identifier">
                </div>

                <button type="submit" class="btn btn-success">Return</button>
            </form>
        </div>
    </section>
@endsection
