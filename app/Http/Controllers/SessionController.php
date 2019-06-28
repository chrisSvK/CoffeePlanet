<?php

namespace App\Http\Controllers;

use App\Zakaznik;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SessionController extends Controller
{

    public function store(Request $request)
    {

        if (Auth::guard('zakaznik')->attempt([ 'login'=> $request->login, 'password' => $request->password])) {
            print_r("yesss");
        } else {
            return back()->withErrors([
                'message' => 'The email or password is incorrect, please try again'
            ]);
        }
        return redirect()->to('/');
    }

    public function destroy()
    {
        auth()->logout();

        return redirect()->to('/');
    }
}
