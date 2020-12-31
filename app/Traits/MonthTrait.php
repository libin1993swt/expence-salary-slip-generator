<?php
  
namespace App\Traits;
  
use Illuminate\Http\Request;
  
trait MonthTrait {
	public function getMonths() {
		$months = array( 'January', 'February', 'March', 'April', 'May', 'June', 'July ', 'August', 'September','October', 'November','December',);
		return $months;
	}
}