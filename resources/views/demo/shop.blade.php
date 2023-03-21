@extends('demo.layouts.app')

@section('script')
    <script>
        function add_cart(id, check) {
            // Creating Our XMLHttpRequest object 
            
            // let check = check;
            var xhr = new XMLHttpRequest();
            // Making our connection  
            var url = "{{ route('add_cart') }}?";
            var param = new FormData();
            param.append('product_id', id);
            param.append('check', check);
            console.log(check);
            console.log(id);

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

<!-- Start Hero Section -->
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
<!-- End Hero Section -->

@section('product-section')
    <div class="untree_co-section product-section before-footer-section">
        <div class="container">
            <div class="row">

                <!-- Start Column 1 -->
                @foreach ($products as $product)
                    <div class="col-12 col-md-4 col-lg-3 mb-5">
                        <a class="product-item" href="#">
                            <img src="images/product-3.png" class="img-fluid product-thumbnail">
                            <h3 class="product-title">{{ $product->name }}</h3>
                            <strong class="product-price">${{ $product->price }}</strong>

                            <span class="icon-cross addcart-{{ $product->id }}" data-uri="{{ route('cart')}}" onclick="add_cart({{ $product->id }}, 1)">
                                <img src="images/cross.svg" class="img-fluid">
                            </span>
                        </a>
                    </div>
                @endforeach


            </div>
        </div>
    </div>
@endsection

{{-- <script>
    function add_cart(id, check) {
         const divBoxes = document.querySelectorAll("meta[name='csrf-token']");
        // let addcartElement = document.querySelector('.addcart-'+id);
        // console.log(addcartElement);
         var x = divBoxes[0].content;

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
            xhr.setRequestHeader('X-CSRF-TOKEN', x);
            console.log(x);
            var params = new FormData();
            params.append('product_id', id);
            params.append('check', check);
            console.log(params);
            xhr.send(params);
    }
</script> --}}
