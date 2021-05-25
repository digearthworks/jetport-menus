<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMenuablesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection(config('template.auth.database_connection'))->create('menuables', function (Blueprint $table) {
            $table->unsignedBigInteger('menu_id');
            $table->integer('menuable_id');
            $table->string('menuable_type');
            $table->string('menuable_group')->nullable();
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
        Schema::connection(config('template.auth.database_connection'))->dropIfExists('menuables');
    }
}
