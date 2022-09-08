<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Services\Contracts\Social;
use Illuminate\Http\RedirectResponse;
use Laravel\Socialite\Facades\Socialite;
use Symfony\Component\HttpFoundation\RedirectResponse as SymfonyRedirectResponse;
use Illuminate\Routing\Redirector;
use Illuminate\Contracts\Foundation\Application;

class SocialProvidersController extends Controller
{
    public function redirect(string $driver): SymfonyRedirectResponse | RedirectResponse
    {
        return Socialite::driver($driver)->redirect();
    }

    public function callback(string $driver, Social $social): Redirector | Application |RedirectResponse
    {
        return redirect(
            $social->loginAndGetRedirectUrl(Socialite::driver($driver)->user())
        );
    }
}
