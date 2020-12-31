<?php
  
namespace App\Traits;
use App\Models\Expense;

trait SummaryTrait {

	public function getExpence($search){
		$perPage = 50;
        if (isset($search)) {
        	$expense = Expense::with('users');

        	if(isset($search['user_id']) && $search['user_id'] != '') {
            	$expense->where('user_id', $search['user_id']);

            }
            if(isset($search['from_date']) && $search['from_date'] != '' && $search['to_date'] && $search['to_date'] != '' ) {
				$fromDate = date('Y-m-d',strtotime($search['from_date']));
				$toDate = date('Y-m-d',strtotime($search['to_date']));

				$expense->where('date','>=',$fromDate)->where('date','<=',$toDate);
			}
            else if(isset($search['month']) && $search['month'] != '') {
            	$expense->whereMonth('date', $search['month']);
            }

            $expense = $expense->latest()->paginate($perPage);
        } else {
            
            $expense = Expense::with('users')->latest()->paginate($perPage);
        }
        return $expense;
	}

	public function getExpenceSummary($search) {
		$userExpenceSum = Expense::with('users')->select('user_id');

		$userExpenceSum->selectRaw('sum(expenses.amount) as user_sum');
		if(isset($search['user_id']) && $search['user_id'] != '') {
            	$userExpenceSum->where('user_id', $search['user_id']);
        }
        if(isset($search['from_date']) && $search['from_date'] != '' && $search['to_date'] && $search['to_date'] != '' ) {
			$fromDate = date('Y-m-d',strtotime($search['from_date']));
			$toDate = date('Y-m-d',strtotime($search['to_date']));

			$userExpenceSum->where('date','>=',$fromDate)->where('date','<=',$toDate);
		}
        else if(isset($search['month']) && $search['month'] != '') {
        	$userExpenceSum->whereMonth('date', $search['month']);
        }
		$userExpenceSum->groupBy('user_id');
		$userExpenceSum = $userExpenceSum->get();

   		return $userExpenceSum;
	}

	public function getExpenceTotal($search) {
		$userExpenceSum = Expense::with('users');

		if(isset($search['user_id']) && $search['user_id'] != '') {
            	$userExpenceSum->where('user_id', $search['user_id']);
        }
        if(isset($search['from_date']) && $search['from_date'] != '' && $search['to_date'] && $search['to_date'] != '' ) {
			$fromDate = date('Y-m-d',strtotime($search['from_date']));
			$toDate = date('Y-m-d',strtotime($search['to_date']));

			$userExpenceSum->where('date','>=',$fromDate)->where('date','<=',$toDate);
		}
        else if(isset($search['month']) && $search['month'] != '') {
        	$userExpenceSum->whereMonth('date', $search['month']);
        }
		$userExpenceTotal = $userExpenceSum->sum('amount');

   		return $userExpenceTotal;
	}

	public function getDatePeriod($search) {
		if(isset($search['from_date']) && $search['from_date'] != '' && $search['to_date'] && $search['to_date'] != '' ) {
			$period = date('d-F-Y',strtotime($search['from_date'])) .' - '. date('d-F-Y',strtotime($search['to_date']));
		}
        else if(isset($search['month']) && $search['month'] != '') {
			$period = date('F', mktime(0, 0, 0, $search['month'], 10)); // March
        } else {
        	$period = 'All';
        }
        return $period;
	}
}