<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHomeFieldForUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        \Schema::table('users', function (Blueprint $table)
        {
            $table->unsignedInteger('home')
                ->nullable();

            $table->foreign('home')
                ->references('id')
                ->on('nodes')
                ->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        \Schema::table('users', function (Blueprint $table)
        {
            $table->dropColumn('home');
        });
    }
}
