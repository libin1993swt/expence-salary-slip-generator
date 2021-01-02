<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap core CSS-->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>
    <style type="text/css">
    	table{
	    width:100%;
	}
	td{
		padding: 5px;
	}
	.alnright { text-align: right; }
	.table-50 {
		width: 50%;
	}
    </style>
</head>
<body>
	<table>
		<tr>
			<td>
				<b>{{ $company->name }}</b> <br>
				{{ $company->address }}
			</td>
			<td class="alnright">
				Company Log
			</td>
		</tr>
	</table>
	<hr>

	<table>
		<tr>
			<td><b>Payslip for the month of {{ $pay_period }}</b></td>
		</tr>
		<tr>
			<td><b>Employee Pay Summary</b></td>
		</tr>
	</table>

	<table>
		<tr>
			<td>Employee Name</td> 
			<td>: {{ $employee->name }}</td>
		</tr>
		<tr>
			<td>Designation</td> 
			<td> : {{ $employee->designation }}</td>
		</tr>
		<tr>
			<td>Date of Joining</td> 
			<td> : {{ $employee->join_date->format('d-m-Y') }}</td>
		</tr>
		<tr>
			<td>Pay Period</td> 
			<td> : {{ $pay_period }}</td>
		</tr>
		<tr>
			<td>Pay Date</td> 
			<td> : {{ date('d-m-Y') }} </td>
		</tr>
		<tr>
			<td>PF A/C Number</td> 
			<td> : {{ $employee->pf_account_number }}</td>
		</tr>
		<tr>
			<td>UAN Number</td> 
			<td> : {{ $employee->uan_number }}</td>
		</tr>
	</table>
	<hr>

	<table>
		<tr>
			<td>
				<table>
					<thead >
						<tr>
							<th><b>EARNINGS</b></th>
							<th><b>AMOUNT</b></th>
						</tr>
					</thead>
					<tbody>
						@php
							$grossTotal = 0;
							$totalEarnings = 0
						@endphp
			            @foreach($earnings as $key => $earn)
			            	
			            	@php
			            		$totalEarnings = count($earnings);
			            		$grossTotal += $earn;
			            	@endphp
			            <tr>
			                <td>{{ ucwords(str_replace('_',' ',$key)) }}</td>
			                <td>
			                    {{ number_format($earn,2) }}
			                </td>
			            </tr>
			            @endforeach
			            <tr>
			                <td><b>Gross Earnings</b></td>
			                <td><div class="total-gross-earn">{{ number_format($grossTotal,2) }}</div></td>
			            </tr>
			        </tbody>
				</table>
			</td>
			<td>
				<table >
					<thead>
						<tr>
							<th><b>DEDUCTIONS</b></th>
							<th><b>AMOUNT</b></th>
						</tr>
					</thead>
					<tbody>
						@php
							$deductionTotal = 0;
							$totalDeductions = 0; 
						@endphp
			            @foreach($deductions as $key => $deduct)

			            	@php
			            		$totalDeductions = count($deductions); 
			            		$deductionTotal += $deduct;
			            	@endphp
			            <tr>
			                <td>{{ ucwords(str_replace('_',' ',$key)) }}</td>
			                <td>
			                    {{ number_format($deduct,2) }}
			                </td>
			            </tr>
			            @endforeach
			            @for($i=0;$i<$totalEarnings - $totalDeductions;$i++)
			            <tr style="color: white;">
			            	<td>test</td>
			            	<td>test</td>
			            </tr>
			            @endfor
			            <tr>
			                <td><b>Total Deductions</b></td>
			                <td><div class="total-deduct">{{ number_format($deductionTotal,2) }}</div></td>
			            </tr>
			        </tbody>
				</table>
			</td>
		</tr>
	</table>
	

    @php
    	$netTotal = $grossTotal - $deductionTotal;
    @endphp
	<table>
		<thead>
			<tr style="font-size: 20px;background: #effff2;">
				<th>Total Net Payable ₹ {{ number_format($netTotal,2) }}</th>
			</tr>
		</thead>
		<tbody>
			<tr style="color: #969ba1;font-size: 15px;" >
				<td>Total Net Payable= (Gross Earnings - Total Deductions)</td>
			</tr>
		</tbody>
	</table>
</body>
</html>