@if (\App\Models\User::query()->where('id', $row->id)->first()->two_factor_secret)
    <x-success-badge value="{{ __('Yes') }}" />
@else
    <x-danger-badge value="{{ __('No') }}" />
@endif
