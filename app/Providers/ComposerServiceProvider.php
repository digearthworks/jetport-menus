<?php

namespace App\Providers;

use App\Auth\Models\Permission;
use App\Auth\Models\Role;
use App\Menus\Models\Menu;
use App\Pages\Models\Page;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Laravel\Jetstream\Jetstream;
use League\CommonMark\CommonMarkConverter;
use League\CommonMark\Environment;
use League\CommonMark\Extension\GithubFlavoredMarkdownExtension;

class ComposerServiceProvider extends ServiceProvider
{

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer('*', function ($view) {
            $app_logo = config('ui.logo');

            if (app()->environment(['testing', 'local'])) {
                $app_logo = '/stock-img/' . Storage::disk('stock-img')->files()[rand(0, (count(Storage::disk('stock-img')->files()) - 1))];
            }

            $view->with([
                'app_logo' => $app_logo,
                'logged_in_user' => Auth::user()
            ]);
        });

        View::composer([
            'admin.users.edit',
            'admin.users.create',
            'admin.menus.edit',
            'admin.menus.create',
            'admin.roles.edit',
            'admin.roles.create',
        ], function ($view) {
            $view->with([
                'menus' => Menu::query()->where('menu_id', null)->with('children')->get(),
                'roles' => Role::with('permissions')->get(),
            ]);
        });

        View::composer([
            'layouts.guest',
            'welcome',
        ], function ($view) {

            $view->with([
                'welcomePage' => Page::welcomePages()->first(),
            ]);

            $welcomeFile = Jetstream::localizedMarkdownPath('welcome.md');

            $environment = Environment::createCommonMarkEnvironment();
            $environment->addExtension(new GithubFlavoredMarkdownExtension());

            $view->with([
                'welcome' => (new CommonMarkConverter([], $environment))->convertToHtml(file_get_contents($welcomeFile)),
            ]);
        });

        View::composer(['guest.includes.*',], function ($view) {
            $view->with([
                'guestLinks' => Menu::where('handle', 'guest_links')->first()->children()->onlyActive()->get()
            ]);
        });

        View::composer([
            'admin.roles.edit',
            'admin.roles.create',
            'admin.users.edit',
            'admin.users.create',
            'admin.menus.create',
            'admin.menus.edit'
        ], function ($view) {
            $view->with([
                'permissions' => Permission::query()->with('children')->get(),
                'generalPermissions' => Permission::query()->doesntHave('parent')->doesntHave('children')->get(),
                'permissionCategories' => Permission::query()->whereHas('children')->with('children')->get(),
            ]);
        });
    }
}
