<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class RegisteredUserController extends Controller
{

    protected $redirectTo = 'home';
    /**
     * Display the registration view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
       
        $image = $request->file('image');
       
        $storage = $image->store('public');
        $user = User::create([

          'last_name' => $request->input('last_name'),
        'first_name'=>$request->input('first_name'),
        'email' => $request->input('email'),
        'password' => Hash::make($request->password),
        'confirm_password' => Hash::make($request->password),
        'image' =>$storage,
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect('/');
    }
}

