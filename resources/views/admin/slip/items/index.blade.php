@extends('layouts.app')

@section('content')
  <div class="container-fluid">
    <!-- Breadcrumbs-->
    <ol class="breadcrumb">
      <li class="breadcrumb-item">
        <a href="#">Dashboard</a>
      </li>
      <li class="breadcrumb-item active">Slip Items</li>
    </ol>
    <!-- Example DataTables Card-->
    <div class="card mb-3">
      <div class="card-header">
        <i class="fa fa-table"></i> Slip Items Table
        <a class="btn btn-sm btn-success float-right" href="{{ url('admin/slip/items/create') }}">Add New</a>
      </div>
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
            <thead>
              <tr>
                <th>#</th>
                <th>Name</th>
                <th>Type</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tfoot>
              <tr>
                <th>#</th>
                <th>Name</th>
                <th>Type</th>
                <th>Actions</th>
              </tr>
            </tfoot>
            <tbody>
              @foreach($items as $key => $item)
                <tr>
                  <td>{{ ++$key }}</td>
                  <td>{{ $item->name }}</td>
                  <td>{{ $item->type }}</td>
                  <td></td>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
      <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>
    </div>
  </div>
  <!-- /.container-fluid-->
@endsection