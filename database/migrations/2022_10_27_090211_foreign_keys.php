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
            $t->foreign('userid')
                ->references('id')
                ->on('users');
            $t->foreign('type')
                ->references('id')
                ->on('types');
        });

        Schema::table('hadises',function (Blueprint $t){
            $t->foreign('group')
                ->references('id')
                ->on('hadis_groups');
        });

        Schema::table('pooyeshes',function (Blueprint $t){
            $t->foreign('type_pay')
                ->references('id')
                ->on('types');
        });

        Schema::table('sandooghD',function (Blueprint $t){
            $t->foreign('type')
                ->references('id')
                ->on('sandooghDtypes');
            $t->foreign('user')
                ->references('id')
                ->on('users');
        });

        Schema::table('notifications',function (Blueprint $t){
            $t->foreign('user')->references('id')->on('users');
        });

        Schema::table('menus',function (Blueprint $t){
            $t->foreign('sub')
                ->references('id')
                ->on('menus');
        });

        Schema::table('types',function (Blueprint $t){
            $t->foreign('sub')
                ->references('id')
                ->on('types');
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
