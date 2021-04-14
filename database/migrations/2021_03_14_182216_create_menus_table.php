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
        Schema::connection(config('domains.auth.database_connection'))->create('menus', function (Blueprint $table) {
            $table->id();
            $table->string('group')->nullable();
			$table->string('label');
			$table->string('link')->nullable();
			$table->string('type')->nullable();
			$table->integer('active')->nullable();
			$table->text('title')->nullable();
			$table->integer('iframe')->nullable();
			$table->integer('sort')->nullable();
			$table->integer('row')->nullable();
			$table->integer('menu_id')->nullable();
			$table->bigInteger('permission_id')->nullable();
			$table->integer('icon_id')->nullable();
			$table->integer('created_by')->nullable();
			$table->integer('updated_by')->nullable();
			$table->integer('deleted_by')->nullable();
			$table->softDeletes();
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
        Schema::connection(config('domains.auth.database_connection'))->dropIfExists('menus');
    }
}
