<div class="form-group row">
    <label for="permission_id" class="col-md-3 col-form-label text-md-right">@lang('Additional Restrictions')</label>

    <div class="col-md-9">
        <select id="permission_id" name="permission_id" class="form-control">
        @isset($model->permission)
            <option value="{{$model->permission->id}}">{{$model->permission->description}}</option>
        @endisset
            <option value="">None</option>

        @foreach($permissions as $permission)
            <option
                value="{{$permission->id}}"
            >
            {{$permission->description}}
            </option>
        @endforeach
        </select>
        <small id="permissionsHelp" class="form-text text-muted">If a value is selected, users must have all related permissions to view. Otherwise permissions are handled by menu group.</small>
    </div>
</div><!--form-group-->
