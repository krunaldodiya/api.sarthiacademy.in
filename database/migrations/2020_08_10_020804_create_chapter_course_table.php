<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChapterCourseTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('chapter_course', function (Blueprint $table) {
            $table->primary(['chapter_id', 'course_id']);

            $table->uuid('chapter_id');
            $table->foreign('chapter_id')->references('id')->on('chapters')->onUpdate('cascade')->onDelete('cascade');

            $table->uuid('course_id');
            $table->foreign('course_id')->references('id')->on('courses')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('question_test');
    }
}
