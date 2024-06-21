<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Events\PopUserNotification;
use App\Notifications\RealTimeNotification;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers {
        logout as performLogout;
    }

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }


    public function showLoginForm()
    {
        session(['link' => url()->previous()]);
        return view('auth.login');
    }


    protected function authenticated(Request $request, $user)
    {
        if (!$user->hasVerifiedEmail()) {
            Auth::logout();
            return view('auth.login',[
                'message' =>  app()->getLocale() == 'en' ? 'Check Your Mail To Activate this account.' : 'قم بمراجه البريد الالكتروني الخاص بك لتفعيل الحساب '
            ]);
        }

        return redirect()->intended($this->redirectPath());
    }


    /**
     * Redirect the user to the Google authentication page.
     *
     * @return \Illuminate\Http\Response
     */
    public function redirectToProvider()
    {
        return \Socialite::driver('google')->redirect();
    }

    /**
     * Obtain the user information from Google.
     *
     * @return \Illuminate\Http\Response
     */
    public function handleProviderCallback()
    {
        try {
            $user = \Socialite::driver('google')->user();
        } catch (\Exception $e) {
            return redirect('/login');
        }
        // only allow people with @company.com to login
        if (explode("@", $user->email)[1] !== 'company.com') {
            return redirect()->to('/');
        }
        // check if they're an existing user
        $existingUser = User::where('email', $user->email)->first();
        if ($existingUser) {
            // log them in
            auth()->login($existingUser, true);
            // $data =[
            //     'user_id' => $user->id,
            //     'message' => 'login successfully 😄',
            //     'title_en' => 'login',
            //     'title_ar' => 'تسجيل الدخول',
            //     'message_en' => 'login',
            //     'message_ar' => 'تسجيل الدخو',
            //     'type' => 'user',
            //     'parent_id' => null,
            // ];

        } else {
            // create a new user
            $newUser                  = new User();
            $newUser->name            = $user->name;
            $newUser->email           = $user->email;
            $newUser->google_id       = $user->id;
            $newUser->avatar          = $user->avatar;
            $newUser->avatar_original = $user->avatar_original;
            $newUser->save();
            auth()->login($newUser, true);
        //     $user = $newUser;
        //     $data =[
        //         'user_id' => $user->id,
        //         'message' => 'welcome in our world! 😄',
        //         'title_en' => 'login',
        //         'title_ar' => 'تسجيل الدخول',
        //         'message_en' => 'login',
        //         'message_ar' => 'تسجيل الدخو',
        //         'type' => 'user',
        //         'parent_id' => null,
        //     ];
        // }

        // event(new PopUserNotification($data));
        // $user->notify( new RealTimeNotification($data));

        return redirect()->to('/home');
    }
    // public function logout(Request $request)
    // {
    //     $this->guard()->logout();

    //     $request->session()->invalidate();

    //     $request->session()->regenerateToken();

    //     if ($response = $this->loggedOut($request)) {
    //         return $response;
    //     }

    //     return $request->wantsJson()
    //         ? new JsonResponse([], 204)
    //         : redirect(app()->getLocale());
     }
    public function logout(Request $request)
    {
        $this->performLogout($request);
        return redirect()->back();
    }

    protected function sendFailedLoginResponse(Request $request)
    {
        $user = Auth::attempt(['email' => $request->email, 'password' => $request->password]);

        if ($user && !$user->hasVerifiedEmail()) {
            return view('auth.login',[
                'message' =>  app()->getLocale() == 'en' ? 'Check Your Mail To Activate this account.' : 'قم بمراجه البريد الالكتروني الخاص بك لتفعيل الحساب '
            ]);
        }

        throw ValidationException::withMessages([
            $this->username() => [trans('auth.failed')],
        ]);
    }
}
