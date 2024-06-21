<?php

namespace App\Http\Controllers\Api\V1\Front;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\RegisterSpecialtiesResource;
use App\Http\Resources\Api\UserResource;
use App\Models\ContentCategory;
use App\Models\Country;
use App\Models\Provider;
use App\Models\Specialty;
use App\Models\User;
use App\Models\UserNotification;
use App\Models\Wishlist;
use App\Notifications\PasswordReset;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function logout()
    {
        request()->user()->token()->revoke();
        return $this->toJson([], 200, trans('afaq.logout_successfully'));
    }

    public function register(Request $request)
    {
        $validated = $this->validator($request->all());

        if ($validated->fails()) {
            return $this->toJson(null, 400, $validated->errors()->first(), false);
        }

        $data = $request->all();

        if (isset($data['password'])) {
            $data['password'] = bcrypt($data['password']);
        }
        $data['verified'] = 1;
        $data['approved'] = 1;
        $data['verified_at'] = Carbon::now()->format(config('panel.date_format') . ' ' . config('panel.time_format'));
        $data['email_verified_at'] = Carbon::now()->format(config('panel.date_format') . ' ' . config('panel.time_format'));


        $user = User::updateOrCreate([
            'email' => $data['email'],
            'id' => isset($data['id']) ? $data['id'] : null
        ], $data);

        $token = $user->createToken('Personal Token')->accessToken;
        $user['token'] = $token;

        $user = new UserResource($user);

        return $this->toJson($user);
    }

    public function login(Request $request)
    {
        $data = $request->validate([
            'email' => 'email|required',
            'password' => 'required'
        ]);

        if (!auth()->attempt($data)) {
            return $this->toJson(null, 400, trans('auth.failed'), false);
        }

        $user = auth()->user();
        if ($user->approved == 0 && $user->verified == 0 && $user->verified_at == null  ) {
            return $this->toJson([], 404, trans('afaq.contact_support'), false);
        } else {

            $user['token'] = auth()->user()->createToken('Personal Token')->accessToken;

            $user = new UserResource($user);

            $this->syncDataToUser($request->header('token'), $user->id);

//            try {
//                if (!UserNotification::where(['user_id' => $user->id, 'title_en' => __('notification.login_title', [], 'en')])->first()) {
//                    SendNotification([
//                        'title_en' => __('notification.login_title', [], 'en'),
//                        'message_en' => __('notification.login_message', [], 'en'),
//                        'title_ar' => __('notification.login_title', [], 'ar'),
//                        'message_ar' => __('notification.login_message', [], 'ar')
//                    ], null, null, $user->id, 'user_login');
//                }
//            } catch (\Throwable $th) {
//                //throw $th;
//            }

            return $this->toJson($user);
        }
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
            'password' => ['requiredif:id,==,' . null, 'string', 'min:6', 'confirmed'],
            'full_name_en' => ['string', 'min:3', 'max:100', 'nullable'],
            'full_name_ar' => ['string',  'min:3', 'max:100', 'nullable'],
            'phone' => ['string', 'nullable', 'min:6', 'max:14', Rule::unique('users')->whereNull('deleted_at')],
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
            'occupational_classification_number' => 'required_unless:specialty_id,9,10,null'
        ], [], [
            'gender' => __('frontend.register.gender'),
            'occupational_classification_number' => __('frontend.register.occupational_classification_number'),
            'email' => __('frontend.register.Email'),
            'phone' => __('frontend.register.Phone Number'),
            'password' =>  __('frontend.register.Password'),
            'password_confirmation' => trans('frontend.register.Password confirmation')
        ]);
    }

    public function registerLists()
    {
        $name_title = [
            'Mr.' => 'Mr.',
            'Ms.' => 'Ms.',
            'Dr.' => 'Dr.',
            'Prof.' => 'Prof.',
        ];

        $gender = [
            "male" => app()->getLocale() == 'ar' ? 'ذكر' : 'Male',
            "female" => app()->getLocale() == 'ar' ? 'أنثي' : 'Female'
        ];

        $identity_types = [
            [
                'key' => "national_id",
                'value' => trans('frontend.national_id'),
            ],
            [
                'key' => "resident_id",
                'value' => trans('frontend.resident_id'),
            ],
            [
                'key' => "passport",
                'value' => trans('frontend.passport'),
            ],
            [
                'key' => "non_resident",
                'value' => trans('frontend.non_resident'),
            ],
        ];

        $ContentCategory = ContentCategory::get();

        $specialists = RegisterSpecialtiesResource::collection(Specialty::with('subcategories')->get());
        $degree_select = User::DEGREE_SELECT;
        $countries = Country::select('id', 'country_' . app()->getLocale() . 'Name as country', 'country_' . app()->getLocale() . 'Nationality as nationality', 'country_code', 'order')
            ->whereNull('parent_id')
            ->orderBy('order')
            ->get();


        $name_titles = [];
        foreach ($name_title as $key => $value) {
            array_push($name_titles, [
                'key' => $key,
                'value' => $value
            ]);
        }
        $degree_selects = [];
        foreach ($degree_select as $key => $value) {
            array_push($degree_selects, [
                'key' => $key,
                'value' => $value
            ]);
        }
        $genders = [];
        foreach ($gender as $key => $value) {
            array_push($genders, [
                'key' => $key,
                'value' => $value
            ]);
        }

        return $this->toJson([
            'name_title' => $name_titles,
            'degree_select' => $degree_selects,
            'gender' => $genders,
            'content_category' => $ContentCategory,
            'specialists' => $specialists,
            'countries' => $countries,
            'identity_types' => $identity_types
        ]);
    }

    public function social(Request $request)
    {
        if($request->email){
            $validated = $this->validateProvider($request->all());

            if ($validated->fails()) {
                return $this->toJson(null, 400, $validated->errors()->first(), false);
            }


            $userCreated = User::firstOrCreate(
                [
                    'email' => $request->email
                ],
                [
                    'email_verified_at' => now(),
                    'name' => $request->name,
                    'status' => true,
                    'created_at' => Carbon::now()
                ]
            );

            $userCreated->providers()->updateOrCreate(
                [
                    'provider' => $request->provider,
                    'provider_id' => $request->provider_id,
                ],
                [
                    'avatar' => $request->avatar
                ]
            );

        }else if($request->provider_id && $request->provider){
                $provider =  Provider::where([
                    'provider' => $request->provider,
                    'provider_id' => $request->provider_id,
                ])->first();

                if($provider){
                    $userCreated = $provider->user;
                }else{
                    $validated = $this->validateProvider($request->all());
                    if ($validated->fails()) {
                        return $this->toJson(null, 400, $validated->errors()->first(), false);
                    }
                }

        }

        $userCreated['token'] = $userCreated->createToken('Personal Token')->accessToken;

        $userCreated = new UserResource($userCreated);

        $this->syncDataToUser($request->header('token'), $userCreated->id);

//        try {
//            $noti = SendNotification([
//                'title_en' => __('notification.login_title', [], 'en'),
//                'message_en' => __('notification.login_message', [], 'en'),
//                'title_ar' => __('notification.login_title', [], 'ar'),
//                'message_ar' => __('notification.login_message', [], 'ar')
//            ]);
//        } catch (\Throwable $th) {
//            //throw $th;
//        }

        return $this->toJson($userCreated);
    }

    protected function validateProvider($data)
    {
        return Validator::make($data, [
            'email'    => [
                'required', 'string', 'email', 'max:255',
            ],
            'name' => ['string', 'min:3', 'max:100', 'nullable'],
            'provider' => [
                'required', 'string', 'max:255',
            ],
            'provider_id' => [
                'required', 'string',
            ]
        ]);
    }

    public function forgotPassword()
    {
        $v = Validator::make(request()->all(), [
            'email' => 'required|email|exists:users,email'
        ]);

        if ($v->fails()) {
            return $this->toJson(null, 400, $v->messages()->first(), false);
        }

        $credentials = ['email' => request('email')];

        Password::sendResetLink($credentials);

        return $this->toJson(null, 200, 'Reset password link sent on your email id.', true);
    }

    public function reset(Request $request)
    {
        try {
            DB::beginTransaction();

            $v = Validator::make(request()->all(), [
                'token' => 'required',
                'email' => 'required|email',
                'password' => 'required|min:8|confirmed',
            ]);

            if ($v->fails()) {
                return $this->toJson(null, 400, $v->messages()->first(), false);
            }

            $status = Password::reset(
                $request->only('email', 'password', 'password_confirmation', 'token'),
                function ($user, $password) {
                    $user->forceFill([
                        'password' => Hash::make($password)
                    ])->setRememberToken(Str::random(60));

                    $user->save();

                    event(new PasswordReset($user));
                }
            );

            if ($status === Password::PASSWORD_RESET) {

                DB::commit();

                return $this->toJson(null, 200, "Password has been successfully changed", true);
            } else {
                return $this->toJson(null, 400, __($status), false);
            }
            //code...
        } catch (\Throwable $th) {
            DB::rollBack();
            //throw $th;
            if (config('app.debug')) {
                //throw $th;
                return $this->toJson(null, 400, $th->getMessage(), false);
            }
        }
    }

    public function changePassword(Request $request)
    {
        $v = Validator::make(request()->all(), [
            'password' => 'required|min:8|confirmed',
        ]);

        if ($v->fails()) {
            return $this->toJson(null, 400, $v->messages()->first(), false);
        }

        $request->user()->update([
            'password' => Hash::make($request->password)
        ]);

        return $this->toJson(null, 200, "Password has been successfully changed", true);
    }

    public function syncDataToUser($token = null, $user_id = null)
    {
        if ($token && $user_id) {
            return  Wishlist::where('token', $token)->update(['user_id' => $user_id]);
        }

        return false;
    }
}
