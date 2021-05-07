@impersonating
<div class="px-4 py-4 mx-auto max-w-7xl sm:px-6 lg:px-8">
    <div class="text-red-700 border-l-4 border-red-700 ">
        <p class="ml-1">@lang('You are currently logged in as :name.', ['name' => $logged_in_user->name]) <a class="underline" href="{{ route('impersonate.leave') }}">@lang('Return to your account')</a>.</p>
    </div><!--alert alert-warning-->
</div>
    @endImpersonating
