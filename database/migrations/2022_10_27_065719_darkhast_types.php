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
        Schema::create('darkhast_types',function (Blueprint $t){
            $t->id();
            $t->string('title',100);
            $t->text('description')->nullable();
            $t->boolean("is_active")->default(1);
            $t->unsignedBigInteger('charity')->unsigned();
            $t->unsignedBigInteger('sub')->unsigned()->nullable();
            $t->boolean('default')->nullable();
            $t->boolean('optional_sub_select')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('darkhast_types');
    }
};
