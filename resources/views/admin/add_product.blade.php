@extends('admin.layouts.app')
@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Products Add</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="#">Home</a></li>
          <li class="breadcrumb-item active">Products Add</li>
        </ol>
      </div>
    </div>
  </div><!-- /.container-fluid -->
</section>
<!-- Main content -->
<form action="{{ route('products.add') }}" method="post">
  @csrf
  <section class="content">
    <div class="row">
      <div class="col-md-12">
        <div class="card card-primary">
          <div class="card-header">
            <h3 class="card-title">Add</h3>
  
            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                <i class="fas fa-minus"></i>
              </button>
            </div>
          </div>
          <div class="card-body">
            <div class="form-group">
              <label for="inputName">Product Name</label>
              <input type="text" id="inputName" name="name" class="form-control">
            </div>
            <div class="form-group">
              <label for="inputClientCompany">Price</label>
              <input type="text" id="inputClientCompany" name="price" class="form-control">
            </div>
            
            <div class="form-group">
              <label for="inputDescription">Product Description</label>
              <textarea id="inputDescription" class="form-control" rows="4"></textarea>
            </div>
            {{-- <div class="form-group">
              <label for="inputStatus">Status</label>
              <select id="inputStatus" class="form-control custom-select">
                <option selected disabled>Select one</option>
                <option>On Hold</option>
                <option>Canceled</option>
                <option>Success</option>
              </select>
            </div> --}}
            {{-- <div class="form-group">
              <label for="inputProjectLeader">Project Leader</label>
              <input type="text" id="inputProjectLeader" class="form-control">
            </div> --}}
          </div>
          <!-- /.card-body -->
        </div>
        <!-- /.card -->
      </div>
    </div>
    <div class="row">
      <div class="col-12">
        <a href="{{ route('products.list') }}" class="btn btn-secondary">Cancel</a>
        <input type="submit" value="Create new Project" class="btn btn-success float-right">
      </div>
    </div>
  </section>
</form>
<!-- /.content -->
@endsection