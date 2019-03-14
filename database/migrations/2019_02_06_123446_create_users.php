<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('user', function($table){
            $table->increments('id');
            $table->string('name');
            $table->date('birthday')->nullable();
            $table->string('email');
            $table->string('password');
            $table->string('address')->nullable();
            $table->string('telephone')->nullable();
            $table->integer('id_class')->nullable()->unsigned();
            $table->integer('roles')->nullable();
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
        //
        Schema::dropIfExists('user');
    }
}
