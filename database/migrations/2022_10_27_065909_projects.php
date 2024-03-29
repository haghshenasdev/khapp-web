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
        Schema::create('projects',function (Blueprint $t){
            $t->id();
            $t->string('slug',100);
            $t->string('title');
            $t->text('description');
            $t->string('image_head');
            $t->integer('pishraft');
            $t->unsignedBigInteger('type_pay')->unsigned()->nullable();
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
        Schema::dropIfExists('projects');
    }
};
