<?php

namespace App\Http\Controllers\Auth;

use App\Contracts\UserRepositoryInterface;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;
use Symfony\Component\HttpFoundation\RedirectResponse as SymfonyRedirectResponse;

class GoogleLoginController extends Controller
{

    /**
     * Create class.
     *
     * @param \App\Contracts\UserRepositoryInterface $userRepository
     */
    public function __construct(private UserRepositoryInterface $userRepository)
    {
    }

    /**
     * Redirect to Google auth.
     *
     * @return SymfonyRedirectResponse
     */
    public function redirect(): SymfonyRedirectResponse
    {
        return Socialite::driver('google')->redirect();
    }

    /**
     * Callback for user authentication via Google OAuth.
     *
     * @return RedirectResponse
     */
    public function callback(): RedirectResponse
    {
        try {
            $google_user = Socialite::driver('google')->user();
            $user = $this->userRepository->findUserByGoogleId($google_user->getId());

            if ($user) {
                Auth::login($user);
                return redirect('/');
            }
            else {
                $newUser = $this->userRepository->createUser([
                    'name' => $google_user->getName(),
                    'email' => $google_user->getEmail(),
                    'google_id'=> $google_user->getId(),
                    'password' => Hash::make(Str::random(8))
                ]);

                Auth::login($newUser);
                return redirect('/');
            }
        } catch (\Exception $e) {
            dd($e->getMessage());
        }
    }

}
