<?php

namespace App\Http\Resources;

use App\Models\UserCertificate;
use Illuminate\Http\Resources\Json\JsonResource;

class MyCertificateResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {

        if ($this->id) {
            $text = null;
            $certificate_img = $this->certificate_img;
        } else {
            $text = app()->getLocale() == 'en' ? 'Certificate not generated' :    'لم يتم اصدار الشهاده';
        }

        if (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on')
            $domain = "https://";
        else
            $domain = "http://";
        // Append the host(domain name, ip) to the domain.
        $domain .= $_SERVER['HTTP_HOST'];


        return [
            'id' => $this->id ?? null,
            'certificate_id' =>  $this->course->certificate->certificate->id ??  null,
            'certificate_name' => (app()->getLocale() == 'en' ?  $this->course->name_en : ($this->course->name_ar ?? null)) ??  null,
            'course_id' =>  $this->course->id  ?? null,
            'course_name' => (app()->getLocale() == 'en' ? $this->course->name_en : ($this->course->name_ar ?? null)) ?? null,
            'user_completion_percentage' => $this->course->user_course->completion_percentage ?? 0,
            'course_success_percentage' => $this->course->user_course->success_percentage ?? 0,
            'issued' => $text ? false : true,
            'message' => $text ?? null,
            // 'certificate_img' => $certificate_img ?? null,
            'url' => $text ? null : $domain . '/certificate-view?certificate_id=' . $this->course->certificate->certificate->id . '&course_id=' . $this->course->id . '&user_id=' . auth()->user()->id,
            'certificate_date' => $this->created_at ? date('Y-m-d' , strtotime($this->created_at)) : null
        ];
    }
}
