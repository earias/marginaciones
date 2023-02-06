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
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('email')->unique();
            $table->string('avatar')->default('user.png');
            $table->unsignedBigInteger('id_rol')->default(3);
            $table->unsignedBigInteger('id_style')->default(3);
            $table->unsignedBigInteger('id_style_menu')->default(1);
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->boolean('status')->default(1);
            $table->rememberToken();
            $table->timestamps();

            $table->foreign('id_rol')->references('id')->on('rol');
            $table->foreign('id_style')->references('id_style')->on('style');
            $table->foreign('id_style_menu')->references('id_style_menu')->on('style_menu');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
