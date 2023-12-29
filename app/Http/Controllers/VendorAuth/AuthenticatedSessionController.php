<?php

namespace App\Http\Controllers\VendorAuth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Vendorauth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Inertia\Response;
use Socialite;

class AuthenticatedSessionController extends Controller
{
    
    public function create(): Response
    {
        return Inertia::render('VendorAuth/Login', [
            'canResetPassword' => Route::has('password.request'),
            'status' => session('status'),
        ]);
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(LoginRequest $request)
    {
        $request->authenticate();

        $request->session()->regenerate();

        return redirect()->intended(RouteServiceProvider::VENDOR_HOME);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request): Request
    {
        Auth::guard('vendor')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
    // Google functions 
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }
    public function handleGoogleCallback()
    {
        $vendor = Socialite::driver('google')->vendor();

        // Check if the user exists in your database
        $existingVendor = Vendor::where('email', $vendor->email)->first();

        if ($existingVendor) {
            // If the vendor exists, log them in
            Auth::login($existingVendor);
        } else {
            // If the user doesn't exist, you might want to create a new account
            // For example:
            $newVendor = Vendor::create([
                'name' => $vendor->name,
                'email' => $vendor->email,
                // Other fields you may want to save
            ]);

            // Log in the newly created vendor
            Auth::login($newVendor);
        }

        return redirect()->route('vendor/dashboard'); // Redirect the vendor after login
    }


}
