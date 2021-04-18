<form method="POST" action="{{isset($model) ? url('/menus/'.$model->id):'/menus'}}">

    @csrf @isset($model->id) @method('PATCH') @endisset

    @include('frontend.menus.includes.form.partials.active')
    <div class="form-group row">
        <label for="menu_id" class="col-md-3 col-form-label text-md-right">@lang('Menu')</label>
        <div class="col-md-9">
            <select
                required
                id="parent"
                name="menu_id"
                class="form-control"
            >
                @if(isset($menu->parent->id) || isset($parentMenu->id ) || isset($model->parent->id) || isset($parent->id ))
                    <option
                        value="{{$menu->parent->id??($parentMenu->id ?? $model->parent->id ?? $parent->id)}}"
                    >
                        {{$menu->parent->label??$parentMenu->label??($parentMenu->label ?? $model->parent->label ?? $parent->label)}}
                    </option>
                @endif

                @foreach($parents as $parent)
                    <option
                        value="{{$parent->id}}"
                    >
                    {{$parent->label}}
                </option>
                @endforeach
            </select>
        </div>
    </div><!--form-group-->

    <div x-data="{ menuType: 'internal_link' }">
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
                        Local Link
                        @break
                    @case('external_link')
                        External Link
                    @break

                    @case('main_menu')
                        Hotlink to menu page
                    @break

                    @default
                @endswitch
            </option>
        @endif
            <option value="internal_link">Local Link</option>
            <option value="external_link">External Link</option>
            <option value="main_menu">Hotlink to menu page</option>
            </select>
        </div>
    </div><!--form-group-->

    <div class="form-group row">
        <label for="group" class="col-md-3 col-form-label text-md-right">@lang('Group')</label>

        <div class="col-md-9">
            <select id="group" name="group" class="form-control">
                @if(isset($model->group))
                    <option value="{{$model->group}}">
                        @switch($model->group)
                            @case('hotlinks')
                                Navbar
                                @break
                            @case('main')
                                Menu Page
                            @break
                            @default
                        @endswitch
                    </option>
                @endif
                <option value="hotlinks">Navbar</option>
                <option value="main">Menu Page</option>
            </select>
        </div>
    </div><!--form-group-->

    @include('frontend.menus.includes.form.partials.row', ['model' => $model??null])

    @include('frontend.menus.includes.form.partials.link', ['model' => $model??null])
    </div>
    @include('frontend.menus.includes.form.partials.label', ['model' => $model??null] )

    @include('frontend.menus.includes.form.partials.title', ['model' => $model??null])

    @include('frontend.menus.includes.form.partials.permissions', ['model' => $model??null])

    @include('frontend.menus.includes.form.partials.icon-picker', ['model' => $model??null])

    @include('frontend.menus.includes.form.partials.save-button', ['model' => $model??null])
</form>
