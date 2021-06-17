<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePagesTable extends Migration
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
        $this->schema->create('tags', function (Blueprint $table) {
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

        $this->schema->create('pages', function (Blueprint $table) {
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
            $table->unsignedBigInteger('tag_id')->nullable();

            $table->foreign('tag_id')
            ->references('id')
            ->on('tags')
            ->onDelete('cascade');
        });

        $this->schema->create('taggables', function (Blueprint $table) {
            $table->unsignedBigInteger('tag_id');
            $table->morphs('taggable');

            $table->foreign('tag_id')
                ->references('id')
                ->on('tags')
                ->onDelete('cascade');

            $table->primary(['tag_id', 'taggable_id'], 'taggable_tag_id_taggable_id_primary');
            $table->unique(['tag_id', 'taggable_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $this->schema->dropIfExists('taggables');
        $this->schema->dropIfExists('tags');
        $this->schema->dropIfExists('pages');
    }
}
