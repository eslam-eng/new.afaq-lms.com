<?php

use App\Models\CourseSectionLecture;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddLectureIdToCourseQuizesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('course_quizes', function (Blueprint $table) {
            $table->foreignIdFor(CourseSectionLecture::class,'lecture_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('course_quizes', function (Blueprint $table) {
            //
        });
    }
}
