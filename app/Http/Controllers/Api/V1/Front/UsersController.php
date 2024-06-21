<?php

namespace App\Http\Controllers\Api\V1\Front;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\UserResource;
use App\Models\Country;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class UsersController extends Controller
{

    public function completeUserData(Request $request)
    {
        $validated = $this->validator($request->all());

        if ($validated->fails()) {
            return $this->toJson(null, 400, $validated->errors()->first(), false);
        }

        $data = $request->all();

        if (isset($data['password'])) {
            $data['password'] = bcrypt($data['password']);
        }

        $user = User::updateOrCreate([
            'email' => $data['email'],
            'id' => isset($data['id']) ? $data['id'] : null
        ], $data);

        $token = $user->createToken('Personal Token')->accessToken;
        $user['token'] = $token;

        $user = new UserResource($user);

        try {
            $noti = SendNotification([
                'title_en' => __('notification.register_title', [], 'en'),
                'message_en' => __('notification.register_message', [], 'en'),
                'title_ar' => __('notification.register_title', [], 'ar'),
                'message_ar' => __('notification.register_message', [], 'ar')
            ],null,null,$user->id,'user_login');
        } catch (\Throwable $th) {
            //throw $th;
        }

        return $this->toJson($user);
    }


    protected function validator(array $data)
    {
        $id = isset($data['id']) ? $data['id'] : null;
        return Validator::make($data, [
            'email'    => [
                'required', 'string', 'email', 'max:255',
                Rule::unique('users')->whereNull('deleted_at')->ignore($id, 'id')
            ],
            'name' => ['string', 'min:3', 'max:100', 'nullable'],
            'password' => 'required|string|min:6|confirmed',
            'full_name_en' => ['string', 'min:3', 'max:100', 'nullable'],
            'full_name_ar' => ['string',  'min:3', 'max:100', 'nullable'],
            'phone' => ['string', 'required', 'min:6', 'max:14', Rule::unique('users')->whereNull('deleted_at')],
            'gender' => ['string', 'nullable'],
            'sub_specialty_id' => ['nullable'],
            'specialty_id' => ['nullable'],
            'nationality_id' => ['nullable'],
            'name_title' => ['nullable'],
            'terms' => ['nullable'],
            'privacy' => ['nullable'],
            'attend' => ['nullable'],
            'contract' => ['nullable'],
            'identity_number' => ['nullable'],
            'identity_type' => ['nullable', 'in:national_id,resident_id,passport,non_resident'],
        ], [], [
            'gender' => __('frontend.register.gender'),
            'occupational_classification_number' => __('frontend.register.occupational_classification_number'),
            'email' => __('frontend.register.Email'),
            'phone' => __('frontend.register.Phone Number'),
            'password' =>  __('frontend.register.Password'),
            'password_confirmation' => trans('frontend.register.Password confirmation')
        ]);
    }

    public function userData()
    {
        return $this->toJson(new UserResource(Auth::user()));
    }


    public function updateUserImage(Request $request)
    {
        $v = Validator::make(request()->all(), [
            'personal_photo' => 'required|image'
        ]);

        if ($v->fails()) {
            return $this->toJson(null, 400, $v->messages()->first(), false);
        }

        $user = Auth::user();

        if ($request->personal_photo) {
            if (!$user->personal_photo || $request->personal_photo !== $user->personal_photo->file_name) {
                if ($user->personal_photo) {
                    $user->personal_photo->delete();
                }

                $user->addMedia($request->personal_photo)->toMediaCollection('personal_photo');
            }
            return $this->toJson(new UserResource(User::find($user->id)), 200, 'personal photo updated successfully');
        }

        return $this->toJson(null, 400, 'some thing wrong', false);
    }

    public function updateProfile(Request $request)
    {

        $v = Validator::make(request()->all(), [
            'job_place' => 'required|string',
            'job_name' => 'required|string',
            'country_id' => 'required|exists:countries,id',
            'city' => 'required|string',
            'personal_photo' => 'nullable|image'
        ]);

        if ($v->fails()) {
            return $this->toJson(null, 400, $v->messages()->first(), false);
        }

        $data = $request->all();

        $user = Auth::user();

        if ($request->country_id) {
            $country = Country::find($request->country_id);
            $data['country'] = $country ? $country->country_enName : null;
        }

        $request->user()->update($data);

        if ($request->personal_photo) {
            if (!$user->personal_photo || $request->personal_photo !== $user->personal_photo->file_name) {
                if ($user->personal_photo) {
                    $user->personal_photo->delete();
                }

                $user->addMedia($request->personal_photo)->toMediaCollection('personal_photo');
            }
        }

        return $this->toJson(new UserResource(User::find($user->id)), 200, 'updated successfully');
    }
    /**
     * Deactivate User
     */
    public function delete_account($id)
    {

        {
            try {



                $user = User::findOrFail($id);

                if($user){
                    $data['approved'] = 0;
                    $data['status'] = 'Unverified';
                    $data['verified'] = 0;
                    $data['verified_at'] = null;


                    $user->update($data);


                    return response()->json([
                    "status" => true,
                    "message" => 'Your Account deleted successfully ',
                ], 200);
                } else

                return response()->json(null);


            } catch (\Throwable $th) {
                return $this->toJson(null, 400, $th->getMessage(), false);
            }
        }
    }
}
