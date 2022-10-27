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
        Schema::create('sandooghD',function (Blueprint $t){
            $t->id();
            $t->smallInteger('type')->unsigned();
            $t->unsignedBigInteger('user');
            $t->text('description')->nullable();
            $t->timestamp('date')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sandooghD');
    }
};
