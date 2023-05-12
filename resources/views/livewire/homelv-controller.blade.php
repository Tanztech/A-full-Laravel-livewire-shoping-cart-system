<div class="container-fluid">
    <div class="row ">
        {{--  START error messages --}}
        <div class="row my-3">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xsm-12" >
                @if (session()->has('FieldRequired'))
                    <div class="alert alert-danger show flex items-center mb-2" role="alert"> <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" icon-name="alert-octagon" data-lucide="alert-octagon" class="lucide lucide-alert-octagon w-6 h-6 mr-2"><polygon points="7.86 2 16.14 2 22 7.86 22 16.14 16.14 22 7.86 22 2 16.14 2 7.86 7.86 2"></polygon><line x1="12" y1="8" x2="12" y2="12"></line><line x1="12" y1="16" x2="12.01" y2="16"></line></svg>
                        {{ session('FieldRequired') }}
                    </div>
                @endif
                @if (session()->has('error'))
                    <!-- BEGIN: Notification Content -->
                    <div class="alert alert-danger show flex items-center mb-2" role="alert"> <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" icon-name="alert-octagon" data-lucide="alert-octagon" class="lucide lucide-alert-octagon w-6 h-6 mr-2"><polygon points="7.86 2 16.14 2 22 7.86 22 16.14 16.14 22 7.86 22 2 16.14 2 7.86 7.86 2"></polygon><line x1="12" y1="8" x2="12" y2="12"></line><line x1="12" y1="16" x2="12.01" y2="16"></line></svg>
                        {{ session('error') }}
                    </div>
                @endif
                @if (session()->has('net_error'))
                    <!-- BEGIN: Notification Content -->
                    <div id="basic-sticky-notification-content" class="toastify-content bg-danger hidden flex">
                        <i class="text-light" data-lucide="alert-triangle"></i>
                        <div class="ml-4 mr-4"> <div class="font-medium text-light"> Error!</div>
                            <div class="text-slate-500 mt-1 text-light"> {{ session('net_error') }}</div>
                        </div>
                    </div> <!-- END: Notification Content -->
                @endif
                @if (session()->has('message'))
                    <!-- BEGIN: Notification Content -->
                    <div class="alert alert-success show flex items-center mb-2" role="alert">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" icon-name="check-circle" data-lucide="check-circle" class="lucide lucide-check-circle w-6 h-6 mr-2"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path><polyline points="22 4 12 14.01 9 11.01"></polyline></svg>
                        {{ session('message') }}
                    </div>
                @endif
            </div>
        </div>
        {{-- END  error messages --}}
        <div class="col-md-12">
            <div>
                <h2>Shop With Ease</h2>
                <div id="shop">
                    <div class="row">
                        <div class="col-lg-12 col-sm-12 col-md-12 col-xsm-12" >
                            <div class="ms-right" wire:loading>
                                <label>loading...</label>
                            </div>
                        </div>
                        <div class="col-lg-12 col-sm-12 col-md-12 col-xsm-12" >

                            @foreach($products as $product)
                                <div class="products ios apple" id="iphone-x">
                                    <img class="product-image" src="http://via.placeholder.com/200x200">
                                    <p class="product-name">{{$product['p_name']}}</p>
                                    <p class="product-description">{{$product['p_description']}}</p>
                                    <p class="product-price">{{$price = 25*rand(11,99)}}</p>
                                    <button wire:click="AddToCart({{$product['id']}},{{$price}})" class="add-to-cart" id='test'>ADD TO CART</button>
                                </div>
                            @endforeach
                        </div>
                        <div class="col-lg-12 col-sm-12 col-md-12 col-xsm-12">
                            <h2>Other Related</h2>
                            <div class="products ios apple" id="iphone-x">
                                <img class="product-image" src="http://via.placeholder.com/200x200">
                                <p class="product-name">iPhone X</p>
                                <p class="product-description">A 5.5" beast of processing power from Apple.</p>
                                <p class="product-price" value='999'>999</p>
                                <button class="add-to-cart" id='test'>ADD TO CART</button>
                            </div>

                            <div class="products android samsung" id="samsung-s9">
                                <img class="product-image" src="http://via.placeholder.com/200x200">
                                <p class="product-name">Samsung S9</p>
                                <p class="product-description">The most powerful Android device on the planet.</p>
                                <p class="product-price" value='789'>789</p>
                                <button class="add-to-cart">ADD TO CART</button>
                            </div>

                            <div class="products android google" id="pixel-2">
                                <img class="product-image" src="http://via.placeholder.com/200x200">
                                <p class="product-name">Pixel 2</p>
                                <p class="product-description">The perfect phone for a clean Android experience</p>
                                <p class="product-price" value='876'>876</p>
                                <button class="add-to-cart">ADD TO CART</button>
                            </div>

                            <div class="products android oneplus" id="oneplus-6">
                                <img class="product-image" src="http://via.placeholder.com/200x200">
                                <p class="product-name">Oneplus 6</p>
                                <p class="product-description">The latest from a long line of affordable premium devices by Oneplus</p>
                                <p class="product-price" value='799'>799</p>
                                <button class="add-to-cart">ADD TO CART</button>
                            </div>

                            <div class="products ios apple" id="iphone-8">
                                <img class="product-image" src="http://via.placeholder.com/200x200">
                                <p class="product-name">iPhone 8</p>
                                <p class="product-description">The little, less-stylish brother of the iPhone X.</p>
                                <p class="product-price" value='719'>719</p>
                                <button class="add-to-cart">ADD TO CART</button>
                            </div>

                            <div class="products android huawei" id="huawei-p20">
                                <img class="product-image" src="http://via.placeholder.com/200x200">
                                <p class="product-name">Huawei P20</p>
                                <p class="product-description">A solid performer from the chinese giant Huawei.</p>
                                <p class="product-price" value='769'>769</p>
                                <button class="add-to-cart">ADD TO CART</button>
                            </div>

                            <div class="products android lg" id="lg-g7">
                                <img class="product-image" src="http://via.placeholder.com/200x200">
                                <p class="product-name">LG G7 ThinQ</p>
                                <p class="product-description">The latest and most powerful smartphone from LG.</p>
                                <p class="product-price" value='699'>699</p>
                                <button class="add-to-cart">ADD TO CART</button>
                            </div>

                            <div class="products android huawei" id="huawei-mate-10-pro">
                                <img class="product-image" src="http://via.placeholder.com/200x200">
                                <p class="product-name">Huawei Mate 10 Pro</p>
                                <p class="product-description">The most powerful Android device yet from Huawei.</p>
                                <p class="product-price" value='899'>899</p>
                                <button class="add-to-cart">ADD TO CART</button>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <div id='cart-wrapper' class="slider close" wire:init="getcartData">
                <div id='cart'>
                    <div id="cart-products-wrapper">
                        <table id="cart-table">
                            <thead id="cart-table-header">
                            <th class="name-col">Product Code</th>
                            <th class="name-col">Product Name</th>
                            <th class="quantity-col">Quantity</th>
                            <th class="price-col">Price</th>
                            <th class="updated-price-col">TAx</th>
                            <th class="updated-price-col">Subtotal</th>
                            <th class="updated-price-col">Action</th>
                            </thead>
                            <tbody id="cart-table-body">
                            @if(!empty($cartdata))
                                @foreach($cartdata as $cart)
                                    <tr>
                                        <td>{{$cart['id']}}</td>
                                        <td>{{$cart['name']}}</td>
                                        <td><input type="number" placeholder="{{$cart['qty']}}" class="form-control" wire:model.lazy="Quantity" wire:blur="updateProductQty('{{$cart['rowId']}}','{{$cart['name']}}')" ></td>
                                        <td>{{$cart['price']}}</td>
                                        <td>{{$cart['tax']}}</td>
                                        <td>{{$cart['subtotal']}}</td>
                                        <td><div class="d-flex">
                                                <button class="btn btn-info mx-1">View</button>
                                                <button class="btn btn-danger mx-1" wire:click="RemoveFromCart('{{$cart['rowId']}}','{{$cart['name']}}','{{$cart['id']}}')">Remove</button>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                            </tbody>
                        </table>
                    </div>
                </div>

                <div id='amount-controls'>
                    <div id="cart-amount-wrapper">
                        <table>
                            <tbody>
                            <tr id='total-wrapper'>
                                <td id="total-label">Total Tax:</td>
                                <td id="total">{{$cartTotalTax}}</td>
                            </tr>
                            <tr id='total-wrapper'>
                                <td id="total-label">Sub Total:</td>
                                <td id="total">{{$cartsubTotal}}</td>
                            </tr>
                            <tr id='total-wrapper'>
                                <td id="total-label">Total:</td>
                                <td id="total">{{$cartTotal}}</td>
                            </tr>


                            <tr id="promo-checkout">
                                <td id="promo-wrapper">
                                    <input id="promo" placeholder="Input Promo Code">
                                    <button id="apply-promo">Apply Promo</button>
                                </td>

                                <td>
                                    <button id="checkout">Checkout</button>
                                </td>

                                <td>
                                    <button id="ks" class="keep-shopping">Keep Shopping</button>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
