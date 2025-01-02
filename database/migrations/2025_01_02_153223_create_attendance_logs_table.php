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
        Schema::create('attendance_logs', function (Blueprint $table) {
            $table->id('log_id');
            $table->unsignedBigInteger('card_id');
            $table->timestamp('timestamp');
            $table->enum('event_type', ['Clock In', 'Clock Out']);
            $table->timestamps();

            $table->foreign('card_id')->references('card_id')->on('cards')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('attendance_logs');
    }
};
