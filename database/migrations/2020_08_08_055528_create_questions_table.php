<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuestionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('questions', function (Blueprint $table) {
            $table->uuid('id')->primary();

            $table->uuid('subject_id');
            $table->foreign('subject_id')->references('id')->on('subjects')->onUpdate('cascade')->onDelete('cascade');

            $table->uuid('chapter_id');
            $table->foreign('chapter_id')->references('id')->on('chapters')->onUpdate('cascade')->onDelete('cascade');

            $table->text('question');

            $table->string('option_1');
            $table->string('option_2');
            $table->string('option_3');
            $table->string('option_4');

            $table->enum('answer', ['option_1', 'option_2', 'option_3', 'option_4']);

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
        Schema::dropIfExists('questions');
    }
}
