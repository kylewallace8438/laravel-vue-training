@extends('admin.layouts.app')
@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Orders</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Orders</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

        <!-- Default box -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Orders</h3>

                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            </div>
            <div class="card-body p-0">
                <table class="table table-striped projects">
                    <thead>
                        <tr>
                            <th style="width: 10%">
                                Order_id
                            </th>
                            <th style="width: 20%">
                                Customer Name
                            </th>
                            <th style="width: 20%">
                                Address
                            </th>
                            <th style="width: 10%">
                                Coupon code
                            </th>
                            <th style="width: 10%">
                                Order Time
                            </th>
                            <th style="width: 8%">
                                Price
                            </th>
                            <th style="width: 8%" class="text-center">
                                Status
                            </th>
                            <th style="width: 14%">
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $orders = [['order_id' => 1, 'user_name' => 'Hoang', 'address' => 'Ha Tinh', 'coupon_code' => 'xyz', 'order_time' => '24/3/2023', 'price' => 65.6, 'status' => 0], ['order_id' => 2, 'user_name' => 'Bang', 'address' => 'Ha Tinh', 'coupon_code' => 'abc', 'order_time' => '25/3/2023', 'price' => 60.6, 'status' => 0]];
                        @endphp
                        @foreach ($orders as $order)
                            <tr>
                                <td>
                                    #{{ $order['order_id'] }}
                                </td>
                                <td>
                                    <a>
                                        {{ $order['user_name'] }}
                                    </a>
                                    <br />
                                    <small>

                                    </small>
                                </td>
                                <td>
                                    <p>
                                        {{ $order['address'] }}
                                    </p>
                                </td>

                                <td class="project-state">
                                    <p>{{ $order['coupon_code'] }}</p>
                                </td>
                                <td>
                                    <p>{{ $order['order_time'] }}</p>
                                </td>

                                <td>
                                    <p>{{ $order['price'] }}</p>
                                </td>

                                <td>
                                    <p>{{ $order['status'] }}</p>
                                </td>
                                <td class="project-actions text-right">
                                    <a class="btn btn-primary btn-sm" href="#">
                                        <i class="fas fa-folder">
                                        </i>
                                        CONFIRM
                                    </a>

                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- /.card-body -->
            </div>


    </section>
    <!-- /.content -->
@endsection