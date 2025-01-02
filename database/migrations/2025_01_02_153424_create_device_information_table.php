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
        Schema::create('device_information', function (Blueprint $table) {
            $table->id();
            $table->timestamp('timestamp')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->string('ip', 45);
            $table->string('mac', 17);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('device_information');
    }
};
