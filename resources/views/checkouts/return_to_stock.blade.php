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
                            <th>Returned Quantity</th>
                            <th>Remaining to Return</th>
                            <th>Return Quantity</th>
                            <th>Notes</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($checkout->items as $item)
                        @php
                            $returnedQuantity = $item->pivot->returned_quantity;
                            $remainingToReturn = $item->pivot->quantity - $returnedQuantity;
                        @endphp
                        <tr>
                            <td>{{ $item->name }}</td>
                            <td>{{ $item->pivot->quantity }}</td>
                            <td>{{ $returnedQuantity }}</td>
                            <td>{{ $remainingToReturn }}</td>
                            <td>
                                @if ($remainingToReturn > 0)
                                <input type="number" name="returns[{{ $item->id }}][quantity]" class="form-control" min="0" max="{{ $remainingToReturn }}">
                                @else
                                <input type="number" class="form-control" value="{{ $returnedQuantity }}" disabled>
                                @endif
                            </td>
                            <td>
                                <textarea name="returns[{{ $item->id }}][notes]" class="form-control" {{ $remainingToReturn <= 0 ? 'disabled' : '' }}>{{ $item->pivot->notes ?? '' }}</textarea>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="form-group">
                <label for="returnedBy">Returned By</label>
                <input type="text" class="form-control" id="returnedBy" name="returned_by" placeholder="Enter name or identifier">
            </div>
            <button type="submit" class="btn btn-success">Return</button>
        </form>
    </div>
</section>
@endsection
