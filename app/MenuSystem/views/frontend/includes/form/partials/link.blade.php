<div x-show="menuType !='main_menu'">
<div
    class="form-group row"
>
    <label for="iframe" class="col-md-3 col-form-label text-md-right">@lang('iFrame')</label>
        <div class="col-md-9">
            <select id="iframe" name="iframe" class="form-control">
                @isset($model->iframe)
                    <option value="{{$model->iframe}}">{{$model->iframe === 1 ? 'Yes' : 'No'}}</option>
                @endisset
                <option value="0">No</option>
                <option value="1">Yes</option>
            </select>
        </div>
    </div><!--form-group-->

<div
    class="form-group row"
>
    <label for="link" class="col-md-3 col-form-label text-md-right">@lang('Url')</label>
    <div class="col-md-9">
        <input type="text" id="link" name="link" class="form-control" value="{{isset($model->link)?$model->link:''}}" />
    </div>
</div><!--form-group-->
</div>
