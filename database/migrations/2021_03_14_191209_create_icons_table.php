<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIconsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection(config('template.auth.database_connection'))->create('icons', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->nullable()->unique();
            $table->integer('favorite')->nullable();
            $table->string('source')->nullable();
            $table->string('class')->nullable();
            $table->string('version')->nullable();
            $table->text('svg')->nullable();
            $table->string('unicode')->nullable();
            $table->string('mime_type')->nullable();
            $table->string('encoding')->nullable();
            $table->string('url')->nullable();
            $table->integer('weight')->nullable();
            $table->integer('created_by')->nullable();
            $table->integer('updated_by')->nullable();
            $table->integer('deleted_by')->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->unique(['source','class','version'], 'source_class_version');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::connection(config('template.auth.database_connection'))->dropIfExists('icons');
    }
}
