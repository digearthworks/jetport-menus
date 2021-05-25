<?php

use App\Models\Icon;
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
            $table->string('meta')->nullable();
            $table->string('source')->nullable();
            $table->string('class')->nullable();
            $table->string('version')->nullable();
            $table->text('html')->nullable();
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
        //Create Default Icon
        Icon::Create([
            'id' => 1,
            'html' => '<svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>',
            'source' => 'raw',
        ]);
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
