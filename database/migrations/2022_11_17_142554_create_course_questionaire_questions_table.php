<?php

use App\Models\Course;
use App\Models\CourseQuestionaire;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCourseQuestionaireQuestionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('course_questionaire_questions', function (Blueprint $table) {
            $table->id();
            $table->mediumText('title_en');
            $table->mediumText('title_ar');
            $table->foreignIdFor(Course::class, 'course_id');
            $table->foreignIdFor(CourseQuestionaire::class, 'course_questionaire_id');
            $table->string('type');
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
        Schema::dropIfExists('course_questionaire_questions');
    }
}
