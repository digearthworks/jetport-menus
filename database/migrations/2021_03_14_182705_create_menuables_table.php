<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection(config('core.auth.connection'))->create('menuables', function (Blueprint $table) {
            $table->unsignedBigInteger('menu_item_id');
            $table->integer('menuable_id');
            $table->string('menuable_type');
            $table->string('menuable_group')->nullable();
            $table->timestamps();

            // $table->foreign('menu_item_id')
            // ->references('id')
            // ->on('menu_items')
            // ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::connection(config('core.auth.connection'))->dropIfExists('menuables');
    }
};
