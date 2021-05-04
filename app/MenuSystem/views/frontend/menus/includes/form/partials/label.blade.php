<div class="form-group row">
    <label for="label" class="col-md-3 col-form-label text-md-right">@lang('Label')</label>

    <div class="col-md-9">
        <input type="text" id="label" required name="label" class="form-control" value="{{isset($model->label)?$model->label:''}}" />
    </div>
</div><!--form-group-->
