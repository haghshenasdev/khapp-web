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
        Schema::table('faktoors',function (Blueprint $t){
            $t->foreign('charity')
                ->references('id')
                ->on('charities');
        });

        Schema::table('hadises',function (Blueprint $t){
            $t->foreign('charity')
                ->references('id')
                ->on('charities');
        });

        Schema::table('pooyeshes',function (Blueprint $t){
            $t->foreign('charity')
                ->references('id')
                ->on('charities');
        });

        Schema::table('notifications',function (Blueprint $t){
            $t->foreign('charity')
                ->references('id')
                ->on('charities');
        });

        Schema::table('types',function (Blueprint $t){
            $t->foreign('charity')
                ->references('id')
                ->on('charities');
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
    }
};
