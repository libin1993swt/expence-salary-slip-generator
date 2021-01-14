@extends('layouts.app')

@section('content')
  <div class="container-fluid">
    <!-- Breadcrumbs-->
    <ol class="breadcrumb">
      <li class="breadcrumb-item">
        <a href="#">Dashboard</a>
      </li>
      <li class="breadcrumb-item active">Slip</li>
    </ol>
    <!-- Example DataTables Card-->
    <div class="card mb-3">
      <div class="card-header">
        <i class="fa fa-table"></i> Slip Table
        <a class="btn btn-sm btn-success float-right" href="{{ url('admin/slips/create') }}">Add New</a>
      </div>
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
            <thead>
              <tr>
                <th>#</th>
                <th>Name</th>
                <th>Designation</th>
                <th>Pay Period</th>
                <th>Payment Date</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tfoot>
              <tr>
                <th>#</th>
                <th>Name</th>
                <th>Designation</th>
                <th>Pay Period</th>
                <th>Payment Date</th>
                <th>Actions</th>
              </tr>
            </tfoot>
            <tbody>
              @foreach($records as $key => $record)
                <tr>
                  <td>{{ ++$key }}</td>
                  <td>{{ $record->employee->name }}</td>
                  <td>{{ $record->employee->designation }}</td>
                  <td>{{ $record->pay_period }}</td>
                  <td>{{ $record->date->format('d-m-Y') }}</td>
                  <td>
                    <a href="{{ url('admin/slips/' . $record->id) }}" title="View Expense"><button class="btn btn-info btn-sm"><i class="fa fa-eye" aria-hidden="true"></i> View</button></a>
                    
                    <a href="{{ url('admin/slips/' . $record->id . '/edit') }}" title="Edit Expense"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>

                    <form method="POST" action="{{ url('admin/slips' . '/' . $record->id) }}" accept-charset="UTF-8" style="display:inline">
                        {{ method_field('DELETE') }}
                        {{ csrf_field() }}
                        <button type="submit" class="btn btn-danger btn-sm" title="Delete Expense" onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button>
                    </form>
                  </td>
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