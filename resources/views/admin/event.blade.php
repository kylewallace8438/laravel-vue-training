@extends('admin.layouts.app')
@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Events</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Home</a></li>
                        <li class="breadcrumb-item active">Events</li>
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
                <a href="{{ route('events.add.show') }}" class="card-title"><button type="button"
                        class="btn btn-block btn-primary btn-lg">Add new Event</button></a>

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
                                Event_id
                            </th>
                            <th style="width: 10%">
                                Event Name
                            </th>
                            <th style="width: 8%" class="text-center">
                                Status
                            </th>
                            <th style="width: 13%" >
                                Event Type
                            </th>
                            <th style="width: 13%" >
                                Gia tri quy doi(10d)
                            </th>
                            <th style="width: 20%">
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($events as $event)
                            <tr>
                                <td>
                                    {{ $event->id }}
                                </td>
                                <td>
                                    {{ $event->name }}
                                </td>

                                @if ($event->status == 0)
                                    <td class="project-state">
                                        <span class="badge badge-success" style="background-color:grey;">OFF</span>
                                    </td>
                                @else
                                    <td class="project-state">
                                        <span class="badge badge-success">ON</span>
                                    </td>
                                @endif
                                @if ($event->type == 1)
                                <td>
                                    Theo so luong don
                                </td>
                                <td>
                                    Moi {{$event->unit}} don
                                </td>
                                @else
                                <td>
                                    Theo so tien
                                </td>
                                <td>
                                    Moi ${{ $event->unit }}
                                </td>
                                @endif
                                <td class="project-actions text-right">
                                    @if ($event->status == 0)
                                    <a class="btn btn-primary btn-sm" href="{{ route('events.edit', ['id'=>$event->id]) }}">
                                        <i class="fas fa-folder">
                                        </i>
                                        ON
                                    </a>
                                        
                                    @else
                                    <a class="btn btn-info btn-sm" href="{{ route('events.edit', ['id'=>$event->id]) }}" >
                                        <i class="fas fa-pencil-alt">
                                        </i>
                                        OFF
                                    </a>
                                        
                                    @endif
                                    <a class="btn btn-danger btn-sm" href="{{ route('events.delete', ['id'=>$event->id]) }}">
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
