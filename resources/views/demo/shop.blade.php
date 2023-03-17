@extends('demo.layouts.app')
@section('hero')
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
@endsection
@section('product-section')
    <div class="untree_co-section product-section before-footer-section">
        <div class="container">
            <div class="row">

                <!-- Start Column 1 -->
                @foreach ($products as $product)
                <div class="col-12 col-md-4 col-lg-3 mb-5">
                    <a class="product-item" href="#">
                        <img src="images/product-3.png" class="img-fluid product-thumbnail">
                        <h3 class="product-title">{{$product->name}}</h3>
                        <strong class="product-price">${{$product->price}}</strong>

                        <span class="icon-cross" onclick="add_cart({{$product->id}}, -2, '{{$product->name}}', {{$product->price}})">
                            <img src="images/cross.svg" class="img-fluid">
                        </span>
                    </a>
                </div>
                @endforeach
                
                <!-- End Column 1 -->

                <!-- Start Column 2 -->
                {{-- <div class="col-12 col-md-4 col-lg-3 mb-5">
                    <a class="product-item" href="#">
                        <img src="images/product-1.png" class="img-fluid product-thumbnail">
                        <h3 class="product-title">Nordic Chair</h3>
                        <strong class="product-price">$50.00</strong>

                        <span class="icon-cross" onclick="add_cart(2, -2, 'Nordic Chair', 50.00) ">
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

                        <span class="icon-cross" onclick="add_cart(3,-2,'Kruzo Aero Chair', 78.00)">
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

                        <span class="icon-cross" onclick="add_cart(4,-2,'Ergonomic Chair', 43.00)">
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

                        <span class="icon-cross" onclick="add_cart(5,-2,'Nordic Chair', 50.00)">
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

                        <span class="icon-cross" onclick="add_cart(6,-2,'Nordic Chair', 50.00)">
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

                        <span class="icon-cross" onclick="add_cart(7,-2,'Kruzo Aero Chair', 78.00)">
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

                        <span class="icon-cross" onclick="add_cart(8, -2, 'Ergonomic Chair', 43.00)">
                            <img src="images/cross.svg" class="img-fluid">
                        </span>
                    </a>
                </div>
                <!-- End Column 4 --> --}}

            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        function add_cart(id, add, name, price) {
            console.log(id);
            console.log(add);
            console.log(name);
            console.log(price);


            var formData = new FormData();
            formData.append('id', id);
            formData.append('add', add);
            formData.append('name', name);
            formData.append('price', price);

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
    </script>
@endsection
