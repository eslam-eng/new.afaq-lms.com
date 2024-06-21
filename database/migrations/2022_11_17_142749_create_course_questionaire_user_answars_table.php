<?php

use App\Models\Course;
use App\Models\CourseQuestionaire;
use App\Models\CourseQuestionaireQuestion;
use App\Models\CourseQuestionaireQuestionAnswar;
use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCourseQuestionaireUserAnswarsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('course_questionaire_user_answars', function (Blueprint $table) {
            $table->id();
            $table->longText('answar_text')->nullable();
            $table->foreignIdFor(User::class, 'user_id');
            $table->foreignIdFor(Course::class, 'course_id');
            $table->foreignIdFor(CourseQuestionaire::class, 'course_questionaire_id');
            $table->foreignIdFor(CourseQuestionaireQuestion::class, 'course_questionaire_question_id');
            $table->foreignIdFor(CourseQuestionaireQuestionAnswar::class, 'course_questionaire_question_answar_id')->nullable();

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
        Schema::dropIfExists('course_questionaire_user_answars');
    }
}
