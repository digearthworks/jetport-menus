<div class="form-group row">
    <label for="title" class="col-md-3 col-form-label text-md-right">@lang('Description')</label>

    <div class="col-md-9">
        <input type="text" id="title" name="title" class="form-control" value="{{isset($model->title)?$model->title:''}}" />
    </div>
</div><!--form-group-->
