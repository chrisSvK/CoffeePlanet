<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Gloudemans\Shoppingcart\Facades\Cart;
use App\Objednavka;
use App\Objednane;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('kosik');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Cart::add($request->produkt_id,$request->name, $request->pocet, $request->cena )->associate('App\Produkt');
        return redirect()->route('cart.index')->with('success_message', 'Polozka vlozena do kosika');
    }

    public function doprava(Request $request){
        $adresa['mesto']=$request->mesto;
        $adresa['ulica']=$request->ulica;
        $adresa['psc']=$request->psc;
        $adresa['meno']=$request->meno;
        $adresa['priezvisko']=$request->priezvisko;
        $adresa['doprava']=$request->doprava;
        return view('platba')->with('adresa', $adresa);
    }

    public function platba(Request $request){
        $adresa['mesto']=$request->mesto;
        $adresa['ulica']=$request->ulica;
        $adresa['psc']=$request->psc;
        $adresa['platba']=$request->platba;
        $adresa['meno']=$request->meno;
        $adresa['priezvisko']=$request->priezvisko;
        $adresa['doprava']=$request->doprava;
        $adresa['platba']=$request->platba;
      return view('sumarizacia')->with('adresa', $adresa);
    }

    public function sumarizacia(Request $request){

       $objednavka = Objednavka::create(['zakaznik_id' => auth()->user()->zakaznik_id, 'fakt_adresa_id' => auth()->user()->adresa_id, 'doruc_adresa_id' => auth()->user()->adresa_id,
           'payment_method_id' => $request->platba, 'delivery_method_id' =>$request->doprava, 'datum_objednavky' => date("Y-m-d"), 'datum_dorucenia' => date('Y-m-d', strtotime("+5 days")),
           'cena' => Cart::subtotal()]);

        foreach(Cart::content() as $item){
            Objednane::create(['objednavka_id' => $objednavka->objednavka_id, 'produkt_id'=> $item->model->produkt_id, 'atribut_id'=> $item->model->atributy[0]->atribut_id,
                'mnozstvo'=> $item->qty ]);
        }

        return redirect('/');
    }

    public function empty(){
        Cart::destroy();
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Cart::remove($id);

        return back()->with('success_message', 'Produkt vymazany');
    }
}
