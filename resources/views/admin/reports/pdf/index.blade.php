<style type="text/css">
	table {
  width:100%;
}
table, th, td {
  border: 1px solid black;
  border-collapse: collapse;
}
th, td {
  padding: 15px;
  text-align: left;
}

</style>
<table>
	<tr>
		<td style="text-align:center;"> 
			<h3> Expence Report </h3> <br/>
			<h4> {{ $period }}</h4>
		</td> 
	</tr>
	<tr>
		<td> <h4>Expence Summary</h4> </td>
	</tr>
</table>

<table>
	<tr>
		<th>User</th>
		<th>Total Amount</th>
		<th>Amount Per User</th>
		<th>Due Amount</th>
	</tr>
	@php
		$totalAmount = 0;
	@endphp

	@foreach($userExpenceSum as $sum)
		@php
            $perUserAmount = $userExpenceTotal/count($userExpenceSum);
            $totalAmount += $sum->user_sum;
        @endphp
		<tr>
			<td>{{ $sum->users->full_name }}</td>
			<td>{{ $sum->user_sum }}</td>
			<td>{{ number_format($perUserAmount,2) }}</td>
			<td>
				@if($perUserAmount == $sum->user_sum)
					0
				@elseif($perUserAmount <= $sum->user_sum)
                    <span style="color: #1e7e34;">
                    	<b>{{ number_format($sum->user_sum - $perUserAmount,2) }}</b>
                    </span>
                @else
                	<span style="color: #dc3545;"> 
                    	<b>{{ number_format($perUserAmount - $sum->user_sum,2) }}</b>
                    </span>
                @endif
			</td>
		</tr>

	@endforeach
	<tr>
		<td><b>Total Amount</b></td>
		<td><b>{{ $totalAmount }}</b></td>
		<td></td>
		<td></td>
	</tr>
</table>

<table>
	<tr>
		<td> <h4>Expence Details</h4> </td>
	</tr>
</table>

<table>
	<tr>
		<th>#</th>
		<th>User</th>
		<th>Date</th>
		<th>Amount</th>
	</tr>

	@php
        $totalAmount = 0;
    @endphp
	@foreach($expense as $key => $item)
        @php
            $totalAmount += $item->amount;
        @endphp
        <tr>
        	<td>{{ ++$key }}</td>
            <td>{{ $item->users->full_name }}</td>
            <td>{{ $item->date }}</td>
            <td>{{ $item->amount }}</td>
        </tr>
    @endforeach
    <tr>
		<td></td>
		<td></td>
		<td><b>Total Amount</b></td>
		<td><b>{{ $totalAmount }}</b></td>
	</tr>
</table>