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
        Schema::create('drink_sessions', function (Blueprint $table) {
            $table->id('session_id');
            $table->unsignedBigInteger('user_id');
            $table->date('session_date');
            $table->time('check_in_time');
            $table->time('check_out_time')->nullable();
            $table->unsignedInteger('pitchers')->default(0);
            $table->float('total_hours')->storedAs(
                "TIMESTAMPDIFF(SECOND, CONCAT(session_date, ' ', check_in_time), CONCAT(session_date, ' ', check_out_time)) / 3600"
            );
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    public function down()
    {
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('drink_sessions');
        Schema::enableForeignKeyConstraints();
    }
};
