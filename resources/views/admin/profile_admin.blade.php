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
            <form action="" method="post">
                @csrf
                <div class="row">
                    <div class="col-md-3">
                        <!-- Profile Image -->
                        <div class="card card-primary card-outline">
                            <div class="card-body box-profile">
                                <div class="text-center">
                                    <img class="profile-user-img img-fluid img-circle"
                                        src="{{ asset('admin_css/dist/img/user4-128x128.jpg') }}"
                                        alt="User profile picture">
                                </div>

                                <h3 class="profile-username text-center">{{ $admin->name }}</h3>


                                <ul class="list-group list-group-unbordered mb-3">
                                    <li class="list-group-item">
                                        <b>ID</b> <a class="float-right">#{{ $admin->id }}</a>
                                    </li>
                                    <li class="list-group-item">
                                        <b>Email</b> <a class="float-right">{{ $admin->email }}</a>
                                    </li>
                                    <li class="list-group-item">
                                        <b>Role</b> <a class="float-right">Sub admin</a>
                                    </li>
                                </ul>

                                <button type="submit" class="btn btn-primary btn-block">Update</button>
                                {{-- <a href="#" class="btn btn-primary btn-block"><b>Update</b></a> --}}
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
                                        @foreach ($types as $type)
                                            <tr style="text-align: center">
                                                <td> {{$type->type}} </td>
                                                @foreach ($actions as $action)
                                                <td>
                                                    <div class="icheck-primary d-inline">
                                                        @php
                                                            $status = 0;
                                                        @endphp
                                                        @foreach ($roles as $role)
                                                            @php
                                                                if ($role->role->type == $type->type && $role->role->action == $action) {
                                                                    $status = $role->status;
                                                                }
                                                            @endphp
                                                        @endforeach
                                                        @if ($status == 0)
                                                            <input type="checkbox" id= "{{$type->type}}-{{$action}}" name="role[]"
                                                                value="{{$type->type}}-{{$action}}">
                                                        @else
                                                            <input type="checkbox" id="{{$type->type}}-{{$action}}" name="role[]"
                                                                value="{{$type->type}}-{{$action}}" checked>
                                                        @endif
                                                        <label for="{{$type->type}}-{{$action}}">
                                                        </label>
                                                    </div>
                                                </td>
                                                @endforeach
                                            </tr>
                                        @endforeach
                                        {{-- <tr style="text-align: center">
                                            <td> Products </td>
                                            <td>
                                                <div class="icheck-primary d-inline">
                                                    @php
                                                        $status = 0;
                                                    @endphp
                                                    @foreach ($roles as $role)
                                                        @php
                                                            if ($role->role->type == 'Product' && $role->role->action == 'View') {
                                                                $status = $role->status;
                                                            }
                                                        @endphp
                                                    @endforeach
                                                    @if ($status == 0)
                                                        <input type="checkbox" id="Product-View" name="role[]"
                                                            value="Product-View">
                                                    @else
                                                        <input type="checkbox" id="Product-View" name="role[]"
                                                            value="Product-View" checked>
                                                    @endif
                                                    <label for="Product-View">
                                                    </label>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="icheck-primary d-inline">
                                                    @php
                                                        $status = 0;
                                                    @endphp
                                                    @foreach ($roles as $role)
                                                        @php
                                                            if ($role->role->type == 'Product' && $role->role->action == 'Create') {
                                                                $status = $role->status;
                                                            }
                                                        @endphp
                                                    @endforeach
                                                    @if ($status == 0)
                                                        <input type="checkbox" id="Product-Create" name="role[]"
                                                            value="Product-Create">
                                                    @else
                                                        <input type="checkbox" id="Product-Create" name="role[]"
                                                            value="Product-Create" checked>
                                                    @endif

                                                    <label for="Product-Create">
                                                    </label>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="icheck-primary d-inline">
                                                    @php
                                                        $status = 0;
                                                    @endphp
                                                    @foreach ($roles as $role)
                                                        @php
                                                            if ($role->role->type == 'Product' && $role->role->action == 'Update') {
                                                                $status = $role->status;
                                                            }
                                                        @endphp
                                                    @endforeach
                                                    @if ($status == 0)
                                                        <input type="checkbox" id="Product-Update" name="role[]"
                                                            value="Product-Update">
                                                    @else
                                                        <input type="checkbox" id="Product-Update" name="role[]"
                                                            value="Product-Update" checked>
                                                    @endif

                                                    <label for="Product-Update">
                                                    </label>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="icheck-primary d-inline">
                                                    @php
                                                        $status = 0;
                                                    @endphp
                                                    @foreach ($roles as $role)
                                                        @php
                                                            if ($role->role->type == 'Product' && $role->role->action == 'Delete') {
                                                                $status = $role->status;
                                                            }
                                                        @endphp
                                                    @endforeach
                                                    @if ($status == 0)
                                                        <input type="checkbox" id="Product-Delete" name="role[]"
                                                            value="Product-Delete">
                                                    @else
                                                        <input type="checkbox" id="Product-Delete" name="role[]"
                                                            value="Product-Delete" checked>
                                                    @endif

                                                    <label for="Product-Delete">
                                                    </label>
                                                </div>
                                            </td>

                                        </tr>
                                        <tr style="text-align: center">
                                            <td> Customers </td>
                                            <td>
                                                <div class="icheck-primary d-inline">
                                                    @php
                                                        $status = 0;
                                                    @endphp
                                                    @foreach ($roles as $role)
                                                        @php
                                                            if ($role->role->type == 'Customer' && $role->role->action == 'View') {
                                                                $status = $role->status;
                                                            }
                                                        @endphp
                                                    @endforeach
                                                    @if ($status == 0)
                                                        <input type="checkbox" id="Customer-View" name="role[]"
                                                            value="Customer-View">
                                                    @else
                                                        <input type="checkbox" id="Customer-View" name="role[]"
                                                            value="Customer-View" checked>
                                                    @endif

                                                    <label for="Customer-View">
                                                    </label>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="icheck-primary d-inline ">
                                                    <input type="checkbox" id="Customer-Create" disabled>
                                                    <label for="Customer-Create">
                                                    </label>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="icheck-primary d-inline">
                                                    <input type="checkbox" id="Customer-Update" disabled>
                                                    <label for="Customer-Update">
                                                    </label>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="icheck-primary d-inline">
                                                    <input type="checkbox" id="Customer-Delete" disabled>
                                                    <label for="Customer-Delete">
                                                    </label>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr style="text-align: center">
                                            <td> Orders </td>
                                            <td>
                                                <div class="icheck-primary d-inline">
                                                    @php
                                                        $status = 0;
                                                    @endphp
                                                    @foreach ($roles as $role)
                                                        @php
                                                            if ($role->role->type == 'Order' && $role->role->action == 'View') {
                                                                $status = $role->status;
                                                            }
                                                        @endphp
                                                    @endforeach
                                                    @if ($status == 0)
                                                        <input type="checkbox" id="Order-View" name="role[]"
                                                            value="Order-View">
                                                    @else
                                                        <input type="checkbox" id="Order-View" name="role[]"
                                                            value="Order-View" checked>
                                                    @endif

                                                    <label for="Order-View">
                                                    </label>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="icheck-primary d-inline">
                                                    <input type="checkbox" id="Order-Create" disabled>
                                                    <label for="Order-Create">
                                                    </label>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="icheck-primary d-inline">
                                                    @php
                                                        $status = 0;
                                                    @endphp
                                                    @foreach ($roles as $role)
                                                        @php
                                                            if ($role->role->type == 'Order' && $role->role->action == 'Update') {
                                                                $status = $role->status;
                                                            }
                                                        @endphp
                                                    @endforeach
                                                    @if ($status == 0)
                                                        <input type="checkbox" id="Order-Update" name="role[]"
                                                            value="Order-Update">
                                                    @else
                                                        <input type="checkbox" id="Order-Update" name="role[]"
                                                            value="Order-Update" checked>
                                                    @endif

                                                    <label for="Order-Update">
                                                    </label>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="icheck-primary d-inline">
                                                    @php
                                                        $status = 0;
                                                    @endphp
                                                    @foreach ($roles as $role)
                                                        @php
                                                            if ($role->role->type == 'Order' && $role->role->action == 'Delete') {
                                                                $status = $role->status;
                                                            }
                                                        @endphp
                                                    @endforeach
                                                    @if ($status == 0)
                                                        <input type="checkbox" id="Order-Delete" name="role[]"
                                                            value="Order-Delete">
                                                    @else
                                                        <input type="checkbox" id="Order-Delete" name="role[]"
                                                            value="Order-Delete" checked>
                                                    @endif

                                                    <label for="Order-Delete">
                                                    </label>
                                                </div>
                                            </td>

                                        </tr> --}}
                                    </tbody>
                                </table>
                                <!-- /.tab-content -->
                            </div><!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                    <!-- /.col -->
                </div>
            </form>

            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@endsection
