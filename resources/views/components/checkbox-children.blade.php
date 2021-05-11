<li class="ml-4 list-none">
    @forelse($parent->$relation as $child)
        <ul>

            <label class="flex items-center">
                @if( $disableChildren ||
                    isset($form[$formIndex]) && in_array((string) $parent->getKey(), $form[$formIndex])
                    )
                    <x-checked-item>
                        {!! $child->$label ?? '' !!}
                    </x-checked-item>
                @else
                    <x-jet-checkbox wire:model="{{ $formElement ?? '' }}" :value="$child->getKey()" />
                    <span class="ml-1 text-sm text-gray-600">{!! $child->$label ?? '' !!}</span>
                @endif
            </label>

                @if($child->$relation->count())
                    <x-checkbox-children
                        :formElement="$formElement ?? '' "
                        :formIndex="$formIndex ?? ''"
                        :label="$label"
                        :childrenLabel="$childrenLabel"
                        :parent="$child"
                        :relation="$relation"
                        :form="$form ?? []"
                        disableChildren="$disableChildren ?? false"
                    />
                @endif
        </ul>
    @empty
        <x-empty>
            {{__('No Items')}}
        </x-empty>
    @endforelse
</li>
