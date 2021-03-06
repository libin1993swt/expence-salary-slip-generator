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

            <div class="card mb-3">
                <div class="card-header">
                  <i class="fa fa-plus"></i> Slip Create
                  <a class="btn btn-sm btn-success float-right" href="{{ url('admin/slips') }}">Back</a>
                </div>
                <div class="card-body">
                    @if ($errors->any())
                        <ul class="alert alert-danger">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    @endif

                    <form method="POST" action="{{ url('admin/slips') }}" accept-charset="UTF-8" class="form-horizontal" enctype="multipart/form-data">
                        {{ csrf_field() }}

                        @include ('admin.slip.form', ['formMode' => 'create'])

                    </form>
                </div>
            </div>
        </div>
@endsection
