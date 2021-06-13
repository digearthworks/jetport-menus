<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMenusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection(config('template.auth.database_connection'))->create('menus', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->uuid('uuid')->nullable()->unique();
            $table->string('group')->nullable();
            $table->string('name');
            $table->string('handle');
            $table->string('link')->nullable();
            $table->string('type')->nullable();
            $table->boolean('active')->nullable();
            $table->text('title')->nullable();
            $table->integer('iframe')->nullable();
            $table->integer('sort')->nullable();
            $table->integer('row')->nullable();
            $table->unsignedBigInteger('menu_id')->nullable();
            $table->unsignedBigInteger('site_page_id')->nullable();
            $table->integer('icon_id')->nullable();
            $table->integer('created_by')->nullable();
            $table->integer('updated_by')->nullable();
            $table->integer('deleted_by')->nullable();
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('menu_id')
            ->references('id')
            ->on('menus')
            ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::connection(config('template.auth.database_connection'))->dropIfExists('menus');
    }
}
