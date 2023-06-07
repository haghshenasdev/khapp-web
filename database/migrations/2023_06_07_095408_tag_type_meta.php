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
        Schema::create('tag_type_meta', function (Blueprint $table) {
            $table->id();
            $table->integer('width')->nullable();
            $table->integer('height')->nullable();
            $table->integer('Weight')->nullable();
            $table->string('material')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tag_type_meta');
    }
};
