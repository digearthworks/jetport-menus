<div class="form-group row">
    <label for="sort" class="col-md-3 col-form-label text-md-right">@lang('Sort')</label>

    <div class="col-md-9">
        <input type="number" id="sort" name="sort" class="form-control" value="{{isset($model->sort)?$model->sort:''}}" />
    </div>
</div><!--form-group-->
