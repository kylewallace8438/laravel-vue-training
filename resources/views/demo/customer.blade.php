@extends('demo.layouts.app')





@section('team')
    <!-- Start Team Section -->
    <div class="untree_co-section">
        <div class="container">

            <div class="row mb-5">
                <div class="col-lg-5 mx-auto text-center">
                    <h2 class="section-title">Rank</h2>
                </div>
            </div>

            <div class="row">

                <!-- Start Column 1 -->
                <div class="col-12 col-md-6 col-lg-3 mb-5 mb-md-0">
                    <img src="images/person_1.jpg" class="img-fluid mb-5">
                    <h3 clas><a href="#">Bronze</a></h3>
                    <p>Separated they live in.
                        Separated they live in Bookmarksgrove right at the coast of the Semantics, a large language ocean.
                    </p>
                </div>
                <!-- End Column 1 -->

                <!-- Start Column 2 -->
                <div class="col-12 col-md-6 col-lg-3 mb-5 mb-md-0">
                    <img src="images/person_1.jpg" class="img-fluid mb-5">
                    <h3 clas><a href="#">Silver</a></h3>
                    <p>Separated they live in.
                        Separated they live in Bookmarksgrove right at the coast of the Semantics, a large language ocean.
                    </p>
                </div>
                <!-- End Column 2 -->

                <!-- Start Column 3 -->
                <div class="col-12 col-md-6 col-lg-3 mb-5 mb-md-0">
                    <img src="images/person_1.jpg" class="img-fluid mb-5">
                    <h3 clas><a href="#">Gold</a></h3>
                    <p>Separated they live in.
                        Separated they live in Bookmarksgrove right at the coast of the Semantics, a large language ocean.
                    </p>
                </div>
                <!-- End Column 3 -->

                <!-- Start Column 4 -->
                <div class="col-12 col-md-6 col-lg-3 mb-5 mb-md-0">
                    <img src="images/person_1.jpg" class="img-fluid mb-5">
                    <h3 clas><a href="#">Diamond</a></h3>
                    <p>Separated they live in.
                        Separated they live in Bookmarksgrove right at the coast of the Semantics, a large language ocean.
                    </p>
                </div>
                <!-- End Column 4 -->



            </div>
        </div>
    </div>
    <!-- End Team Section -->
@endsection

@section('testimonial')
    @include('demo.layouts.testimonial')
@endsection
