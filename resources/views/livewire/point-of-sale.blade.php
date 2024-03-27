<div>
    <div class="row">
        <!-- Search Input -->
        <div class="col-md-6 mb-3">
            <input type="text" class="form-control" placeholder="Search Items..." wire:model.defer="search"
                wire:keydown="updateSearch">
        </div>

        <!-- Product Grid -->
        <div class="col-md-9"> <!-- Adjusted from col-md-8 to col-md-9 for 3/4 width -->
            <div class="card">
                <div class="card-header">
                    <h4>Available Items</h4>
                </div>
                <div class="card-body">
                    <div class="row">

                        @foreach ($items as $item)
                            <div class="col-md-3 mb-4">
                                <div class="card h-100" style="cursor: pointer;"
                                    wire:click="addToCart({{ $item['id'] }})">
                                    <!-- Center the image by making it block level and using mx-auto for auto margins on both sides -->
                                    <img style="width:50px; display: block; margin: 0 auto;"
                                        src="{{ $item['image'] ? asset($item['image']) : asset('uploads/no_image.png') }}"
                                        class="card-img-top" alt="{{ $item['name'] }}">
                                    <!-- Use text-center class to center the text content within the card-body -->
                                    <div class="card-body text-center">
                                        <h5 class="card-title">{{ $item['name'] }}</h5>
                                        <p>{{ $item['quantity'] }} Available</p>
                                    </div>
                                </div>
                            </div>
                        @endforeach

                    </div>
                </div>
            </div>
        </div>

        <!-- Cart Section -->
        <div class="col-md-3"> <!-- Adjusted for 1/4 width -->
            <div class="card">
                <div class="card-header">
                    <h4>Cart</h4>
                </div>
                <div class="card-body">
                    @if (count($cart) > 0)
                        <ul class="list-group list-group-flush">
                            @foreach ($cart as $item)
                                <li class="list-group-item">
                                    {{ $item['name'] }}
                                    <span class="badge badge-primary badge-pill">{{ $item['quantity'] }}</span>
                                    <button class="btn btn-sm btn-danger"
                                        wire:click="removeFromCart({{ $item['id'] }})">-</button>
                                </li>
                            @endforeach
                        </ul>
                    @else
                        <p>Your cart is empty.</p>
                    @endif
                </div>
                <div class="card-footer">
                    <h5>Total: {{ count($cart) }} Items</h5>
                    <div class="d-flex">
                        <select wire:model="selectedClient" class="form-control select2 mr-2" id="clientSelect">
                            <option value="" disabled>Select Client</option>
                            @foreach ($this->loadClients() as $client)
                                <option value="{{ $client->id }}">{{ $client->name }}</option>
                            @endforeach
                        </select>
                        <button class="btn btn-success ml-2" wire:click="checkout"
                            {{ count($cart) == 0 ? 'disabled' : '' }}>
                            Checkout
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
