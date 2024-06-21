<?php

use App\Models\Course;
use App\Models\CourseSection;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCourseSectionLecturesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('course_section_lectures', function (Blueprint $table) {
            $table->id();
            $table->string('title_en');
            $table->string('title_ar');
            $table->mediumText('short_description_en')->nullable();
            $table->mediumText('short_description_ar')->nullable();
            $table->string('accessing')->nullable();
            $table->foreignIdFor(Course::class, 'course_id');
            $table->foreignIdFor(CourseSection::class, 'course_section_id');
            $table->mediumText('file')->nullable();
            $table->string('duration')->nullable();
            $table->string('type')->nullable();
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
        Schema::dropIfExists('course_section_lectures');
    }
}
