<?php

use App\Turbine\Menus\Enums\MenuItemTargetEnum;
use App\Turbine\Menus\Enums\MenuItemTemplateEnum;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * The database schema.
     *
     * @var \Illuminate\Database\Schema\Builder
     */
    protected $schema;

    /**
     * Create a new migration instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->schema = Schema::connection($this->getConnection());
    }

    /**
     * Get the migration connection name.
     *
     * @return string|null
     */
    public function getConnection()
    {
        return config('core.auth.connection');
    }

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $this->schema->create('menu_items', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid');
            $table->string('type')->default('App\\\App\Turbine\\Menus\\\MenuItem');
            $table->string('template')->default(MenuItemTemplateEnum::default());
            $table->string('route')->nullable()->default(null);
            $table->string('uri')->nullable();
            $table->string('target')->default(MenuItemTargetEnum::self());
            $table->string('name');
            $table->string('slug');
            $table->string('handle')->unique('menu_items_handle')->nullable();
            $table->boolean('active')->nullable();
            $table->text('title')->nullable();
            $table->integer('sort')->nullable();
            $table->unsignedBigInteger('menu_id')->nullable();
            $table->unsignedBigInteger('page_id')->nullable();
            $table->unsignedBigInteger('parent_id')->nullable();
            $table->unsignedBigInteger('icon_id')->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->unsignedBigInteger('deleted_by')->nullable();

            $table->index('type', 'menu_item_type');

            // $table->foreign('menu_id')
            // ->references('id')
            // ->on('menus')
            // ->onDelete('no action');

            // $table->foreign('parent_id')
            // ->references('id')
            // ->on('menu_items')
            // ->onDelete('no action');

            // $table->foreign('icon_id')
            // ->references('id')
            // ->on('icons')
            // ->onDelete('no action');

            // $table->foreign('page_id')
            // ->references('id')
            // ->on('pages')
            // ->onDelete('no action');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $this->schema->dropIfExists('menu_items');
    }
};
