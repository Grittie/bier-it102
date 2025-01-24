<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('scoresy1', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->integer('pitchers')->default(0);
            $table->integer('shame')->default(0);
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
        });

        Schema::create('scoresy2', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->integer('pitchers')->default(0);
            $table->integer('shame')->default(0);
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('scoresy1');
        Schema::dropIfExists('scoresy2');
    }
};
