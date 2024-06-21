<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LookupTypesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('lookup_types')->insertOrIgnore([
            [
                'id' => 1,
                'title_en' => 'Course places',
                'title_ar' => 'مكان الدورات التدريبية',
                'slug' => 'course_places',
                'created_at' => Carbon::now()
            ],
            [
                'id' => 2,
                'title_en' => 'Course tracks',
                'title_ar' => 'مسارات الدورات التدريبية',
                'slug' => 'course_tracks',
                'created_at' => Carbon::now()
            ],
            [
                'id' => 3,
                'title_en' => 'Course classifications',
                'title_ar' => 'تصنيفات الدورات التدريبية',
                'slug' => 'course_classifications',
                'created_at' => Carbon::now()
            ],
            [
                'id' => 4,
                'title_en' => 'Course availabilities',
                'title_ar' => 'توافر الدورات التدريبية',
                'slug' => 'course_availabilities',
                'created_at' => Carbon::now()
            ],
            [
                'id' => 5,
                'title_en' => 'Course collaborations',
                'title_ar' => 'جهات التعاون في الدورات التدريبية',
                'slug' => 'course_collaborations',
                'created_at' => Carbon::now()
            ],
            [
                'id' => 6,
                'title_en' => 'Course sponsors',
                'title_ar' => 'رعاة الدورات التدريبية',
                'slug' => 'course_sponsors',
                'created_at' => Carbon::now()
            ],
            [
                'id' => 7,
                'title_en' => 'Course accreditations',
                'title_ar' => 'جهات اعتماد الدورات التدريبية',
                'slug' => 'course_accreditations',
                'created_at' => Carbon::now()
            ],
            [
                'id' => 8,
                'title_en' => 'Course Organizers',
                'title_ar' => 'منظمي الدورات التدريبية',
                'slug' => 'course_organizers',
                'created_at' => Carbon::now()
            ],
        ]);
    }
}
