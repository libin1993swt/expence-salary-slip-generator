@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            @include('admin.sidebar')

            <div class="col-md-9">
                <div class="card">
                    <div class="card-header">Expense</div>
                    <div class="card-body">
                        <form method="GET" id="reportForm" action="{{ url('admin/reports/users') }}" accept-charset="UTF-8" role="search">
                            <div class="row form-group">

                                <div class="col-md-3">
                                    <select class="form-control" name="search[user_id]">
                                        <option value="">Select User</option>
                                        @foreach($users as $user)
                                            <option value="{{ $user->id }}" {{ isset($keyword['user_id']) && ($keyword['user_id'] == $user->id) ? 'selected' : '' }} >{{ $user->full_name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-md-3">
                                    <select class="form-control" name="search[month]">
                                        <option value="">Select Month</option>
                                        @foreach($months as $key => $month)
                                            <option value="{{ ++$key }}"  {{ isset($keyword['month']) && ($keyword['month'] == $key++ ) ? 'selected' : '' }} >{{ $month }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                
                                <div class="col-md-3">
                                    <input class="form-control" name="search[from_date]" type="date" id="date" value="{{ isset($keyword['from_date']) && ($keyword['from_date'] != '' ) ? $keyword['from_date'] : '' }}" >
                                </div>

                                <div class="col-md-3">
                                    <input class="form-control" name="search[to_date]" type="date" id="date" value="{{ isset($keyword['to_date']) && ($keyword['to_date'] != '' ) ? $keyword['to_date'] : '' }}" >
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <button class="btn btn-success" type="submit" id="search">Search</button>
                                    <a class="btn btn-secondary" href="{{ url('admin/reports/users') }}">Clear</a>
                                </div>
                                
                                @php
                                    $query = http_build_query(array($keyword));
                                @endphp
                                <div class="col-md-2">
                                    <a class="btn btn-danger" id="generatePdf" href="{{ url('admin/reports/pdf') }}" >Generate PDF</a>
                                </div>
                            </div>
                        </form>

                        <br/>
                        <br/>

                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr> 
                                        <th>User</th> 
                                        <th>Total Amount</th>
                                        <th>Amount Per User</th>
                                        <th>Due Amount</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($userExpenceSum as $sum)

                                    @php
                                        $perUserAmount = $userExpenceTotal/count($userExpenceSum);
                                    @endphp
                                    <tr>
                                        <td>{{ $sum->users->full_name }}</td>
                                        <td>{{ $sum->user_sum }}</td>
                                        <td>{{ number_format($perUserAmount,2) }}</td>
                                        <td>
                                            @if($perUserAmount == $sum->user_sum)
                                                0
                                            @elseif($perUserAmount < $sum->user_sum)
                                                <span style="color: #1e7e34;">
                                                    {{ number_format($sum->user_sum - $perUserAmount,2) }}
                                                </span>
                                            @else 
                                                <span style="color: #dc3545;">
                                                    {{ number_format($perUserAmount - $sum->user_sum,2) }}
                                                </span>
                                            @endif
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <br/>
                        <br/>
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>#</th><th>User</th><th>Date</th><th>Amount</th><th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @php
                                    $totalAmount = 0;
                                @endphp
                                @foreach($expense as $key => $item)
                                    @php
                                        $totalAmount += $item->amount;
                                    @endphp
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->users->full_name }}</td><td>{{ $item->date }}</td><td>{{ $item->amount }}</td>
                                        <td>
                                            <a href="{{ url('/admin/expense/' . $item->id) }}" title="View Expense" target="_blank"><button class="btn btn-info btn-sm"><i class="fa fa-eye" aria-hidden="true"></i> View</button></a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th></th><th></th><th>Total</th><th>{{ $totalAmount }}</th><th></th>
                                    </tr>
                                </tfoot>
                            </table>
                            <div class="pagination-wrapper"> {!! $expense->appends(['search' => Request::get('search')])->render() !!} </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('script')
<script type="text/javascript">
    var pdf_url = "{{ route('admin.reports.pdf') }}";
    var search_url = "{{ route('admin.reports.search') }}";
    $(document).ready(function() {
        $("#generatePdf").click(function(event){
            event.preventDefault();
            $('#reportForm').attr('action', pdf_url).submit();
        }); 
        $("#search").click(function(event){
            event.preventDefault();
            $('#reportForm').attr('action', search_url).submit();
        }); 
    });
</script>
@endsection

