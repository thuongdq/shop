<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;

class LoginController extends Controller
{
    /**
     * Redirect the user to the GitHub authentication page.
     *
     * @return Response
     */
    public function redirectToProvider()
    {
        return Socialite::driver('facebook')->scopes(['email'])->redirect();
    }

    /**
     * Obtain the user information from GitHub.
     *
     * @return Response
     */
    public function handleProviderCallback()
    {
        $user = Socialite::driver('facebook')->user();
        $user = User::firstOrCreate([
            'email' => $user->getEmail()
        ],[
            'name' => $user->getName(),
            'email' => $user->getEmail(),
            'password' => bcrypt($user->getId().time().$user->getEmail()),
            'avater' => $user->getAvatar()
        ]);
        auth()->login($user);
        return redirect()->route('frontend.home.index');
        // $user->token;
    }
}
