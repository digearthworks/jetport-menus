<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWebPagesTable extends Migration
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
        $this->schema->create('web_pages', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid');
            $table->string('slug')->unique();
            $table->string('title');
            $table->text('body');
            $table->text('meta')->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->unsignedBigInteger('deleted_by')->nullable();
        });
        $this->schema->create('web_tags', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid');
            $table->string('slug')->unique();
            $table->string('name');
            $table->string('color')->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->unsignedBigInteger('deleted_by')->nullable();
        });

        $this->schema->create('web_taggables', function (Blueprint $table) {
            $table->unsignedBigInteger('web_tag_id');
            $table->morphs('web_taggable');

            $table->foreign('web_tag_id')
                ->references('id')
                ->on('web_tags')
                ->onDelete('cascade');

            $table->primary(['web_tag_id', 'web_taggable_id'], 'web_taggable_web_tag_id_web_taggable_id_primary');
            $table->unique(['web_tag_id', 'web_taggable_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $this->schema->dropIfExists('web_taggables');
        $this->schema->dropIfExists('web_tags');
        $this->schema->dropIfExists('web_pages');
    }
}
