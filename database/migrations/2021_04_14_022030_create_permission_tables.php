<?php

use App\models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePermissionTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $tableNames = config('permission.table_names');
        $columnNames = config('permission.column_names');

        Schema::connection(config('jetport.auth.database_connection'))->create($tableNames['permissions'], function (Blueprint $table) use ($tableNames) {
            $table->bigIncrements('id');
            $table->enum('type', [User::TYPE_ADMIN, User::TYPE_USER]);
            $table->string('guard_name');
            $table->string('name');
            $table->string('description')->nullable();
            $table->integer('created_by')->nullable();
            $table->integer('updated_by')->nullable();
            $table->integer('deleted_by')->nullable();
            $table->unsignedBigInteger('parent_id')->nullable();
            $table->tinyInteger('sort')->default(1);
            $table->timestamps();

            $table->foreign('parent_id')
                ->references('id')
                ->on($tableNames['permissions'])
                ->onDelete('cascade');
        });

        Schema::connection(config('jetport.auth.database_connection'))->create($tableNames['roles'], function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->enum('type', [User::TYPE_ADMIN, User::TYPE_USER]);
            $table->string('name');
            $table->string('guard_name');
            $table->integer('created_by')->nullable();
            $table->integer('updated_by')->nullable();
            $table->integer('deleted_by')->nullable();
            $table->timestamps();
        });

        Schema::connection(config('jetport.auth.database_connection'))->create($tableNames['model_has_permissions'], function (Blueprint $table) use ($tableNames, $columnNames) {
            $table->unsignedBigInteger('permission_id');

            $table->string('model_type');
            $table->unsignedBigInteger($columnNames['model_morph_key']);
            $table->index([$columnNames['model_morph_key'], 'model_type'], 'model_has_permissions_model_id_model_type_index');

            $table->foreign('permission_id')
                ->references('id')
                ->on($tableNames['permissions'])
                ->onDelete('cascade');

            $table->primary(
                ['permission_id', $columnNames['model_morph_key'], 'model_type'],
                'model_has_permissions_permission_model_type_primary'
            );
        });

        Schema::connection(config('jetport.auth.database_connection'))->create($tableNames['model_has_roles'], function (Blueprint $table) use ($tableNames, $columnNames) {
            $table->unsignedBigInteger('role_id');

            $table->string('model_type');
            $table->unsignedBigInteger($columnNames['model_morph_key']);
            $table->index([$columnNames['model_morph_key'], 'model_type'], 'model_has_roles_model_id_model_type_index');

            $table->foreign('role_id')
                ->references('id')
                ->on($tableNames['roles'])
                ->onDelete('cascade');

            $table->primary(
                ['role_id', $columnNames['model_morph_key'], 'model_type'],
                'model_has_roles_role_model_type_primary'
            );
        });

        Schema::connection(config('jetport.auth.database_connection'))->create($tableNames['role_has_permissions'], function (Blueprint $table) use ($tableNames) {
            $table->integer('created_by')->nullable();
            $table->integer('updated_by')->nullable();
            $table->integer('deleted_by')->nullable();
            $table->unsignedBigInteger('permission_id');
            $table->unsignedBigInteger('role_id');

            $table->foreign('permission_id')
                ->references('id')
                ->on($tableNames['permissions'])
                ->onDelete('cascade');

            $table->foreign('role_id')
                ->references('id')
                ->on($tableNames['roles'])
                ->onDelete('cascade');

            $table->primary(['permission_id', 'role_id'], 'role_has_permissions_permission_id_role_id_primary');
        });

        app('cache')
            ->store(config('permission.cache.store') != 'default' ? config('permission.cache.store') : null)
            ->forget(config('permission.cache.key'));
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $tableNames = config('permission.table_names');

        Schema::connection(config('jetport.auth.database_connection'))->drop($tableNames['role_has_permissions']);
        Schema::connection(config('jetport.auth.database_connection'))->drop($tableNames['model_has_roles']);
        Schema::connection(config('jetport.auth.database_connection'))->drop($tableNames['model_has_permissions']);
        Schema::connection(config('jetport.auth.database_connection'))->drop($tableNames['roles']);
        Schema::connection(config('jetport.auth.database_connection'))->drop($tableNames['permissions']);
    }
}
