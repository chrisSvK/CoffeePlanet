<?php

namespace App\Http\Controllers;
use App\Produkt;
use App\Kategoria;
use App\Galeria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $productList = DB::table('produkt')->join('atribut','produkt.produkt_id', '=', 'atribut.produkt_id')->get();

        $kategoria = Kategoria::all();
        $galeria= Galeria::all();
        $data['productList']=$productList;
        $data['kategoria']=$kategoria;
        $data['galeria']=$galeria;
        return view('home')->with('data',
            $data);
    }

}
