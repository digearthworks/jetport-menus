@if (\App\Models\User::withTrashed()->where('id', $row->id)->first()->isAdmin())
    @lang('Administrator')
@elseif (\App\Models\User::withTrashed()->where('id', $row->id)->first()->isUser())
    @lang('User')
@else
    @lang('N/A')
@endif
