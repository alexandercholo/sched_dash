<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('announcements', function (Blueprint $table) {
            $table->id();
            $table->string('email');
            $table->string('program');
            $table->string('title');
            $table->text('content');
            $table->string('media_path')->nullable();
            $table->string('media_type')->nullable();
            $table->integer('video_length')->nullable();
            $table->date('target_date');
            $table->integer('display_duration');
            $table->string('digital_signature');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('announcements');
    }
};
