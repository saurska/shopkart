<?php
namespace App\Http\Controllers\VendorController;
use App\Models\Vendor;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Inertia\Response;
use Hash;

class RegistrationController extends Controller
{

    public function create()
    {
        return Inertia::render('Auth/VendorRegister');
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|lowercase|email|max:255|unique:'.Vendor::class,
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

       //$vendor = $request->all();

        $vendor = Vendor::create([
        'name' => $vendor['name'],
        'email' => $vendor['email'],
        'password' => Hash::make($vendor['password'])
      ]);
      event(new Registered($vendor));

      Auth::login($vendor);

      return redirect(RouteServiceProvider::VENDOR_HOME);
    }

}