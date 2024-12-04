<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('schedule_events', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->date('date');
            $table->string('location');
            $table->time('start_time');
            $table->time('end_time');
            $table->string('program');
            $table->string('email');
            $table->text('description');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('schedule_events');
    }
};