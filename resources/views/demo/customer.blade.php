@extends('demo.layouts.app')
@section('team')
    <!-- Start Team Section -->
    <div class="untree_co-section">
        <div class="container">

            <div class="row mb-5">
                <div class="col-lg-5 mx-auto text-center">
                    <h1 class="section-title">Rank {{ $rank_name }}</h1>
                </div>
            </div>
            <div class="col-lg-5 mx-auto text-md-start">
                <h4 class="section-title">You have {{ $rank_point}} point </h4>
            </div>
            <div class="col-lg-5 mx-auto text-md-start">
                <h4 class="section-title">You need {{ $rest_point }} point to rank up </h4>
            </div>
            <div class="progress" style="margin-bottom: 5px;">
                <div class="progress-bar" role="progressbar" style="width: {{ $rank_point/20}}%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
              </div>
            <div class="progress" style="margin:auto;">
                <div class="progress-bar bg-success" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                <div class="progress-bar bg-info" role="progressbar" style="width: 25%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                <div class="progress-bar bg-warning" role="progressbar" style="width: 25%" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
                <div class="progress-bar bg-danger" role="progressbar" style="width: 25%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="12"></div>
              </div>
            <div class="row">
                @php
                    $i=1;
                @endphp
                @foreach ($ranks as $rank)
                <div class="col-12 col-md-6 col-lg-3 mb-5 mb-md-0">
                    <img src="images/rank{{$i}}.jpg" class="img-fluid mb-5">
                    <h3 class="text-uppercase">{{ $rank->rank}}</h3>
                    <p>You need {{ $rank->point}} points to reach this rank
                    </p>
                </div>
                @php
                    $i +=1;
                @endphp
                @endforeach
            </div>
        </div>
    </div>
    <!-- End Team Section -->
@endsection


