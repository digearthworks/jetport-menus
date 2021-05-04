<div class="form-group row">
    <label for="icon" class="col-md-3 col-form-label text-md-right">@lang('Icon')</label>
    <div class="form-group col-12">
        <div
            name="icon"
            data-icon="{{isset($model->icon)?$model->icon->title:''}}"
            id="icon"
            role="iconpicker"
            data-cols="{{config('ui.icon_picker_columns','4')}}"
            data-rows="{{config('ui.icon_picker_rows','4')}}"
            data-align="center"
        >
        </div>
    </div>
</div>
