<?php

namespace App\Http\Controllers;

use App\Zakaznik;
use App\Adresa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ZakaznikController extends Controller
{

    public function create(Request $request)
    {
        $validator = ($request->validate([
            'meno' => 'required',
            'priezvisko' => 'required',
            'email' => 'required|email',
            'datumNarodenia' => 'required|date',
            'mesto' => 'required',
            'ulica' => 'required',
            'psc' => 'required|numeric',
            'mobil' => 'required|numeric',
            'password' => 'required',
            'password2' => 'required|same:password'
        ]));

        $adresa = Adresa::create(['mesto' => $request->mesto, 'ulica' => $request->ulica, 'psc' => $request->psc]);

        $zakaznik = Zakaznik::create(['meno' => $request->meno, 'priezvisko' => $request->priezvisko,
            'password' =>  Hash::make($request->password) , 'login' => $request->email, 'datum_narodenia' => $request->datumNarodenia,
            'mobil_number' => $request->mobil, 'email' => $request->email, 'datum_registracie' => date("Y-m-d"), 'adresa_id' => $adresa->adresa_id]);



        auth()->login($zakaznik);

        return redirect()->to('/');
    }

    public function login(Request $request){
        return view('login');
    }

}
