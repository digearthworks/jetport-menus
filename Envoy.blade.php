
@servers(['localhost' => '127.0.0.1'])

@setup
    define('LARAVEL_START', microtime(true));

    $app = require_once __DIR__.'/bootstrap/app.php';

    $kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);

    $kernel->bootstrap();
@endsetup

@task('dev', ['on'=> 'localhost'])
    php artisan key:generate
    yarn && yarn run dev
    php artisan storage:link
    php artisan passport:keys
    php artisan db:wipe
    @if((config('template.cms.cms') && config('template.cms.driver') === 'wink'))
        php artisan wink:install
        php artisan wink:migrate
    @endif
    php artisan migrate --seed
    {{ isset($test) ? 'php artisan test' : '' }}
@endtask

@task('update', ['on'=> 'localhost'])
    git fetch --all
    git pull {{ isset($remote) ? $remote : ''}} {{isset($branch) ? $branch : '' }}
    composer update
@endtask
