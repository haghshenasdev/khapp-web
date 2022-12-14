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
        Schema::create('charities',function (Blueprint $t){
            $t->id();
            $t->string('fullname',100);
            $t->string('shortname',100);
            $t->text('about');
            $t->integer('authority')->unsigned()->nullable();
            $t->boolean("is_active")->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('Charities');
    }
};
