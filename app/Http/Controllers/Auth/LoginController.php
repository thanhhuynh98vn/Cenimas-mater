<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Laravel\Socialite\Facades\Socialite;
use App\User;
use Illuminate\Support\Facades\Auth;
use App\Models\Social;
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

    use AuthenticatesUsers{
        redirectPath as laravelRedirectPath;
    }

    public function redirectPath()
    {
        // Do your logic to flash data to session...
        session()->flash('status', 'your message');

        // Return the results of the method we are overriding that we aliased.
        return $this->laravelRedirectPath();
    }
    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/posts' ;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function redirectToProviderGoogle()
    {
        return Socialite::driver('google')->redirect();

    }

    public function handleProviderCallbackGoogle()
    {
        $user = Socialite::driver('google')->user();

        if(!$this->checkDomain($user->email)){

            session()->flash('msg', 'Email not validate!');

            return redirect('/login');
        }

        $authUser = $this->findOrCreateUser($user);
        Auth::login($authUser);
        return redirect('/posts')->with('status', 'Profile updated!');

    }

    private function findOrCreateUser($user){
        $authUser = User::where('email',$user->email)->first();

        if($authUser)
            return $authUser;

        $u = User::create([
            'name'=>$user->name,
            'email'=>$user->email,
        ]);

        $temp=new Social();
        $temp->provider_user_id=$user->id;
        $temp->provider='google';
        $temp->user_id=$u->id;
        $temp->save();

        return $u;

    }

    private function checkDomain($email){
        if(!filter_var($email, FILTER_VALIDATE_EMAIL))
            return false;

        $a = explode('@', trim($email));
        if(count($a) == 2){
            if($a[1] == 'greenglobal.vn')
                return true;
        }

        return false;

    }
}

