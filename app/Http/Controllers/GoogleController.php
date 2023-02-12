<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

// i have added these
use Laravel\Socialite\Facades\Socialite;
use Exception;
use App\Models\User;
use ILLuminate\Support\Facades\Auth;
use Hash;

class GoogleController extends Controller
{
    //

    
    public function redirectToGoogle() {
        return Socialite::driver('google')->redirect();
    }

    public function hendelGoogleCallback() {
        try {
            $user = Socialite::driver('google')->user();
            $findUser = User::where('google_id',$user->id)->first();
            if($findUser) {
                // login
                Auth::login($findUser);
                return redirect()->intended('home');
            } else {
                //register
                $newUser = User::create([
                    'name'=>$user->name,
                    'email'=>$user->email,
                    'google_id'=>$user->id,
                    'password'=>Hash::make('12345678') //Hash::make('12345678') //encrypt('12345678')
                ]);
                Auth::login($newUser);
                return redirect()->intended('home');
            }
        } catch(Exception $e) {
            dd($e->getMessage());
        }
    }
}
