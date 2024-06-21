<?php

use App\Models\Course;
use App\Models\CourseQuestionaire;
use App\Models\CourseQuestionaireQuestion;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCourseQuestionaireQuestionAnswarsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('course_questionaire_question_answars', function (Blueprint $table) {
            $table->id();
            $table->mediumText('title_en');
            $table->mediumText('title_ar');
            $table->foreignIdFor(Course::class, 'course_id');
            $table->foreignIdFor(CourseQuestionaire::class, 'course_questionaire_id');
            $table->foreignIdFor(CourseQuestionaireQuestion::class, 'course_questionaire_question_id');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('course_questionaire_question_answars');
    }
}
