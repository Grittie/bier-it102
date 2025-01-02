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
        Schema::create('heartbeats', function (Blueprint $table) {
            $table->id('heartbeat_id');
            $table->timestamp('timestamp')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->string('status', 20)->default('Active');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('heartbeats');
    }
};
