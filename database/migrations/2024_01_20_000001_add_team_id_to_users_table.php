<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        if (!Schema::hasTable('teams')) {
            throw new \Exception('La tabla teams debe existir antes de ejecutar esta migración');
        }

        Schema::table('users', function (Blueprint $table) {
            if (!Schema::hasColumn('users', 'team_id')) {
                $table->unsignedBigInteger('team_id')->nullable()->after('id');
                $table->foreign('team_id')
                    ->references('id')
                    ->on('teams')
                    ->onDelete('cascade');
            }
        });
    }

    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            if (Schema::hasColumn('users', 'team_id')) {
                $table->dropForeign(['team_id']);
                $table->dropColumn('team_id');
            }
        });
    }
};
