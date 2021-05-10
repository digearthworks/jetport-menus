@if ($general->count() + $categories->count() === 0)
    <i class="fa fa-info-circle"></i> @lang('There are no permissions to choose from.')
@endif
