<div class="form-group row">
    <label for="row" class="col-md-3 col-form-label text-md-right">@lang('Row')</label>

    <div class="col-md-9">
        <select id="row" name="row" class="form-control">
            @isset($model->row)
            <option value="{{$model->row}}">{{$model->row}}</option>
        @endisset
            <option></option>
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
            <option value="4">4</option>
        </select>
    </div>
</div><!--form-group-->
