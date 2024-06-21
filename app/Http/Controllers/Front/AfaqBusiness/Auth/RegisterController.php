<?php

namespace App\Http\Controllers\Front\AfaqBusiness\Auth;

use App\Http\Controllers\Controller;
use App\Models\ContentCategory;
use App\Models\User;
use App\Notifications\VerifyUserNotification;
use App\Providers\RouteServiceProvider;
use Carbon\Carbon;
use Illuminate\Auth\Events\Registered;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;
    // protected $redirectTo = '/events-registeration';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }
    /**
     *
     * NewRegister
     */
    public function registration()
    {
        $ContentCategory = ContentCategory::where('type', 'Business')->get();

        return view('frontend.business.auth.register',compact('ContentCategory'));

    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        if(is_array($data['phone'])){
            $data['phone'] = isset($data['phone']['full_number']) ? $data['phone']['full_number'] : null;
        }
        return Validator::make($data, [
            'email'    => [
                'required', 'string', 'email', 'max:255',
                Rule::unique('users')->whereNull('deleted_at')
            ],
            'password' => 'required|string|min:6|confirmed',
            'full_name_en' => ['string', 'min:3', 'max:100', 'required',],
            'full_name_ar' => ['string',  'min:3', 'max:100', 'required',],
            'phone' => ['string', 'required','min:6','max:14', Rule::unique('users')->whereNull('deleted_at')],
            'gender' => ['string', 'required',],
            'sub_specialty_id' => ['required'],
            'specialty_id' => ['required'],
            'nationality_id' => ['required'],
            'name_title' => ['required'],
            'terms' => ['required'],
            'privacy' => ['required'],
            'attend' => ['required'],
            'contract' => ['required'],

            //            'occupational_classification_number' => ['nullable', 'required_if:specialty_id,2', 'required_if:specialty_id,1'],
            // 'identity_number' => [Rule::requiredIf(request('identity_type') != 'non_resident')],
            // 'identity_type' => ['required', 'in:national_id,resident_id,passport,non_resident'],
//            'occupational_classification_number'=>  [Rule::requiredIf(request('specialty_id') != '5')],

        ], [], [
            'gender' => __('frontend.register.gender'),
            'occupational_classification_number' => __('frontend.register.occupational_classification_number'),
            'email' => __('frontend.register.Email'),
            'phone' => __('frontend.register.Phone Number'),
            'password' =>  __('frontend.register.Password'),
            'password_confirmation' => trans('frontend.register.Password confirmation')
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $request)
    {
        $role_id = 3;

        $request['approved'] = 1;
        $request['status'] = 'Unverified';
        $request['verified'] = 1;
        $request['verified_at'] = Carbon::now()->format(config('panel.date_format') . ' ' . config('panel.time_format'));
        $request['name'] = Str::slug($request['full_name_en']);
        if(is_array($request['phone'])){
            $request['phone'] = isset($request['phone']['full_number']) ? $request['phone']['full_number'] : null;
        }
        $user = User::create($request);
        $user->roles()->sync([$role_id]);

        if (isset($request['personal_photo'])) {
            $user->addMedia(storage_path('tmp/uploads/' . $request['personal_photo']))->toMediaCollection('personal_photo');
        }
        // $user->notify(new VerifyUserNotification($user));
        return $user;
    }

    // KG 27/01 Start
    public function eventsRegisteration()
    {
        return view('auth/login');
    }

    public function __getCountryCode()
    {
        if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
            $ip = $_SERVER['HTTP_CLIENT_IP'];
        } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        } else {
            $ip = $_SERVER['REMOTE_ADDR'];
        }
        $ip_data = @json_decode(file_get_contents("http://www.geoplugin.net/json.gp?ip=" . $ip));
        $code = !empty($ip_data->geoplugin_countryCode) ? $ip_data->geoplugin_countryCode : 'EG';
        if (!empty($code)) {
            return $code;
        }
        return "EG";
    }
    // KG 27/01 End

    public function register(Request $request)
    {
        $this->validator($request->all())->validate();

        event(new Registered($user = $this->create($request->all())));

        $this->guard()->login($user);

        if ($response = $this->registered($request, $user)) {
            return $response;
        }

        return redirect($this->redirectPath())->with('message',  app()->getLocale() == 'en' ? 'Check Your Mail To Activate this account.' : 'قم بمراجه البريد الالكتروني الخاص بك لتفعيل الحساب ');
    }
}
