@extends('admin.layouts.app')
@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Coupons List</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Home</a></li>
                        <li class="breadcrumb-item active">Coupons List</li>
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
                <a href="{{ route('coupon.create') }}" class="card-title"><button type="button"
                        class="btn btn-block btn-primary btn-lg">Add new Coupon</button></a>

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
                            <th style="width: 1%">
                                Coupon_id
                            </th>
                            <th style="width: 9%">
                                Coupon_code
                            </th>
                            <th style="width: 18%">
                                Description
                            </th>
                            <th style="width: 5%">
                                coupon type
                            </th>
                            <th style="width: 8%">
                                value
                            </th>
                            <th style="width: 8%">
                                condition
                            </th>
                            <th style="width: 8%">
                                point
                            </th>
                            <th style="width: 13%">
                                date start
                            </th>
                            <th style="width: 13%">
                                date end
                            </th>
                            <th style="width: 17%">
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($coupons as $coupon)
                            <tr>
                                <td>
                                    {{ $coupon->id }}
                                </td>
                                <td>
                                    {{ $coupon->code }}
                                </td>
                                <td>
                                    {{ $coupon->des }}
                                </td>

                                @if ($coupon->price_type == 1)
                                    <td>
                                        decrease by %
                                    </td>
                                    <td>
                                        {{ $coupon->price }}%
                                    </td>
                                @else
                                    <td>
                                        decrease by $
                                    </td>
                                    <td>
                                        {{ $coupon->price }}$
                                    </td>
                                @endif



                                <td>
                                    {{ $coupon->condition }}
                                </td>
                                <td>
                                    {{ $coupon->point }}
                                </td>
                                <td>
                                    {{ $coupon->start }}
                                </td>
                                <td>
                                    {{ $coupon->end }}
                                </td>

                                <td class="project-actions text-right">

                                    <a class="btn btn-danger btn-sm"
                                        href="{{ route('coupon.delete', ['id' => $coupon->id]) }}">
                                        <i class="fas fa-trash">
                                        </i>
                                        Delete
                                    </a>
                                </td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->

    </section>
    <!-- /.content -->
@endsection
