@extends('admin.layouts.app')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Profile</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">User Profile</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-3">

                    <!-- Profile Image -->
                    <div class="card card-primary card-outline">
                        <div class="card-body box-profile">
                            <div class="text-center">
                                <img class="profile-user-img img-fluid img-circle" src="../../dist/img/user4-128x128.jpg"
                                    alt="User profile picture">
                            </div>

                            <h3 class="profile-username text-center">Nina Mcintire</h3>

                            <p class="text-muted text-center">Software Engineer</p>

                            <ul class="list-group list-group-unbordered mb-3">
                                <li class="list-group-item">
                                    <b>Followers</b> <a class="float-right">1,322</a>
                                </li>
                                <li class="list-group-item">
                                    <b>Following</b> <a class="float-right">543</a>
                                </li>
                                <li class="list-group-item">
                                    <b>Friends</b> <a class="float-right">13,287</a>
                                </li>
                            </ul>

                            <a href="#" class="btn btn-primary btn-block"><b>Follow</b></a>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->

                </div>
                <!-- /.col -->
                <div class="col-md-9">
                    <div class="card">
                        <div class="card-body">
                            <table class="table table-striped projects">
                                <thead>
                                    <tr style="text-align: center">
                                        <th style="width: 40%"></th>
                                        <th style="width: 15%"> View </th>
                                        <th style="width: 15%"> Create </th>
                                        <th style="width: 15%"> Update </th>
                                        <th style="width: 15%"> Delete </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr style="text-align: center">
                                        <td> Products </td>
                                        <td>
                                            <div class="icheck-primary d-inline">
                                                <input type="checkbox" id="Product-View">
                                                <label for="Product-View">
                                                </label>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="icheck-primary d-inline">
                                                <input type="checkbox" id="Product-Create">
                                                <label for="Product-Create">
                                                </label>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="icheck-primary d-inline">
                                                <input type="checkbox" id="Product-Update">
                                                <label for="Product-Update">
                                                </label>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="icheck-primary d-inline">
                                                <input type="checkbox" id="Product-Delete">
                                                <label for="Product-Delete">
                                                </label>
                                            </div>
                                        </td>

                                    </tr>
                                    <tr style="text-align: center">
                                        <td> Customers </td>
                                        <td>
                                            <div class="icheck-primary d-inline">
                                                <input type="checkbox" id="Customer-View">
                                                <label for="Customer-View">
                                                </label>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="icheck-primary d-inline">
                                                <input type="checkbox" id="Customer-Create">
                                                <label for="Customer-Create">
                                                </label>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="icheck-primary d-inline">
                                                <input type="checkbox" id="Customer-Update">
                                                <label for="Customer-Update">
                                                </label>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="icheck-primary d-inline">
                                                <input type="checkbox" id="Customer-Delete">
                                                <label for="Customer-Delete">
                                                </label>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr style="text-align: center">
                                        <td> Orders </td>
                                        <td>
                                            <div class="icheck-primary d-inline">
                                                <input type="checkbox" id="Order-View">
                                                <label for="Order-View">
                                                </label>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="icheck-primary d-inline">
                                                <input type="checkbox" id="Order-Create">
                                                <label for="Order-Create">
                                                </label>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="icheck-primary d-inline">
                                                <input type="checkbox" id="Order-Update">
                                                <label for="Order-Update">
                                                </label>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="icheck-primary d-inline">
                                                <input type="checkbox" id="Order-Delete">
                                                <label for="Order-Delete">
                                                </label>
                                            </div>
                                        </td>

                                    </tr>
                                </tbody>
                            </table>
                            <!-- /.tab-content -->
                        </div><!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@endsection
