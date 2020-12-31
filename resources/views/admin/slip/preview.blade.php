@extends('layouts.app')

@section('style')
<style type="text/css">
    th {
        background-color: #f8f9fa;
        color: black;

    } 
    .net-amount {
        display: block;
        background: aliceblue;
        padding: 10px 8px;
        margin-bottom: 10px;
        font-size: 18px;
    }
    .deatils span {
        display: block;
        margin: 0 0 5px;
    }
</style>
@endsection

@section('content')
        <div class="container-fluid">
            <!-- Breadcrumbs-->
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                  <a href="#">Dashboard</a>
                </li>
                <li class="breadcrumb-item active">Slip</li>
            </ol>

            <form method="POST" action="{{ url('admin/slips/generate-pdf') }}" accept-charset="UTF-8" class="form-horizontal" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="card mb-3">
                    <div class="card-header">
                        <i class="fa fa-plus"></i> Slip Preview
                        <a class="btn btn-sm btn-success float-right" href="{{ url('admin/slips/create') }}">Back</a>
                        <button class="btn btn-sm btn-danger float-right mr-2" type="submit">
                            Generate PDF
                        </button>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <span><b>{{ $company->name }}</b></span> <br>
                                <span>{{ $company->address }}</span>
                            </div>
                            <div class="col-md-6 text-right">
                                <span>Company Log</span>
                            </div>
                        </div>
                        <hr>

                        <div class="row">
                            <div class="col-md-12">
                                <span><b>Payslip for the month of {{ $pay_period }}</b></span> <br> <br>
                                <span><b>Employee Pay Summary</b></span>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="row deatils">
                                    <div class="col-md-6">
                                        <span>Employee Name </span> 
                                        <span>Designation </span> 
                                        <span>Date of Joining </span> 
                                        <span>Pay Period </span> 
                                        <span>Pay Date </span> 
                                        <span>PF A/C Number </span> 
                                        <span>UAN Number </span>
                                    </div>

                                    <div class="col-md-6">
                                        <span>: {{ $employee->name }}</span> 
                                        <span>: {{ $employee->designation }}</span> 
                                        <span>: {{ $employee->join_date->format('d-m-Y') }}</span> 
                                        <span>: {{ $pay_period }}</span> 
                                        <span>: {{ date('d-m-Y') }} </span> 
                                        <span>: {{ $employee->pf_account_number }} </span> 
                                        <span>: {{ $employee->uan_number }} </span> 
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                            </div>
                        </div>
                        <hr>

                        <div class="row">
                            <div class="col-md-6 pr-0">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>EARNINGS</th>
                                            <th>AMOUNT</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($earnings as $earn)
                                        <tr>
                                            <td>{{ $earn->name }}</td>
                                            <td>
                                                <input type="text" class="form-control earnings" name="earnings[{{ str_replace(' ','_',strtolower($earn->name)) }}]">
                                            </td>
                                        </tr>
                                        @endforeach
                                        <tr>
                                            <td><b>Gross Earnings</b></td>
                                            <td><div class="total-gross-earn">0.00</div></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>

                            <div class="col-md-6 pl-0">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>DEDUCTIONS</th>
                                            <th>AMOUNT</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($deductions as $deduct)
                                        <tr>
                                            <td>{{ $deduct->name }}</td>
                                            <td>
                                                <input type="text" class="form-control deductions" name="deductions[{{ str_replace(' ','_',strtolower($deduct->name)) }}]">
                                            </td>
                                        </tr>
                                        @endforeach
                                        <tr>
                                            <td><b>Total Deductions</b></td>
                                            <td><div class="total-deduct">0.00</div></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <span class="net-amount rounded">
                                    Total Net Payable ₹ <span class="amount">0.00</span>
                                </span>
                            </div>
                            <div class="col-md-12">
                                <span>Total Net Payable = (Gross Earnings - Total Deductions)</span>
                            </div>
                        </div>

                    </div>
                </div>
            </form>
        </div>
@endsection

@section('script')
<script type="text/javascript">
    $(document).ready(function(){
        $(".earnings").each(function(){
            $(this).val(0);
        });
        $(".deductions").each(function(){
            $(this).val(0);
        });

        $(".earnings").on('keyup',function(){
            let value = $(this).val().replace(/^0+/, '');
            $(this).val(value);
        });

        let total_net_amount = 0;
        let total_deduction_amount = 0;
        $(".earnings").on('change',function(){
            total_net_amount = parseFloat(total_net_amount) + parseFloat($(this).val());
            $(".amount").text('');
            $(".amount").text(total_net_amount);
            total_net_amount = parseFloat(total_net_amount) - (total_deduction_amount)
            $(".total-gross-earn").text(total_net_amount); 
        });

      
        $(".deductions").on('change',function(){

            total_deduction_amount = parseFloat(total_deduction_amount) + parseFloat($(this).val());
            $(".total-deduct").text(total_deduction_amount);
            total_net_amount = parseFloat(total_net_amount) - (total_deduction_amount)
            $(".amount").text(total_net_amount); 
        });
    });
</script>
@endsection