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
            let content = "{{ csrf_token() }}"
            xhr.setRequestHeader('X-CSRF-TOKEN', content)
            xhr.send(param);

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
                        <h1>Shop</h1>
                    </div>
                </div>
                <div class="col-lg-7">

                </div>
            </div>
        </div>
    </div>
    <!-- End Hero Section -->
@endsection

@section('product')
    <div class="untree_co-section product-section before-footer-section">
        <div class="container">
            <div class="row">
                @foreach ($products as $product)
                    <!-- Start Column 1 -->
                    <div class="col-12 col-md-4 col-lg-3 mb-5">
                        <a class="product-item" href="#">
                            <img src="https://noithatphatphat.com/wp-content/uploads/2020/12/sofa-{{ $product->id }}.jpg"
                                class="img-fluid product-thumbnail">
                            <h3 class="product-title">{{ $product->name }}</h3>
                            <strong class="product-price">${{ $product->price }}</strong>

                            <span class="icon-cross" onclick="add_cart({{ $product->id }}, 1)">
                                <img src="images/cross.svg" class="img-fluid">
                            </span>
                        </a>
                    </div>
                    <!-- End Column 1 -->
                @endforeach


                {{-- <!-- Start Column 2 -->
                <div class="col-12 col-md-4 col-lg-3 mb-5">
                    <a class="product-item" href="#">
                        <img src="images/product-1.png" class="img-fluid product-thumbnail">
                        <h3 class="product-title">Nordic Chair</h3>
                        <strong class="product-price">$50.00</strong>

                        <span class="icon-cross" onclick="add_cart()">
                            <img src="images/cross.svg" class="img-fluid">
                        </span>
                    </a>
                </div>
                <!-- End Column 2 -->

                <!-- Start Column 3 -->
                <div class="col-12 col-md-4 col-lg-3 mb-5">
                    <a class="product-item" href="#">
                        <img src="images/product-2.png" class="img-fluid product-thumbnail">
                        <h3 class="product-title">Kruzo Aero Chair</h3>
                        <strong class="product-price">$78.00</strong>

                        <span class="icon-cross" onclick="add_cart()">
                            <img src="images/cross.svg" class="img-fluid">
                        </span>
                    </a>
                </div>
                <!-- End Column 3 -->

                <!-- Start Column 4 -->
                <div class="col-12 col-md-4 col-lg-3 mb-5">
                    <a class="product-item" href="#">
                        <img src="images/product-3.png" class="img-fluid product-thumbnail">
                        <h3 class="product-title">Ergonomic Chair</h3>
                        <strong class="product-price">$43.00</strong>

                        <span class="icon-cross" onclick="add_cart()">
                            <img src="images/cross.svg" class="img-fluid">
                        </span>
                    </a>
                </div>
                <!-- End Column 4 -->


                <!-- Start Column 1 -->
                <div class="col-12 col-md-4 col-lg-3 mb-5">
                    <a class="product-item" href="#">
                        <img src="images/product-3.png" class="img-fluid product-thumbnail">
                        <h3 class="product-title">Nordic Chair</h3>
                        <strong class="product-price">$50.00</strong>

                        <span class="icon-cross" onclick="add_cart()">
                            <img src="images/cross.svg" class="img-fluid">
                        </span>
                    </a>
                </div>
                <!-- End Column 1 -->

                <!-- Start Column 2 -->
                <div class="col-12 col-md-4 col-lg-3 mb-5">
                    <a class="product-item" href="#">
                        <img src="images/product-1.png" class="img-fluid product-thumbnail">
                        <h3 class="product-title">Nordic Chair</h3>
                        <strong class="product-price">$50.00</strong>

                        <span class="icon-cross" onclick="add_cart()">
                            <img src="images/cross.svg" class="img-fluid">
                        </span>
                    </a>
                </div>
                <!-- End Column 2 -->

                <!-- Start Column 3 -->
                <div class="col-12 col-md-4 col-lg-3 mb-5">
                    <a class="product-item" href="#">
                        <img src="images/product-2.png" class="img-fluid product-thumbnail">
                        <h3 class="product-title">Kruzo Aero Chair</h3>
                        <strong class="product-price">$78.00</strong>

                        <span class="icon-cross" onclick="add_cart()">
                            <img src="images/cross.svg" class="img-fluid">
                        </span>
                    </a>
                </div>
                <!-- End Column 3 -->

                <!-- Start Column 4 -->
                <div class="col-12 col-md-4 col-lg-3 mb-5">
                    <a class="product-item" href="#">
                        <img src="images/product-3.png" class="img-fluid product-thumbnail">
                        <h3 class="product-title">Ergonomic Chair</h3>
                        <strong class="product-price">$43.00</strong>

                        <span class="icon-cross" onclick="add_cart()">
                            <img src="images/cross.svg" class="img-fluid">
                        </span>
                    </a>
                </div>
                <!-- End Column 4 --> --}}

            </div>
        </div>
    </div>
@endsection
