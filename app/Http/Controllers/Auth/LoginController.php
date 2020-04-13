<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Paciente;
use App\Role;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Socialite;
use Auth;


use Illuminate\Support\Facades\Input;

use App\User;
use function GuzzleHttp\Psr7\str;

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

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
   /* protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'logout']);
    }
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function _construct()
    {
        $this->middleware('guest')->except('logout');
    }
    public function redirectToProvider()
    {
        return Socialite::driver('google')->redirect();
    }

    /**
     * Obtain the user information from twitter.
     *
     * @return Response
     */
    public function handleProviderCallback()
    {

            $user = Socialite::driver('google')->stateless()->user();
            $authUser = $this -> findOrCreateUser($user);
             $pass= $this -> passwor();

             Auth::login($authUser,true);

        $pacientes = Paciente::all()->where('id', (\Illuminate\Support\Facades\Auth::user()->id) - 1);
        return view('home',['pacientes'=> $pacientes]);



    }
    public function findOrCreateUser($user)
    {
        $authUser = User::where('email', $user->email)->first();
        if ($authUser) {
            return $authUser;
        }else{
            $pass=str_random(8);
            $name = Input::get('name');

           $user = User::create([

                'name' => $user->name,
                'email' => $user->email,
               'password' => $this->passwor(),




            ]);


            $user->roles()->attach(Role::where('name', 'user')->first());


            return $user;
        }

    }

    public function passwor (){

        return str_random(8);
}


/*
    public function redirectToProvider($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    /**
     * Obtain the user information from GitHub.
     *
     * @return Response

    public function handleProviderCallback($provider)
    {
        $user = Socialite::driver($provider)->stateless()->user();
        $authUser = $this -> findOrCreateUser($user,$provider);
        Auth::login($authUser,true);
        return redirect($this->redirectTo);
    }
    public function findOrCreateUser($user,$provider)
    {
        $authUser = User::where('provider_id', $user->id)->first();
        if ($authUser) {
            return $authUser;
        }
        return User::create([
            'name' => $user->name,
            'email' => $user->email,
            'provider' => strtoupper($provider),
            'provider_id' => $user->id
        ]);

    }
    */
}

