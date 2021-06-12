<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSitePagesTable extends Migration
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
        return config('database.default');
    }

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $this->schema->create('site_tags', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid');
            $table->boolean('active')->nullable();
            $table->string('slug')->unique();
            $table->string('name');
            $table->string('color')->nullable();
            $table->string('layout')->nullable();
            $table->integer('sort')->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->unsignedBigInteger('deleted_by')->nullable();
        });

        $this->schema->create('site_pages', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid');
            $table->boolean('active')->nullable();
            $table->string('slug')->unique();
            $table->string('title');
            $table->text('body');
            $table->string('layout')->nullable();
            $table->integer('sort')->nullable();
            $table->text('meta')->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->unsignedBigInteger('deleted_by')->nullable();
            $table->unsignedBigInteger('site_tag_id')->nullable();

            $table->foreign('site_tag_id')
            ->references('id')
            ->on('site_tags')
            ->onDelete('cascade');
        });

        $this->schema->create('site_taggables', function (Blueprint $table) {
            $table->unsignedBigInteger('site_tag_id');
            $table->morphs('site_taggable');

            $table->foreign('site_tag_id')
                ->references('id')
                ->on('site_tags')
                ->onDelete('cascade');

            $table->primary(['site_tag_id', 'site_taggable_id'], 'site_taggable_site_tag_id_site_taggable_id_primary');
            $table->unique(['site_tag_id', 'site_taggable_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $this->schema->dropIfExists('site_taggables');
        $this->schema->dropIfExists('site_tags');
        $this->schema->dropIfExists('site_pages');
    }
}
