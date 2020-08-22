<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVideoQualitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('video_qualities', function (Blueprint $table) {
            $table->uuid('id')->primary();

            $table->uuid('video_id');
            $table->foreign('video_id')->references('id')->on('videos')->onUpdate('cascade')->onDelete('cascade');

            $table->enum('quality', ['480p', '720p', '1080p'])->default('joined');
            $table->string('link');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('video_qualities');
    }
}
