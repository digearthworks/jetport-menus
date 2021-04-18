<div class="form-group row">
    <label for="active" class="col-md-3 col-form-label text-md-right">@lang('Active')</label>

    <div class="col-md-9">
        <select id="active" name="active" class="form-control">
            @isset($model->active)
            <option value="{{$model->active}}">{{$model->active === 1 ? 'Yes' : 'No'}}</option>
        @endisset
            <option value="1">Yes</option>
            <option value="0">No</option>
        </select>
    </div>
</div><!--form-group-->
