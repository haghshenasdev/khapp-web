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
        Schema::create('types',function (Blueprint $t){
            $t->smallIncrements('id');
            $t->string('type_name',150);
            $t->string('title',150);
            $t->string('description');
            $t->boolean('is_active');
            $t->smallInteger('sub')->unsigned();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('types');
    }
};
