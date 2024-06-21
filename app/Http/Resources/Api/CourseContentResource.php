<?php

namespace App\Http\Resources\Api;

use App\Http\Resources\ReviewResource;
use App\Models\User;
use App\Models\Wishlist;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Str;

class CourseContentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {

        $completion_percentage = $this->user_course ? $this->user_course->completion_percentage: 0;

        $lang = app()->getLocale();
        $share_link = config('app.APP_URL', 'https://afaq-lms.com') . '/' . $lang . '/course/' . $this->id;
        $user_questionaire_before = \App\Models\CourseQuestionaireUserAnswar::where('course_id', $this->id )->where('user_id' , auth()->user()->id)->exists();

        return [
            'id' => $this->id,
            'name' => $this->name ?? null,
            'share_link' => $share_link,
            'share_item' => [
                'type' => 'course',
                'item_id' => $this->id
            ],
            'image' => $this->image ? get_image($this->image->url) : null,
            'questionaire_availabity' => $completion_percentage >= $this->success_percentage ? true : false,
            'completion_percentage' => $completion_percentage,
            'sections' => $this->sections ? CourseSectionResource::collection($this->sections):null,
            'user_questionaire_before' => $user_questionaire_before
        ];
    }
}
