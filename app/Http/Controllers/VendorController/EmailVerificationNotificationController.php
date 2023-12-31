<?php

namespace App\Http\Controllers\VendorController;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class EmailVerificationNotificationController extends Controller
{
       /**
     * Send a new email verification notification.
     */
    public function store(Request $request): RedirectResponse
    {
        if ($request->vendor()->hasVerifiedEmail()) {
            return redirect()->intended(RouteServiceProvider::VENDOR_HOME);
        }

        $request->vendor()->sendEmailVerificationNotification();

        return back()->with('status', 'verification-link-sent');
    }
}
