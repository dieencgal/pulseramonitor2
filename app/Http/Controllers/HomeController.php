<?php

namespace App\Http\Controllers;

use App\Paciente;
use http\Client\Curl\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
       // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        $request->user()->authorizeRoles(['user', 'admin']);


            $pacientes = Paciente::all()->where('id', (Auth::user()->id) - 1);


            return view('home',['pacientes'=>$pacientes]);

        }

        public function login2(Request $request)
        {
            request()->validate([
                'email' => 'required',
                'password' => 'required',
            ]);
            $credentials = $request->orounly('email', 'password');
        if (Auth::attempt($credentials)) {
            dd(Auth::user()->id);
        }else{
            dd('fallo');
        }
        }


}
