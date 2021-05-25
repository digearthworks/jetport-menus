<div class="col-span-6 sm:col-span-4">
    @isset($header)
        <div class="col-span-6 sm:col-span-4">
            <x-jet-label class="underline" for="recursiveCheckboxes" value="{{  __(':header', [ 'header' => $header ]) }}" />
        </div>
    @endisset

    <div class="border border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">

        @if(isset($relation))
        <x-checkbox-grid
            :formIndex="$formIndex ?? ''"
            :label="$label ?? ''"
            :childrenLabel="$childrenLabel ?? ''"
            :relation="$relation"
            :form="$form ?? []"
            :formElement="$formElement ?? ''"
            :models="$categories ?? []"
            :disableChildren="$disableChildren ?? false"
        />
        @elseif(isset($relations))
        <x-checkbox-grid
            :formIndex="$formIndex ?? ''"
            :label="$label ?? ''"
            :childrenLabels="$childrenLabels ?? []"
            :relations="$relations"
            :form="$form ?? []"
            :formElement="$formElement ?? ''"
            :models="$categories ?? []"
            :disableChildren="$disableChildren ?? false"
        />
        @endif

        @if( isset($general) && $general->count())
            <div class="col-span-6 sm:col-span-4">
                <x-jet-label class="underline" for="recursiveCheckboxes" value="{{ __('Miscellaneous') }}" />
            </div>

            <x-checkbox-grid
                :formIndex="$formIndex ?? ''"
                :label="$label ?? ''"
                :childrenLabel="$childrenLabel ?? ''"
                :relation="$relation"
                :form="$form ?? []"
                :formElement="$formElement ?? ''"
                :models="$general ?? []"
            />
        @endif
    </div>
</div>

