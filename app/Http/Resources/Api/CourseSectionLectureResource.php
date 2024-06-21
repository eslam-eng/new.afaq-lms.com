<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Resources\Json\JsonResource;

class CourseSectionLectureResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $type_icon = '';
        $complete_percentage = 0;
        $can_take = 0;
        $can_start = 0;
        switch ($this->type) {
            case 'quize':
                $type_icon = asset('afaq/icons/quize-icon.png');
                if(auth()->check()){
                    $complete_percentage = $this->quize ? ($this->quize->score()->where('user_id',auth()->user()->id)->exists() ? $this->quize->score()->where('user_id',auth()->user()->id)->first()->score_percentage : 0) : 0;
                }else{
                    $complete_percentage = 0;
                }
                if (auth()->check()) {
                    if ($this->quize
                        ->scores()
                        ->where('user_id', auth()->user()->id)
                        ->first()
                    ) {
                        $can_take =
                            ($this->quize
                                ->scores()
                                ->where('user_id', auth()->user()->id)
                                ->first() ? $this->quize
                                ->scores()
                                ->where('user_id', auth()->user()->id)
                                ->first()->repeat_times < $this->quize->repeat_times : false) ? true : false;
                    } else {
                        $can_take = $this->quize->repeat_times ? true : false;
                    }
                } else {
                    $can_take = false;
                }
                break;
            case 'zoom':
                $type_icon = asset('afaq/icons/zoom-icon.png');
                if(auth()->check()){
                    $complete_percentage = $this->zoom ? ($this->zoom->report()->where('user_id',auth()->user()->id)->exists() ? $this->zoom->report()->where('user_id',auth()->user()->id)->first()->join_percentage : 0) : 0;
                }else{
                    $complete_percentage = $this->zoom ? ($this->zoom->report()->exists() ? $this->zoom->report()->first()->join_percentage : 0) : 0;
                }
                $can_start = $this->zoom ? ((date('Y-m-d H:i:s', strtotime(now()))  > date('Y-m-d H:i:s', strtotime($this->zoom->start_time)) && date('Y-m-d H:i:s', strtotime(now())) < date('Y-m-d H:i:s', strtotime("+".$this->zoom->duration."minutes",strtotime($this->zoom->start_time)))  )  ? true : false) : false;
                break;
            case 'video':
                $type_icon = asset('afaq/icons/video-icon.png');
                $complete_percentage = $this->videoScoreOne ? ($this->videoScoreOne->score_percentage > 100 ? 100 : $this->videoScoreOne->score_percentage) : 0;
                break;
            default:
                $type_icon = asset('afaq/icons/file-icon.png');
                break;
        }
        return [
            'id' => $this->id,
            'name' => app()->getLocale() == 'en' ? $this->title_en : $this->title_ar,
            'order' => $this->order,
            'short_description' => app()->getLocale() == 'en' ? $this->short_description_en : $this->short_description_ar,
            'accessing' => $this->accessing,
            'duration' => $this->duration,
            'type_icon' => $type_icon,
            'type' => $this->type,
            'complete_percentage' => floatval($complete_percentage),
            'can_open' => $this->when($this->type == 'quize', $can_take),
            'zoom_data' => $this->when($this->type == 'zoom', [
                'start_time' => $this->zoom ? date('Y-m-d H:i:s', strtotime($this->zoom->start_time))  : '',
                'end_time' => $this->zoom ? date('Y-m-d H:i:s', strtotime($this->zoom->end_time)) : '',
            ]),
            'can_start' => $this->when($this->type == 'zoom', $can_start),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}
