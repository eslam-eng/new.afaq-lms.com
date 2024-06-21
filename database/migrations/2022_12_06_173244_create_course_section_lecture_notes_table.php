<?php

use App\Models\Course;
use App\Models\CourseSection;
use App\Models\CourseSectionLecture;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCourseSectionLectureNotesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('course_section_lecture_notes', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Course::class, 'course_id');
            $table->foreignIdFor(CourseSection::class, 'course_section_id');
            $table->foreignIdFor(CourseSectionLecture::class, 'course_section_lecture_id');
            $table->text('note_en');
            $table->text('note_ar');
            $table->integer('in_time');
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
        Schema::dropIfExists('course_section_lecture_notes');
    }
}
