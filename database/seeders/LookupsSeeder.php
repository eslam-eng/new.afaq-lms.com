<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LookupsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('lookups')->insertOrIgnore([
            [
                'title_en' => 'Physical training',
                'title_ar' => 'التدريب حضورى',
                'slug' => 'physical_training',
                'lookup_type_id' => 1,
                'created_at' => Carbon::now(),
            ],
            [
                'title_en' => 'Live streaming',
                'title_ar' => 'بث مباشر',
                'slug' => 'live_streaming',
                'lookup_type_id' => 1,
                'created_at' => Carbon::now(),
            ],
            [
                'title_en' => 'broadcast + attendance',
                'title_ar' => 'بث مباشر + الحضور',
                'slug' => 'broadcast_attendance',
                'lookup_type_id' => 1,
                'created_at' => Carbon::now(),
            ],
            [
                'title_en' => 'Course',
                'title_ar' => 'دورة تدريبية',
                'slug' => 'course',
                'lookup_type_id' => 2,
                'created_at' => Carbon::now(),
            ],
            [
                'title_en' => 'Conference',
                'title_ar' => 'مؤتمر',
                'slug' => 'conference',
                'lookup_type_id' => 2,
                'created_at' => Carbon::now(),
            ],
            [
                'title_en' => 'Workshop',
                'title_ar' => 'ورشة عمل',
                'slug' => 'workshop',
                'lookup_type_id' => 2,
                'created_at' => Carbon::now(),
            ],

            [
                'title_en' => 'Anticipated',
                'title_ar' => 'متوقعا',
                'slug' => 'anticipated',
                'lookup_type_id' => 4,
                'created_at' => Carbon::now(),
            ],
            [
                'title_en' => 'New',
                'title_ar' => 'جديد',
                'slug' => 'new',
                'lookup_type_id' => 4,
                'created_at' => Carbon::now(),
            ],
            [
                'title_en' => 'Available Now',
                'title_ar' => 'متوفر الآن',
                'slug' => 'available_now',
                'lookup_type_id' => 4,
                'created_at' => Carbon::now(),
            ],
            [
                'title_en' => 'Archived',
                'title_ar' => 'تمت أرشفته',
                'slug' => 'archived',
                'lookup_type_id' => 4,
                'created_at' => Carbon::now(),
            ],
            [
                'title_en' => 'Special Offers',
                'title_ar' => 'عروض خاصة',
                'slug' => 'special_offers',
                'lookup_type_id' => 4,
                'created_at' => Carbon::now(),
            ],
            [
                'title_en' => 'Accredited',
                'title_ar' => 'معتمد',
                'slug' => 'accredited',
                'lookup_type_id' => 7,
                'created_at' => Carbon::now(),
            ],
            [
                'title_en' => 'Not Accredited',
                'title_ar' => 'غير معتمد',
                'slug' => 'not_accredited',
                'lookup_type_id' => 7,
                'created_at' => Carbon::now(),
            ],
            [
                'title_en' => 'Under Accreditation',
                'title_ar' => 'تحت الاعتماد',
                'slug' => 'under_accreditation',
                'lookup_type_id' => 7,
                'created_at' => Carbon::now(),
            ],
        ]);
    }
}
