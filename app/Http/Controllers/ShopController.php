<?php

namespace App\Http\Controllers;

use App\Atribut;
use App\Produkt;
use App\Kategoria;
use App\Galeria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ShopController extends Controller
{

    public function kosik(){
        return view('kosik');
    }

}
