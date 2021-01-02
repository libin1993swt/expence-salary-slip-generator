<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\SlipItem;
use App\Models\SlipRecords;
use App\Models\Company;
use App\Models\Employee;
use Illuminate\Http\Request;

use App\Traits\MonthTrait;
use PDF;

class SlipController extends Controller
{
    use MonthTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $items = SlipItem::latest()->get();
        // dd($items);
        return view('admin.slip.index', compact('items'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $companies = Company::orderBy('name')->get();
        $employees = Employee::orderBy('name')->get();
        $months = $this->getMonths();
        
        return view('admin.slip.create',compact('companies','employees','months'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        
        $requestData = $request->all();

        if($request->has('company_id')){
            $company = Company::findOrFail($request->company_id);
        }
        if($request->has('employee_id')){
            $employee = Employee::findOrFail($request->employee_id);
        }
        if($request->has('pay_period')){
            $pay_period = $request->pay_period;
        }      
        
        $earnings = SlipItem::where('type','E')->orderBy('name')->get();
        $deductions = SlipItem::where('type','D')->orderBy('name')->get();
        return view('admin.slip.preview',compact('company','employee','pay_period','earnings','deductions'));
        // SlipItem::create($requestData);

        // return redirect('admin/slip/items')->with('flash_message', 'SlipItem added!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $SlipItem = SlipItem::findOrFail($id);

        return view('admin.SlipItem.show', compact('SlipItem'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $group = SlipItem::findOrFail($id);

        return view('admin.groups.edit', compact('group'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Request $request, $id)
    {
        
        $requestData = $request->all();
        
        $group = SlipItem::findOrFail($id);
        $group->update($requestData);

        return redirect('admin/groups')->with('flash_message', 'Group updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        SlipItem::destroy($id);

        return redirect('admin/groups')->with('flash_message', 'Group deleted!');
    }

    /**
    * Generate Pdf
    */
    public function generatePdf(Request $request) {
        $requestData = $request->all();
        $requestData['earning'] = json_encode($request->earnings);
        $requestData['deduction'] = json_encode($request->deductions);
        $requestData['date'] = date('Y-m-d');
        
        SlipRecords::create($requestData);
        $data['pay_period'] = $request->pay_period;
        $data['company'] = Company::findOrFail($request->company_id);
        $data['employee'] = Employee::findOrFail($request->user_id);
        
        $data['earnings'] = $request->earnings;
        $data['deductions'] = $request->deductions;
        // return view('admin.slip.pdf',$data);
        $pdf = PDF::loadView('admin.slip.pdf', $data);
        return $pdf->download('SalarySlip.pdf');
    }
}
