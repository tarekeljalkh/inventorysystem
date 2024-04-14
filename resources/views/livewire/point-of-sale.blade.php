<div>
    <div class="row">
        <!-- Search Input -->
        <div class="col-md-6 mb-3">
            <input type="text" class="form-control" placeholder="Search Items..." wire:model.defer="search"
                wire:keydown="updateSearch">
        </div>
        @if (session()->has('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if (session()->has('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

        <!-- Product Grid -->
        <div class="col-md-9"> <!-- Adjusted from col-md-8 to col-md-9 for 3/4 width -->
            <div class="card">
                <div class="card-header">
                    <h4>Available Items</h4>
                </div>
                <div class="card-body">
                    <div class="row">

                        @foreach ($items as $item)
                        <div class="col-md-3 mb-4" wire:key="item-{{ $item['id'] }}">
                            <div class="card h-100">
                                <img style="width:50px; display: block; margin: 0 auto;"
                                    src="{{ $item['image'] ? asset($item['image']) : asset('uploads/no_image.png') }}"
                                    alt="{{ $item['name'] }}">
                                <div class="card-body text-center">
                                    <h5 class="card-title">{{ $item['name'] }}</h5>
                                    <p>{{ $item['quantity'] }} in Stock</p>
                                    <p>{{ $item['out_quantity'] }} Checked Out</p>
                                    <input type="number" wire:model="quantities.{{ $item['id'] }}" class="form-control mb-2" placeholder="Qty" min="1" max="{{ $item['quantity'] }}">
                                    <button class="btn btn-primary" wire:click="addToCart({{ $item['id'] }})">Add to Cart</button>
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
                                <input type="number" wire:model="removalQuantities.{{ $item['id'] }}" class="form-control mb-2" style="width: 60px;" placeholder="Qty" min="1" max="{{ $item['quantity'] }}">
                                <button class="btn btn-sm btn-danger" wire:click="removeFromCart({{ $item['id'] }})">-</button>
                                <!-- Add a new button to remove the specified quantity -->
                                <button class="btn btn-sm btn-warning" wire:click="removeFromCart({{ $item['id'] }})">Remove Specified Quantity</button>
                            </li>
                            @endforeach                        </ul>
                    @else
                        <p>Your cart is empty.</p>
                    @endif
                </div>
                <div class="card-footer">
                    <h5>Total: {{ count($cart) }} Items</h5>
                    <input type="text" class="form-control mb-2" placeholder="Enter Checkout User Name" wire:model.defer="checkoutUser">
                    <div class="d-flex">
                        <select wire:model="selectedClient" class="form-control select2 mr-2" id="clientSelect">
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
