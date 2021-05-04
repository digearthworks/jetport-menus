<form method="POST" action="{{isset($model) ? url('/menus/'.$model->id):'/menus'}}">

    @csrf @isset($model->id) @method('PATCH') @endisset

    <div x-data="{ menuType: '{{isset($model->type) ? $model->type : 'main_menu'}}' }">

    <div
    class="form-group row"
    >
        <label for="type" class="col-md-3 col-form-label text-md-right">@lang('Type')</label>

        <div class="col-md-9">
            <select
              x-on:change="menuType = $event.target.value"
              id="type"
              name="type"
              class="form-control"
            >
                @if(isset($model->type))
                    <option value="{{$model->type}}">
                        @switch($model->type)
                            @case('internal_link')
                                Direct Local Link
                                @break
                            @case('external_link')
                                Direct External Link
                            @break

                            @case('main_menu')
                                Full Menu
                            @break

                            @default
                        @endswitch
                    </option>
                @endif
                <option value="main_menu">Full Menu</option>
                <option value="internal_link">Direct Local Link</option>
                <option value="external_link">Direct External Link</option>
            </select>
        </div>
    </div><!--form-group-->
        @include('frontend.menus.includes.form.partials.link', ['model' => $model??null])
</div>
    @include('frontend.menus.includes.form.partials.active', ['model' => $model??null])

    @include('frontend.menus.includes.form.partials.sort', ['model' => $model??null])

    @include('frontend.menus.includes.form.partials.label', ['model' => $model??null])

    @include('frontend.menus.includes.form.partials.title', ['model' => $model??null])

    <input type="hidden" id="office" name="group" value="office"/>
    {{-- <input type="hidden" id="office" name="type" value="main_menu"/> --}}

    @can('admin.access.sidebar.admin')
    <div class="form-group row">
        <label for="group" class="col-md-3 col-form-label text-md-right">@lang('Group')</label>

        <div class="col-md-9">
            <select id="group" name="group" class="form-control">
                @if(isset($model->group))
                <option value="{{$model->group}}">
                    @switch($model->group)
                        @case('office')
                            office (cloud)
                            @break
                        @case('admin')
                            admin (settings)
                        @break

                        @default
                    @endswitch
                </option>
            @endif
                <option value="office">office (cloud)</option>
                <option value="admin">admin (settings)</option>
            </select>
        </div>
    </div><!--form-group-->

        @include('frontend.menus.includes.form.partials.permissions', ['model' => $model??null])
    @endcan

    @include('frontend.menus.includes.form.partials.icon-picker', ['model' => $model??null])

    @include('frontend.menus.includes.form.partials.save-button')

</form>
