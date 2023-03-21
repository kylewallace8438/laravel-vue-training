@extends('demo.layouts.app')

<!-- Start Hero Section -->
@section('hero')
    <div class="hero">
        <div class="container">
            <div class="row justify-content-between">
                <div class="col-lg-5">
                    <div class="intro-excerpt">
                        <h1>Cart</h1>
                    </div>
                </div>
                <div class="col-lg-7">

                </div>
            </div>
        </div>
    </div>
@endsection
<!-- End Hero Section -->

<!-- Start before-footer-section Section -->
@section('before-footer-section')
    <div class="untree_co-section before-footer-section">
        <div class="container">
            <div class="row mb-5">
                <form class="col-md-12" method="post">
                    <div class="site-blocks-table">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th class="product-thumbnail">Image</th>
                                    <th class="product-name">Product</th>
                                    <th class="product-price">Price</th>
                                    <th class="product-quantity">Quantity</th>
                                    <th class="product-total">Total</th>
                                    <th class="product-remove">Remove</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $sub_total = 0
                                @endphp
                                @foreach ($carts as $cart)
                                    <tr>
                                        <td class="product-thumbnail">
                                            <img src="images/product-1.png" alt="Image" class="img-fluid">
                                        </td>
                                        <td class="product-name">
                                            <h2 class="h5 text-black">{{$cart->product->name}}</h2>
                                        </td>
                                        <td>${{$cart->price}}</td>
                                        <td>
                                            <div class="input-group mb-3 d-flex align-items-center quantity-container"
                                                style="max-width: 120px;">
                                                <div class="input-group-prepend">
                                                    <button class="btn btn-outline-black decrease" type="button"
                                                        onclick="add_cart({{ $cart->product_id }},0)">&minus;</button>
                                                </div>
                                                <input type="text" class="form-control text-center quantity-amount"
                                                    value="{{$cart->count}}" placeholder=""
                                                    aria-label="Example text with button addon"
                                                    aria-describedby="button-addon1" onblur="checkvalue({{ $cart->product_id }})">
                                                <div class="input-group-append">
                                                    <button class="btn btn-outline-black increase" type="button"
                                                        onclick="add_cart({{ $cart->product_id }},1)">&plus;</button>
                                                </div>
                                            </div>

                                        </td>
                                        @php
                                            $sub_total += $cart->count * $cart->discount_price;
                                        @endphp
                                        <td>${{ $cart->count * $cart->discount_price }}</td>
                                        <td><a href="#" class="btn btn-black btn-sm" onclick="add_cart(0, {{ $cart['product_id'] }}, '{{ $cart['price']}}', '{{ $cart['name'] }}')">X</a></td>
                                    </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                </form>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="row mb-5">
                        <div class="col-md-6 mb-3 mb-md-0">
                            <button class="btn btn-black btn-sm btn-block" onclick="window.location='{{ route('cart') }}'">Update Cart</button>
                        </div>
                        <div class="col-md-6">
                            <button class="btn btn-outline-black btn-sm btn-block" onclick="window.location='{{ route('shop') }}'">Continue Shopping</button>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <label class="text-black h4" for="coupon">Coupon</label>
                            <p>Enter your coupon code if you have one.</p>
                        </div>
                        <div class="col-md-8 mb-3 mb-md-0">
                            <input type="text" class="form-control py-3" id="coupon" placeholder="Coupon Code">
                        </div>
                        <div class="col-md-4">
                            <button class="btn btn-black">Apply Coupon</button>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 pl-5">
                    <div class="row justify-content-end">
                        <div class="col-md-7">
                            <div class="row">
                                <div class="col-md-12 text-right border-bottom mb-5">
                                    <h3 class="text-black h4 text-uppercase">Cart Totals</h3>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <span class="text-black">Subtotal</span>
                                </div>
                                <div class="col-md-6 text-right">
                                    <strong class="text-black">${{$sub_total}}</strong>
                                </div>
                            </div>
                            <div class="row mb-5">
                                <div class="col-md-6">
                                    <span class="text-black">Total</span>
                                </div>
                                <div class="col-md-6 text-right">
                                    <strong class="text-black">${{$sub_total}}</strong>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <button class="btn btn-black btn-lg py-3 btn-block"
                                        onclick="window.location='{{ route('checkout') }}'">Proceed To Checkout</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

<script>
    function add_cart(id, check) {
        // const divBoxes = document.querySelectorAll("meta[name='csrf-token']");
        // let addcartElement = document.querySelector('.addcart-'+id);
        // console.log(addcartElement);
        // var x = divBoxes[0].content;
            // console.log('hello1');
            // Creating Our XMLHttpRequest object 
            var xhr = new XMLHttpRequest();
            // console.log(this.getAttribute('data-uri'));
            // Making our connection
            var url = "{{ route('add_cart') }}?";
            xhr.open("POST", url, true);
            // function execute after request is successful 
            xhr.onreadystatechange = function(e) {
                if (this.readyState == 4 && this.status == 200) {
                    try {
                        console.log(this.responseText);
                        // let show=JSON.parse(this.responseText);
                        // document.getElementById("bmi").innerHTML = show.msg;
                    } catch (e) {}
                }
            }
            // Sending our request 
            xhr.setRequestHeader('X-CSRF-TOKEN', "{{ csrf_token() }}");
            var params = new FormData();
            params.append('product_id', id);
            params.append('check', check);
            // console.log(params);
            xhr.send(params);
    }
</script>
<!-- End before-footer-section Section -->
