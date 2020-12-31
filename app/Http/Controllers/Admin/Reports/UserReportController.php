<?php

namespace App\Http\Controllers\Admin\Reports;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\Expense;
use App\Models\User;
use Illuminate\Http\Request;

use App\Traits\MonthTrait;
use App\Traits\SummaryTrait;

use PDF;

class UserReportController extends Controller
{
	use MonthTrait, SummaryTrait;
	/**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)  {
        $keyword = $request->get('search');
        
        $users = User::latest()->get();
        $months = $this->getMonths();

        $expense = $this->getExpence($keyword);
        $userExpenceSum = $this->getExpenceSummary($keyword);
        $userExpenceTotal = $this->getExpenceTotal($keyword);

        return view('admin.reports.users.index', compact('users','expense','months','keyword','userExpenceSum','userExpenceTotal'));
    }

    public function generateReportPDF(Request $request) {
    	$keyword = $request->get('search');
    	$data['period'] = $this->getDatePeriod($keyword);
    	$data['expense'] = $this->getExpence($keyword);
    	$data['userExpenceSum'] = $this->getExpenceSummary($keyword);
        $data['userExpenceTotal'] = $this->getExpenceTotal($keyword);
    	// return view('admin.reports.pdf.index',$data);
    	$pdf = PDF::loadView('admin.reports.pdf.index', $data);
		return $pdf->download('Expense_Report.pdf');
    }
}