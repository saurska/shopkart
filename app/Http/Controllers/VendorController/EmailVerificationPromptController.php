<?php

namespace App\Http\Controllers\VendorController;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class EmailVerificationPromptController extends Controller
{
        /**
     * Display the email verification prompt.
     */
    public function __invoke(Request $request): RedirectResponse|Response
    {
        return $request->vendor()->hasVerifiedEmail()
                    ? redirect()->intended(RouteServiceProvider::VENDOR_HOME)
                    : Inertia::render('Auth/VerifyEmail', ['status' => session('status')]);
    }
}
