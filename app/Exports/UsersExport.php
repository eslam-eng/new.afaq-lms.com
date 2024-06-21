<?php

namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class UsersExport implements FromCollection,WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        $data = array();
        $users =  User::with('country_and_nationality')
            ->whereHas('roles', function ($q) {
                $q->where('id', 3);
            })->with('specialty', 'SubSpecialty', 'country_and_nationality')
            ->where('verified', 1);

        if(request('specialty_id') && !is_null(request('specialty_id')[0])){
            $users = $users->whereIn('specialty_id',request('specialty_id'));
        }
        if(request('sub_specialty_id') && !is_null(request('sub_specialty_id')[0])){
            $users = $users->whereIn('sub_specialty_id',request('sub_specialty_id'));
        }

        if(request('country_id')  && !is_null(request('country_id')[0])){
            $users = $users->whereIn('nationality_id',request('country_id'));
        }

        $users = $users->orderBy('id', 'desc')->get();

        foreach ($users as $user) {
            if ($user->sub_specialty_id  && $user->phone && in_array($user->specialty_id, [9, 10])) {
                $complete_data = 1;
            } elseif ($user->sub_specialty_id && $user->phone && !in_array($user->specialty_id, [9, 10]) && (!in_array($user->specialty_id, [9, 10]) ? $user->occupational_classification_number : true)) {
                $complete_data = 1;
            } else {
                $complete_data = 0;
            }

            try {
                $token = $user->when($complete_data, $user->token ?? null);
            } catch (\Throwable $th) {
                //throw $th;
                $token = null;
            }


            array_push($data, [
                'id' => $user->id,
                'name' => $user->full_name,
                'email' => $user->email,
                "phone" =>  $user->phone,
                "occupational_classification_number" => $user->occupational_classification_number ?? null,
                "specialty" =>  $user->specialty ? $user->specialty->name : '',
                "sub_specialty" =>  $user->SubSpecialty ? $user->SubSpecialty->name : '',
                "nationality" =>  $user->country_and_nationality ? $user->country_and_nationality->nationality : '',
                "country" =>  $user->country_and_nationality ? $user->country_and_nationality->title : '',
                "created_at" => $user->created_at
            ]);

        }

        return collect($data);

    }

    public function headings(): array
    {
        return [
            'id',
            'name',
            'email',
            'phone',
            'occupational_classification_number',
            'specialty',
            'sub_specialty',
            'nationality',
            'country',
            'created_at'
        ];
    }
}
