<div class="row">
    <div class="form-group col-md-6 {{ $errors->has('name') ? 'has-error' : ''}}">
        <label for="name" class="control-label">{{ 'Name' }}</label>
        <input class="form-control" name="name" type="text" id="name" value="{{ isset($employee->name) ? $employee->name : ''}}" >
        {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
    </div>
    <div class="form-group col-md-6 {{ $errors->has('designation') ? 'has-error' : ''}}">
        <label for="designation" class="control-label">{{ 'Designation' }}</label>
        <input class="form-control" name="designation" type="text" id="designation" value="{{ isset($employee->designation) ? $employee->designation : ''}}" >
        {!! $errors->first('designation', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="row">
    <div class="form-group col-md-4 {{ $errors->has('join_date') ? 'has-error' : ''}}">
        <label for="join_date" class="control-label">{{ 'Join Date' }}</label>
        <input class="form-control" name="join_date" type="date" id="join_date" value="{{ isset($employee->join_date) ? $employee->join_date : ''}}" >
        {!! $errors->first('join_date', '<p class="help-block">:message</p>') !!}
    </div>
    <div class="form-group col-md-4 {{ $errors->has('pf_account_number') ? 'has-error' : ''}}">
        <label for="pf_account_number" class="control-label">{{ 'PF Account Number' }}</label>
        <input class="form-control" name="pf_account_number" type="text" id="pf_account_number" value="{{ isset($employee->pf_account_number) ? $employee->designation : ''}}" >
        {!! $errors->first('pf_account_number', '<p class="help-block">:message</p>') !!}
    </div>
    <div class="form-group col-md-4 {{ $errors->has('uan_number') ? 'has-error' : ''}}">
        <label for="uan_number" class="control-label">{{ 'UAN Number' }}</label>
        <input class="form-control" name="uan_number" type="text" id="uan_number" value="{{ isset($employee->uan_number) ? $employee->uan_number : ''}}" >
        {!! $errors->first('pf_account_number', '<p class="help-block">:message</p>') !!}
    </div>
</div>




<div class="form-group">
    <input class="btn btn-primary" type="submit" value="{{ $formMode === 'edit' ? 'Update' : 'Create' }}">
</div>