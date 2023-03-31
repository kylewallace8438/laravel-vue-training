@extends('admin.layouts.app')
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Coupon Add</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Coupon Add</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <form method="POST" action="{{ route('coupon.create.store') }}">
            @csrf
            <section class="content">

                <div class="row">
                    <div class="col-md-6">
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">Coupon details</h3>

                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse"
                                        title="Collapse">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="code">coupon code</label>
                                    <input type="text" id="code" class="form-control" name="code">
                                </div>
                                <div class="form-group">
                                    <label for="des">Description</label>
                                    <textarea id="des" name="des" class="form-control" rows="4"></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="price_type">coupon type</label>
                                    <select id="price_type" class="form-control custom-select" name="price_type">
                                        <option selected disabled>Select one</option>
                                        <option value="1">%</option>
                                        <option value="2">$</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="price">Value</label>
                                    <input type="text" id="price" class="form-control" name="price">
                                </div>
                                <div class="form-group">
                                    <label for="condition">condition price</label>
                                    <input type="text" id="condition" class="form-control" name="condition">
                                </div>

                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                    <div class="col-md-6">
                        <div class="card card-secondary">
                            <div class="card-header">
                                <h3 class="card-title">Duration Of Coupon</h3>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse"
                                        title="Collapse">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                </div>
                            </div>

                            <div class="card-body">
                                <div class="row">

                                    <div class="form-group" style="width:100%;">
                                        <label>USERS</label>
                                        <select class="form-control select2" name="user[]" multiple="multiple">
                                            <option selected="All" value="All">All</option>
                                            @foreach ($users as $user)
                                                <option value="{{ $user->name }}">{{ $user->name }}</option>
                                            @endforeach

                                        </select>
                                    </div>
                                    <div class="form-group" style="width:100%;">
                                        <label>Products</label>
                                        <select class="form-control select2" name="product[]" multiple="multiple">
                                            <option selected="All">All</option>
                                            @foreach ($products as $product)
                                                <option value="{{ $product->name }}">{{ $product->name }}</option>
                                            @endforeach

                                        </select>
                                    </div>

                                </div>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="date_start">date start</label>
                                    <input type="date" class="form-control float-right" name="date_start">
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="date_end">date end</label>
                                    <input type="date" class="form-control float-right" name="date_end">
                                </div>
                            </div>
                        </div>


                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <div class="row">
                    <div class="col-12">
                        <a href="{{ route('coupon.list') }}" class="btn btn-secondary">Cancel</a>
                        <input type="submit" value="Create new Project" class="btn btn-success float-right">
                    </div>
                </div>

            </section>
        </form>
        <!-- /.content -->
    </div>

    </div>
    <!-- /.content-wrapper -->
@endsection
