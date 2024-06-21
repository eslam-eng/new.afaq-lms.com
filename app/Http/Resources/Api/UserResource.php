<?php

namespace App\Http\Resources\Api;

use App\Http\Resources\Api\MiniSpecialtyResource;
use App\Models\Country;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    public function toArray($request)
    {
        if ($this->sub_specialty_id  && $this->phone && in_array($this->specialty_id, [9,10])) {
            $complete_data = 1;
        } elseif ($this->sub_specialty_id && $this->phone && !in_array($this->specialty_id, [9,10]) && (!in_array($this->specialty_id, [9, 10]) ? $this->occupational_classification_number : true)) {
            $complete_data = 1;
        } else {
            $complete_data = 0;
        }

        try {
            $token = $this->when($complete_data, $this->token ?? null);
        } catch (\Throwable $th) {
            //throw $th;
            $token = null;
        }

        if ($this->country) {
            $country = Country::where(function ($q) {
                $q->where("country_enName", "like", "%" . $this->country . "%")
                    ->orWhere("country_arName", "like", "%" . $this->country . "%");
            })->first();

            $country = $country ? $country->id : null;
        } else {
            $country = null;
        }
        return [
            'id' => $this->id,
            'email' => $this->email,
            "phone" =>  $this->phone,
            "gender" =>  $this->gender,
            "specialty" =>  $this->specialty ? new MiniSpecialtyResource($this->specialty) : null,
            "sub_specialty" =>  $this->SubSpecialty ? new MiniSpecialtyResource($this->SubSpecialty) : null,
            "nationality" =>  $this->country_and_nationality  ? new CountryResource($this->country_and_nationality) : null,
            "name_title" => $this->name_title ?? null,
            "identity_number" =>  $this->identity_number ?? null,
            "identity_type" =>  $this->identity_type ?? null,
            "full_name_en" =>  $this->full_name_en ?? null,
            "full_name_ar" =>  $this->full_name_ar ?? null,
            "occupational_classification_number" => $this->occupational_classification_number ?? null,
            "token" => $token ?? null,
            "complete_data" => $complete_data,
            "personal_photo" => isset($this->personal_photo->url)  ? $this->when($this->personal_photo, $this->personal_photo->url) : null,
            "job_name" =>  $this->job_name ?? null,
            "job_place" =>  $this->job_place ?? null,
            "city" => $this->city ?? null,
            "country_id" => $country ?? null,
        ];
    }
}
