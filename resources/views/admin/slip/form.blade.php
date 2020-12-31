<div class="row">
    <div class="form-group col-md-6 {{ $errors->has('company_id') ? 'has-error' : ''}}">
        <label for="company_id" class="control-label">{{ 'Company' }}</label>
        <select class="form-control" name="company_id" id="company_id" required="">
            <option value="">Select Company</option>
            @foreach($companies as $company)
                <option value="{{ $company->id }}">{{ $company->name }}</option>
            @endforeach
        </select>
        {!! $errors->first('company_id', '<p class="help-block">:message</p>') !!}
    </div>
    <div class="form-group col-md-3 {{ $errors->has('employee_id') ? 'has-error' : ''}}">
        <label for="employee_id" class="control-label">{{ 'Employee' }}</label>
        <select class="form-control" name="employee_id" id="employee_id" required="">
            <option value="">Select Employee</option>
            @foreach($employees as $employee)
                <option value="{{ $employee->id }}">{{ $employee->name }}</option>
            @endforeach
        </select>
        {!! $errors->first('employee_id', '<p class="help-block">:message</p>') !!}
    </div>
    <div class="form-group col-md-3 {{ $errors->has('pay_period') ? 'has-error' : ''}}">
        <label for="pay_period" class="control-label">{{ 'Pay Period' }}</label>
        <select class="form-control" name="pay_period" id="pay_period" required="">
            <option value="">Select Period</option>
            @foreach($months as $month)
                <option value="{{ $month.' '.date('Y') }}">{{ $month.' '.date('Y') }}</option>
            @endforeach
        </select>
        {!! $errors->first('pay_period', '<p class="help-block">:message</p>') !!}
    </div>
</div>


<div class="form-group">
    <input class="btn btn-primary" type="submit" value="{{ $formMode === 'edit' ? 'Update' : 'Create' }}">
</div>