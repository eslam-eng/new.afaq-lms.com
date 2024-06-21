<?php

namespace App\Http\Controllers\Actions\Migration;

use App\Models\Certificat;
use App\Models\CourseCertificate;
use App\Models\UserCertificate;
use Illuminate\Support\Facades\DB;
use phpseclib3\File\ASN1\Maps\Certificate;

class CertificatesMigration
{
    public function migrate()
    {
        $certificates = DB::connection('afaq_source')->table('mod_lms_certificate_design')->get();

        foreach ($certificates as $certificate) {
            Certificat::create([
                'id' => $certificate->id,
                'name_en' => $certificate->name,
                'name_ar' => $certificate->name,
            ]);
        }

        sleep(10);

        $certificate_users = DB::connection('afaq_source')->table('mod_lms_certificate')->get();

        foreach ($certificate_users as $certificate_user) {
            UserCertificate::insertOrIgnore([
                'user_id' => $certificate_user->user_id,
                'course_id' => $certificate_user->course_id,
                'certificate_id' => $certificate_user->cert_design_id,
            ]);
            CourseCertificate::updateOrCreate([
                'course_id' => $certificate_user->course_id,
                'certificate_id' => $certificate_user->cert_design_id,
            ]);
        }
    }
}
