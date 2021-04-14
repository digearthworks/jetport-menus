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
        Schema::connection(config('domains.auth.database_connection'))->create('menuables', function (Blueprint $table) {
            $table->integer('menu_id');
            $table->integer('menuable_id');
            $table->string('menuable_type');
            $table->string('menuable_group')->nullable();
            $table->string('checked')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::connection(config('domains.auth.database_connection'))->dropIfExists('menuables');
    }
}
