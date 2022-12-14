<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hadises',function (Blueprint $t){
            $t->id();
            $t->string('gala',100);
            $t->string('arabi');
            $t->string('farsi');
            $t->string('manba',150)->nullable();
            $t->unsignedBigInteger('group')->unsigned()->nullable();
            $t->unsignedBigInteger('charity')->unsigned();
            $t->boolean("is_active")->default(1);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('hadises');
    }
};
