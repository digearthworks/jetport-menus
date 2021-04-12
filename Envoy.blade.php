
@servers(['localhost' => '127.0.0.1'])

@task('dev', ['on'=> 'localhost'])
    php artisan key:generate
    npm install && npm run dev
    php artisan storage:link
    php artisan passport:keys
    php artisan migrate:refresh --seed
    {{isset($test) ? 'php artisan test' : ''}}
@endtask

@task('update', ['on'=> 'localhost'])
    git fetch --all
    git pull {{isset($remote) ? $remote : ''}} {{isset($branch) ? $branch : ''}}
    composer update
@endtask

