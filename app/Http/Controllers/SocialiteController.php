<?php

namespace App\Http\Controllers;

use App\Models\Nerd;
use App\Models\User;
use Exception;
use GuzzleHttp\Exception\ClientException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;
use Laravel\Socialite\Two\InvalidStateException;

class SocialiteController extends Controller
{
    public function redirect($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    public function callback($provider)
    {
        // https://laravel.com/docs/9.x/socialite#retrieving-user-details
        $visitor = null;

        try {
            $visitor = Socialite::driver($provider)->user();
        } catch (InvalidStateException $e) {
            try {
                $visitor = Socialite::driver($provider)->stateless()->user();
            } catch (ClientException $e) {
                $visitor = null;
            }
        } catch (Exception $e) {
            $visitor = null;
        }

        if (empty($visitor)) {
            abort(401, 'unauthorized');
        }

        $nerd = Nerd::updateOrCreate([
            'type' => $provider,
            'code' => $visitor->getId(),
        ], [
            'name' => $visitor->getName() ?? '',
            'nick' => $visitor->getNickname() ?? '',
            'email' => $visitor->getEmail() ?? '',
            'photo' => $visitor->getAvatar() ?? '',
            'oauth' => [
                'token' => $visitor->token ?? '',
                'tokenSecret' => $visitor->tokenSecret ?? '',
                'refreshToken' => $visitor->refreshToken ?? '',
                'expiresIn' => $visitor->expiresIn ?? 43200,
                'version' => empty($visitor->expiresIn) ? '1.0' : '2.0',
            ]
        ]);

        if (empty($nerd->email)) {
            abort(401, 'unauthorized');
        }

        $user = User::firstOrCreate([
            'email' => $nerd->email,
        ], [
            'name' => $nerd->name,
            'nick' => $nerd->nick,
            'password' => Hash::make(Str::random(32)),
        ]);

        Auth::login($user);

        return redirect('/');
    }

    public function logout(Request $request)
    {
        // https://laravel.com/docs/9.x/authentication#logging-out

        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
