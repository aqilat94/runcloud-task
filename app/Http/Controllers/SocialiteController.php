<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;

class SocialiteController extends Controller
{
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }
    
    public function handleGoogleCallback()
    {
        try {
            $user = Socialite::driver('google')->user();

        } catch (\Exception $e) {
            return redirect('/login');
        }

        // check if they're an existing user
        $existingUser = User::where('email', $user->email)->first();
        if($existingUser){ 
            // log them in
            auth()->login($existingUser, true);
        } else {
            // create a new user
            $newUser                  = new User;
            $newUser->name            = $user->name;
            $newUser->email           = $user->email;
            $newUser->google_id       = $user->id;
            $newUser->password        = '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi';
            // $newUser->avatar          = $user->avatar;
            // $newUser->avatar_original = $user->avatar_original;
            $newUser->save();
            auth()->login($newUser, true);
        }
        return redirect()->to('/home');
    }
}
