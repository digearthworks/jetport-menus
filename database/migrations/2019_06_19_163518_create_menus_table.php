<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Turbine\Menus\Enums\MenuTemplateEnum;
use Turbine\Menus\Enums\MenuTypeEnum;

class CreateMenusTable extends Migration
{

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
        $this->schema->create('menus', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid');
            $table->bigInteger('sort')->nullable();
            $table->text('title')->nullable();
            $table->string('name');
            $table->string('handle')->unique('menus_handle');
            $table->string('type')->default(MenuTypeEnum::user());
            $table->string('template')->default(MenuTemplateEnum::default());
            $table->boolean('active')->default(true);
            $table->timestamps();
            $table->softDeletes();
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->unsignedBigInteger('deleted_by')->nullable();
            $table->integer('icon_id')->nullable();

            // $table->foreign('icon_id')
            // ->references('id')
            // ->on('icons')
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
        $this->schema->dropIfExists('menus');
    }
}
