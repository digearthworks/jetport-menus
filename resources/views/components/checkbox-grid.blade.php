@if ($models->count())
    <div class="grid grid-cols-1 md:grid-cols-2">
        @foreach ($models as $model)
            <div
                class="border-transparent p-1 m-0.5 rounded-md border hover:border-blue-300 hover:shadow-outline-blue">
                <label class="flex items-center">
                    <x-jet-checkbox  wire:model="{{ $formElement ?? '' }}" :value="$model->getkey()" />
                    <span class="ml-1 text-sm text-gray-600">{!! $model->$label !!}</span>
                </label>
                @isset($relation)
                    @if (
                            $model->$relation->count() &&
                            $model->$relation->count() > 20 &&
                            $model->$relation->count() === ($model->$relation()->first())->query()->count()
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
                @endisset
            </div>
        @endforeach
    </div>
@endif
