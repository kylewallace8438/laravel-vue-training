@extends('demo.layouts.app')

@section('script')
    <script>
        function add_cart(id, check) {
            // Creating Our XMLHttpRequest object 
            let product_id = id;
            // let check = check;
            var xhr = new XMLHttpRequest();
            // Making our connection  
            var url = "{{ route('add.cart') }}?";
            var param = new FormData();
            param.append('product_id', product_id);
            param.append('check', check);


            console.log(param);
            xhr.onreadystatechange = function(e) {
                if (this.readyState == 4 && this.status == 200) {
                    try {
                        let show = JSON.parse(this.responseText);
                        console.log(show)
                        // if ('msg' in show) {}
                        // if (typeof show == 'Object' && show.hasOwnProperty('msg'))
                    } catch (e) {
                        console.error(e)
                    }
                }
            }

            xhr.open("POST", url, true);
            //$('meta[name="csrf-token"]').attr('content')
            let content = "{{ csrf_token() }}"
            // console.log(content);
            xhr.setRequestHeader('X-CSRF-TOKEN', content)
            xhr.send(param);

        }

        function checkvalue(id) {
            var amount = document.getElementById('product ' + id).value;
            add_cart(id, amount);
        }
    </script>
@endsection

@section('hero')
    <!-- Start Hero Section -->
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
    <!-- End Hero Section -->
@endsection

@section('content')
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
                                    $sub_total = 0;
                                    $total = 0;
                                @endphp
                                @foreach ($carts as $cart)
                                    <tr>
                                        <td class="product-thumbnail">
                                            <img src="https://noithatphatphat.com/wp-content/uploads/2020/12/sofa-{{ $cart->product_id }}.jpg"
                                                alt="Image" class="img-fluid">
                                        </td>
                                        <td class="product-name">
                                            <h2 class="h5 text-black">{{ $cart->product->name }}</h2>
                                        </td>
                                        <td>${{ $cart->price }}</td>
                                        <td>
                                            <div class="input-group mb-3 d-flex  quantity-container "
                                                style="max-width: 120px; margin:auto;">
                                                <div class="input-group-prepend">
                                                    <button class="btn btn-outline-black decrease" type="button"
                                                        onclick="add_cart({{ $cart->product_id }},0)">&minus;</button>
                                                </div>
                                                <input type="text" id="product {{ $cart->product_id }}"
                                                    class="form-control text-center quantity-amount"
                                                    value="{{ $cart->amount }}" placeholder=""
                                                    aria-label="Example text with button addon"
                                                    aria-describedby="button-addon1"
                                                    onblur="checkvalue({{ $cart->product_id }})">
                                                <div class="input-group-append">
                                                    <button class="btn btn-outline-black increase" type="button"
                                                        onclick="add_cart({{ $cart->product_id }},1)">&plus;</button>
                                                </div>
                                            </div>
                                        </td>
                                        {{-- @php
                                            $total = $cart['price']*$cart['amount']
                                        @endphp --}}
                                        @php
                                            if ($cart->discount_price == -1) {
                                                $sub_total += $cart->amount * $cart->price;
                                            } else {
                                                $sub_total += $cart->amount * $cart->discount_price;
                                            }
                                            $total += $cart->amount * $cart->price;
                                            
                                        @endphp
                                        @if ($cart->discount_price == -1)
                                            <td>
                                                ${{ $cart->amount * $cart->price }}
                                            </td>
                                        @else
                                            <td>
                                                <p style="text-decoration: line-through">
                                                    ${{ $cart->amount * $cart->price }}</p>
                                                ${{ $cart->amount * $cart->discount_price }}
                                            </td>
                                        @endif

                                        <td><a href="{{ route('remove.product.cart', ['id' => $cart->product_id]) }}"
                                                class="btn btn-black btn-sm">X</a>
                                        </td>
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
                            <button class="btn btn-black btn-sm btn-block"
                                onclick="window.location='{{ route('cart') }}'">Update Cart</button>
                        </div>
                        <div class="col-md-6">
                            <button class="btn btn-outline-black btn-sm btn-block"
                                onclick="window.location='{{ route('shop') }}'">Continue Shopping</button>
                        </div>
                    </div>
                    <form method="POST" action="{{ route('applyCoupon.cart') }}">
                        @csrf
                        <div class="row">
                            <div class="col-md-12">
                                <label class="text-black h4" for="coupon">Coupon</label>
                                <p>Enter your coupon code if you have one.</p>
                            </div>
                            <div class="col-md-8 mb-3 mb-md-0">
                                <input type="text" class="form-control py-3" id="coupon" placeholder="Coupon Code"
                                    name="coupon">
                            </div>
                            <div class="col-md-4">
                                <button type="submit" class="btn btn-black ">Apply Coupon</button>
                            </div>
                        </div>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th class="text-primary"><i class="fas fa-paint-brush"></i>Coupon You Have
                                        Applied</th>
                                    <th class="product-remove">Remove</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    @if (session('coupon') != null)
                                        <td>
                                            <p> {{ session('coupon')->code }} : {{ session('coupon')->des }}</p>
                                        </td>
                                        <td><a href="{{ route('remove.coupon.cart') }}" class="btn btn-black btn-sm">X</a>
                                        </td>
                                    @endif

                                </tr>
                            </tbody>
                        </table>
                    </form>
                    <br>
                    @if (session('status') != null)
                        @if (session('status') == 'Coupon applied successfully!' || session('status') == 'Cancel coupon successfully!')
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                        @else
                            <div class="alert alert-danger">
                                {{ session('status') }}
                            </div>
                        @endif
                    @endif
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
                                    <span class="text-black">Discount price</span>
                                </div>
                                <div class="col-md-6 text-right">
                                    <strong class="text-black">${{ $sub_total - $total }}</strong>
                                </div>
                            </div>
                            <div class="row mb-5">
                                <div class="col-md-6">
                                    <span class="text-black">Total</span>
                                </div>
                                <div class="col-md-6 text-right">
                                    <strong class="text-black">${{ $sub_total }}</strong>
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
