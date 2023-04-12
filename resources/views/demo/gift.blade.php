@extends('demo.layouts.app')



{{-- @section('hero')
    <!-- Start Hero Section -->
    <div class="hero">
        <div class="container">
            <div class="row justify-content-between">
                <div class="col-lg-5">
                    <div class="intro-excerpt">
                        <h1>Gift</h1>
                    </div>
                </div>
                <div class="col-lg-7">

                </div>
            </div>
        </div>
    </div>
    <!-- End Hero Section -->
@endsection --}}



@section('content')
<h1>My point is {{ $point }}</h1>
    <div class="untree_co-section before-footer-section">
        <div class="container">
            <div class="row mb-5">
                <form class="col-md-12" method="post">
                    <div class="card">

                        <div class="card-body p-0">
                            <table class="table table-striped projects">
                                <thead>
                                    <tr>
                                        <th style="width: 1%">
                                            Code
                                        </th>
                                        <th style="width: 10%">
                                            Rank
                                        </th>
                                        <th style="width: 8%">
                                            Point
                                        </th>
                                        <th style="width: 20%">
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($coupons as $coupon)
                                    <tr>
                                        <td>
                                            {{ $coupon->code }}
                                        </td>
                                        <td>
                                            {{ $coupon->rank_id->rank}}
                                        </td>
                                        <td>
                                            {{ $coupon->point }}
                                        </td>
                                        <td class="project-actions text-right">
                                            @if ($coupon->point <= $point)
                                            <a class="btn btn-primary btn-sm" href="{{ route('gift.point', ['id'=>$coupon->id]) }}"
                                                style="background-color: green;">
                                                DOI
                                            </a> 
                                            @else
                                            <span class="btn btn-danger btn-sm" href="" style="background-color: gray;">
                                                DOI
                                            </span>  
                                            @endif
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                </form>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="row mb-5">
                        <div class="col-md-6">
                            <button class="btn btn-outline-black btn-sm btn-block"
                                onclick="window.location='{{ route('shop') }}'">Continue Shopping</button>
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </div>
@endsection
