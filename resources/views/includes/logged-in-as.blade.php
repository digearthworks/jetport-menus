@impersonating
<div>
    <div class="bg-yellow-100 border-t-4 border-yellow-500 text-yellow-700">
        <p class="font-bold">@lang('You are currently logged in as :name.', ['name' => $logged_in_user->name]) <a class="underline" href="{{ route('impersonate.leave') }}">@lang('Return to your account')</a>.</p>
    </div><!--alert alert-warning-->
</div>
    @endImpersonating
