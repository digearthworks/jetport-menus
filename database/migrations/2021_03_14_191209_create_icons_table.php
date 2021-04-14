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
        Schema::connection(config('domains.auth.database_connection'))->create('icons', function (Blueprint $table) {
            $table->id();
            $table->integer('favorite')->nullable();
			$table->string('source')->nullable();
			$table->string('title');
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
			$table->unique(['source','title'], 'source_title');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::connection(config('domains.auth.database_connection'))->dropIfExists('icons');
    }
}
