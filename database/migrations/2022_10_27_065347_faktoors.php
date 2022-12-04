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
        Schema::create('faktoors',function (Blueprint $t) {
            $t->id();
            $t->unsignedBigInteger('userid');
            $t->integer('amount');
            $t->smallInteger('type')->unsigned();
            $t->timestamps();
            $t->string('sabtid',150);
            $t->boolean('is_pardakht');
            $t->unsignedBigInteger('charity')->unsigned();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('faktoors');
    }
};
