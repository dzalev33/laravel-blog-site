<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class RegistrationController extends Controller
{

    public function create(){

        return view('registration.create');

    }

    public function store()
    {

        //validate
        $this->validate(request(),[

            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required|confirmed'

        ]);


        //create

        $user = User::create(request(['name', 'email', 'password']));

        //sign in

        auth()->login($user);

        return redirect()->home();
    }


}
