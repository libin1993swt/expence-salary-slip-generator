<div class="row">
    <div class="form-group col-md-9 {{ $errors->has('name') ? 'has-error' : ''}}">
        <label for="name" class="control-label">{{ 'Name' }}</label>
        <input class="form-control" name="name" type="text" id="name" value="{{ isset($employee->name) ? $employee->name : ''}}" >
        {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
    </div>
    <div class="form-group col-md-3 {{ $errors->has('type') ? 'has-error' : ''}}">
        <label for="type" class="control-label">{{ 'Type' }}</label>
        <select class="form-control" name="type" id="type">
            <option value="">Select Type</option>
            <option value="E">Earnings</option>
            <option value="D">Deductions</option>
        </select>
        {!! $errors->first('type', '<p class="help-block">:message</p>') !!}
    </div>
</div>


<div class="form-group">
    <input class="btn btn-primary" type="submit" value="{{ $formMode === 'edit' ? 'Update' : 'Create' }}">
</div>