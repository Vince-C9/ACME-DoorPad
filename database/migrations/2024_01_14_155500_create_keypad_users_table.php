<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKeypadUsersTable extends Migration
{
    public function up(){
        Schema::create('keypad_users', function(Blueprint $table){
            $table->increments('id');
            $table->string('name');
            $table->string('surname');
            $table->string('position_held');
            $table->string('phone_number')->nullable();
            $table->string('email_address');
            $table->timestamps();
        });
    }


    public function down(){
        Schema::dropIfExists('keypad_users');
    }
}