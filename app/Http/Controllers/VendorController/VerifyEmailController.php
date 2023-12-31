<?php

namespace App\Http\Controllers\VendorController;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Verified;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\RedirectResponse;

class VerifyEmailController extends Controller
{
     /**
     * Mark the authenticated vendor's email address as verified.
     */
    public function __invoke(EmailVerificationRequest $request): RedirectResponse
    {
        if ($request->vendor()->hasVerifiedEmail()) {
            return redirect()->intended(RouteServiceProvider::VENDOR_HOME.'?verified=1');
        }

        if ($request->vendor()->markEmailAsVerified()) {
            event(new Verified($request->vendor()));
        }

        return redirect()->intended(RouteServiceProvider::VENDOR_HOME.'?verified=1');
    }
}
