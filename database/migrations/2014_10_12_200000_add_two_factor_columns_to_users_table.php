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
        return config('database.default');
    }

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $this->schema->table('users', function (Blueprint $table) {
            $table->text('two_factor_secret')
                    ->after('password')
                    ->nullable();

            $table->text('two_factor_recovery_codes')
                    ->after('two_factor_secret')
                    ->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $this->schema->table('users', function (Blueprint $table) {
            $table->dropColumn('two_factor_secret', 'two_factor_recovery_codes');
        });
    }
};
