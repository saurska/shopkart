<?php

namespace App\Http\Controllers\VendorAuth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class EmailVerificationNotificationController extends Controller
{
   
    public function store(Request $request): RedirectResponse
    {
    {
        if ($request->vendor()->hasVerifiedEmail()) {
            return redirect()->intended(RouteServiceProvider::HOME);
        }

        $request->vendor()->sendEmailVerificationNotification();

        return back()->with('status', 'verification-link-sent');  
    }
}

   
}
