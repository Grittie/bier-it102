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
        Schema::create('internal_temperature', function (Blueprint $table) {
            $table->id('temp_log_id');
            $table->timestamp('timestamp');
            $table->float('temperature');
            $table->float('humidity');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('internal_temperature');
    }
};
