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
                            <th style="width: 8%">
                                Order_id
                            </th>
                            <th style="width: 15%">
                                Customer Name
                            </th>
                            <th style="width: 15%">
                                Address
                            </th>
                            <th style="width: 10%">
                                Coupon code
                            </th>
                            <th style="width: 16%">
                                Order Time
                            </th>
                            <th style="width: 8%">
                                Price
                            </th>
                            <th style="width: 6%" class="text-center">
                                Status
                            </th>
                            <th style="width: 12%">
                            </th>
                            <th style="width: 12%">
                            </th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach ($orders as $order)
                            <tr>
                                <td>
                                    <p class="text-center">#{{ $order->id }}</p>
                                </td>
                                <td>
                                    <p>
                                        <a
                                            href="{{ route('orders.detail', ['id' => $order->id]) }}">{{ $order->user_id }}</a>
                                    </p>

                                </td>
                                <td>
                                    <p>
                                        {{ $order->address }}
                                    </p>
                                </td>

                                <td class="project-state">
                                    <p>{{ $order->coupon_id }}</p>
                                </td>
                                <td>
                                    <p>{{ $order->create_time }}</p>
                                </td>

                                <td>
                                    @php
                                        $products = $order->order_detail;
                                        $total = 0.0;
                                        foreach ($products as $product) {
                                            $total = $total + $product->discount_price * $product->amount;
                                        }
                                        echo '<p>' . $total . '</p>';
                                    @endphp

                                </td>

                                <td>
                                    @if ($order->status == 0)
                                        <p class="text-center">Not paid</p>
                                    @else
                                        <p class="text-center">Paid</p>
                                    @endif
                                </td>
                                <td class="project-actions text-right">

                                    <form action="{{ route('orders.confirm', ['id' => $order->id]) }}" method="post">
                                        @csrf
                                        @if ($order->status == 0)
                                            <button class="btn btn-primary btn-sm" type="submit"> CONFIRM </button>
                                        @else
                                            <button class="btn btn-primary btn-sm" type="submit" disabled> CONFIRM </button>
                                        @endif
                                    </form>
                                    {{-- <a class="btn btn-primary btn-sm" href="{{ route('orders.confirm', ['id' => $order->id]) }}"> --}}
                                    {{-- <a class="btn btn-primary btn-sm" href="#">
                                        <i class="fas fa-folder">
                                        </i>
                                        CONFIRM
                                    </a> --}}

                                </td>
                                <td>
                                    <form action="{{ route('orders.delete', ['id' => $order->id]) }}" method="post">
                                        @csrf
                                        @method('delete')
                                        <button class="btn btn-danger btn-sm" type="submit"><span class="fas fa-trash">
                                            </span> Delete </button>
                                    </form>
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
