<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('email');
            $table->string('password');
            $table->string('key');
            $table->string('img');
            $table->integer('type')->default(2);
            $table->integer('verified')->default(0);
            $table->rememberToken();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
//        Schema::dropColumn('email');
//        Schema::dropColumn('password');
//        Schema::dropColumn('key');
//        Schema::dropColumn('img');
    }
}
