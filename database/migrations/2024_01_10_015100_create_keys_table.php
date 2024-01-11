<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKeysTable extends Migration
{
    public function up(){
        Schema::create('keys', function(Blueprint $table){
            $table->increments('id');
            $table->integer('key')->index();
        });
    }


    public function down(){
        Schema::dropIfExists('keys');
    }
}