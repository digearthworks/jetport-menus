@if (\App\Models\User::query()->where('id', $row->id)->first()->isAdmin())
    @lang('Administrator')
@elseif (\App\Models\User::query()->where('id', $row->id)->first()->isUser())
    @lang('User')
@else
    @lang('N/A')
@endif
