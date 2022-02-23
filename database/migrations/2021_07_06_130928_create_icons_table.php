<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
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
        return config('buku-icons.db_connection');
    }

    public function up()
    {
        $this->schema->create('icons', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('icon_set_id')->nullable();
            $table->string('name');
            $table->text('keywords')->nullable();
            $table->boolean('outlined')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        $this->schema->dropIfExists('icons');
    }
};
