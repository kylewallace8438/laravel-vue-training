@extends('demo.layouts.app')
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
@section('untree_co-section')
    {{-- <script>
        function show_cart {
            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    var show = JSON.parse(this.responseText);
                    console.log(show);
                }
            };
            xhttp.open('GET', '{{ route('addProduct') }}', true);
            xhttp.send();
            return show;
        };
    </script> --}}
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
                                    $total = 0.0;
                                @endphp
                                @foreach (session('carts') as $cart)
                                    {{ $total += $cart['price'] * $cart['quantity'] }}
                                    <tr>
                                        <td class="product-thumbnail">
                                            <img src="images/product-1.png" alt="Image" class="img-fluid">
                                        </td>
                                        <td class="product-name">
                                            <h2 class="h5 text-black">{{ $cart['name'] }}</h2>
                                        </td>
                                        <td>$<span id="product-price-{{ $cart['id'] }}">{{ $cart['price'] }}</span></td>
                                        <td>
                                            <div class="input-group mb-3 d-flex align-items-center quantity-container"
                                                style="max-width: 120px;">
                                                <div class="input-group-prepend">
                                                    <button class="btn btn-outline-black decrease" type="button"
                                                        onclick="add_cart({{ $cart['id'] }},-1)">&minus;</button>
                                                </div>
                                                <input type="text" id="myInput"
                                                    class="form-control text-center quantity-amount"
                                                    value="{{ $cart['quantity'] }}" placeholder=""
                                                    aria-label="Example text with button addon"
                                                    aria-describedby="button-addon1" onblur="getValue({{ $cart['id'] }})">
                                                <div class="input-group-append">
                                                    <button class="btn btn-outline-black increase" type="button"
                                                        onclick="add_cart({{ $cart['id'] }},-2)">&plus;</button>
                                                </div>
                                            </div>

                                        </td>
                                        <td>$<span id="product-total-price-{{ $cart['id'] }}">{{ $cart['price'] * $cart['quantity'] }} </span></td>
                                        <td><a href="#" class="btn btn-black btn-sm">X</a></td>
                                    </tr>
                                @endforeach
                                {{ Session()->put('total', $total) }};

                                </tr>
                            </tbody>
                        </table>
                    </div>
                </form>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="row mb-5">
                        <div class="col-md-6 mb-3 mb-md-0">
                            <button class="btn btn-black btn-sm btn-block"
                                onclick="window.location='{{ route('cart') }}'">Update Cart</button>
                        </div>
                        <div class="col-md-6">
                            <button class="btn btn-outline-black btn-sm btn-block"
                                onclick="window.location='{{ route('shop') }}'">Continue Shopping</button>
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
                                    <strong class="text-black">${{ $total }}</strong>
                                </div>
                            </div>
                            <div class="row mb-5">
                                <div class="col-md-6">
                                    <span class="text-black">Total</span>
                                </div>
                                <div class="col-md-6 text-right">
                                    <strong class="text-black">${{ $total }}</strong>
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
@section('script')
    <script>
        function add_cart(id, add) {
            console.log(id);
            console.log(add);

            // let span = document.getElementById("product-total-price-" + id);
            
            
            // let orders = session() -> get('carts');
            // for (let i = 0; i < count(orders); i++) {
            //     if (orders[i]['id'] == id) {
            //       var price_total = orders[i]['price'] * orders[i]['quatity']; 
            //       console.log(price_total);
            //     }
            // }
            // span.innerHtml += price_total.toString();

            var formData = new FormData();
            formData.append('id', id);
            formData.append('add', add);
            var xhr = new XMLHttpRequest();
            // Thiết lập phương thức POST và URL
            xhr.open("POST", "{{ route('addProduct') }}?", true);
            xhr.setRequestHeader('X-CSRF-Token', '{{ csrf_token() }}');
            xhr.onreadystatechange = function() {
                if (this.readyState === XMLHttpRequest.DONE && this.status === 200) {
                    // Lấy kết quả tính BMI và hiển thị lên HTML
                    let show = (this.responseText);
                    console.log(show);
                }
            };
            xhr.send(formData);
        }

        function getValue(id) {
            var inputVal = document.getElementById("myInput").value;
            console.log(inputVal);
            add_cart(id, inputVal);
            // Do something with inputVal
        }
    </script>
@endsection
