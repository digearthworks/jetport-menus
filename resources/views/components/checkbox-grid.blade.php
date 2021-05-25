@if ($models->count())
    <div class="grid grid-cols-1 md:grid-cols-2">
        @foreach ($models as $model)
            <div
                class="border-transparent p-1 m-0.5 rounded-md border hover:border-blue-300 hover:shadow-outline-blue">
                <label class="flex items-center">
                    <x-jet-checkbox  wire:model="{{ $formElement ?? '' }}" :value="$model->getkey()" />
                    <div class="flex items-center ml-1 text-sm text-gray-600">{!! $model->$label !!}</div>
                </label>
                @if(isset($relation))
                    @if (
                            $model->$relation->count() &&
                            $model->$relation->count() > 20 &&
                            $model->$relation->count() === ($model->$relation()->first())->query()->count() ||
                            $model->table === 'roles' && $relation === 'children' && $model->isAdmin()
                        )
                        <li class="ml-4 list-none">
                            <label class="flex items-center">
                                <x-checked-item>
                                    {{ __('All Items') }}
                                </x-checked-item>
                            </label>
                        </li>
                    @elseif($model->$relation->count())
                        <x-checkbox-children
                            :formElement="$formElement ?? '' "
                            :formIndex="$formIndex ?? ''"
                            :parent="$model"
                            :relation="$relation"
                            :label="$childrenLabel"
                            :childrenLabel="$childrenLabel"
                            :form="$form ?? []"
                            :disableChildren="$disableChildren ?? false"
                        />
                    @else
                        <x-empty>
                            {{__('No Items')}}
                        </x-empty>
                    @endif
                @elseif(
                            isset($relations) &&
                            is_array($relations) &&
                            isset($childrenLabels) &&
                            is_array($childrenLabels) &&
                            count($childrenLabels) === count($relations)
                    )
                    @foreach($relations as $relationship)
                        @isset($relationship)
                        <x-jet-label class="ml-2" for="recursiveCheckboxes" value="{{  __(':relationship', [ 'relationship' => ucfirst($relationship) ]) }}" />
                            @if (
                                    $model->$relationship->count() &&
                                    $model->$relationship->count() > 20 &&
                                    $model->$relationship->count() === ($model->$relationship()->first())->query()->count() ||
                                    $relationship == 'permissions' && method_exists ( $model, 'isAdmin' ) && $model->isAdmin()
                                )
                                <li class="ml-4 list-none">
                                    <label class="flex items-center">
                                        <x-checked-item>
                                            {{ __('All Items') }}
                                        </x-checked-item>
                                    </label>
                                </li>
                            @elseif($model->$relationship->count())
                                <x-checkbox-children
                                    :formElement="$formElement ?? '' "
                                    :formIndex="$formIndex ?? ''"
                                    :parent="$model"
                                    :relation="$relationship"
                                    :label="$childrenLabels[$relationship]"
                                    :childrenLabel="$childrenLabels[$relationship]"
                                    :form="$form ?? []"
                                    :disableChildren="$disableChildren ?? false"
                                />
                            @else
                                <x-empty>
                                    {{__('No Items')}}
                                </x-empty>
                            @endif
                        @endisset
                    @endforeach
                @endif
            </div>
        @endforeach
    </div>
@endif
