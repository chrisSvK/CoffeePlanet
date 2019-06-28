<?php

namespace App\Http\Controllers;

use App\Atribut;
use App\Produkt;
use App\Kategoria;
use App\Galeria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        /*$productList = Produkt::all()->where('kategoria_id','>', '2');*/
        $productList = Produkt::all();
        $kategoria = Kategoria::all();
        $data['productList'] = $productList;
        $data['kategoria'] = $kategoria;
        return view('produkt.index')->with('data',
            $data);
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
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $product = Produkt::create(['name' => $request->name, 'popis' => $request->popis, 'kategoria_id' => $request->kategoria_id,
            'datum_pridania' => date("Y-m-d"), 'pocet_objednani' => 0]);
        Atribut::create(['produkt_id' => $product->produkt_id, 'atribut' => $request->atribut,
            'value' => $request->atributValue, 'cena' => $request->cena, 'pocet' => $request->pocet]);
        return response()->json(['produkt_id' => $product->produkt_id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Produkt $product
     * @return \Illuminate\Http\Response
     */
    public function show(Produkt $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Produkt $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Produkt $product)
    {
        $atribut = Atribut::where('produkt_id', $product->produkt_id)->first();
        return response()->json(array($product, $atribut));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Produkt $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Produkt $product)
    {
        $atribut = Atribut::where('produkt_id', $product->produkt_id)->first();
        $product->name = $request->name;
        $product->popis = $request->popis;
        $product->kategoria_id = $request->kategoria_id;
        $atribut->atribut = $request->atribut;
        $atribut->value = $request->atributValue;
        $atribut->cena = $request->cena;
        $atribut->pocet = $request->pocet;
        $product->save();
        $atribut->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Produkt $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Produkt $product)
    {
        $product->delete();
        return response()->json(['status'=>'success','msg' => 'Product deleted successfully']);
    }

    public function produkt(Request $request, $id){
        $produkt = Produkt::where('produkt_id', $id)->first();
        $galeria = Galeria::where('produkt_id',$produkt->produkt_id);
        $atributy['atributy'] = Atribut::where('produkt_id',$produkt->produkt_id)->get();
        if($produkt->kategoria_id == 1) $kategoria='Káva->Mleta';
        if($produkt->kategoria_id == 2) $kategoria='Káva->Zrnkova';
        if($produkt->kategoria_id == 3) $kategoria='Káva->Kapsule';
        if($produkt->kategoria_id == 5) $kategoria='Čaj->Čierny';
        if($produkt->kategoria_id == 6) $kategoria='Čaj->Zeleny';
        if($produkt->kategoria_id == 7) $kategoria='Čaj->Ovocny';
        if($produkt->kategoria_id == 8) $kategoria='Čaj->Bylinkovy';
        if($produkt->kategoria_id == 9) $kategoria='Prislušenstvo';
        return view('produkt.produkt')->with('produkt',$produkt)->with('galeria',$galeria)->with('kategoria',$kategoria)->with('atributy',$atributy);
    }


    public function mleta(Request $request)
    {
        $mode='mleta';
        if ($request->query('filterOption')) {
            $filterOption = $request->query('filterOption');
            $priceRange = $request->query('priceRange');
            $value = "";
            $order = "";
            if (!strcmp('filter1', $filterOption)){ $value = 'name'; $order = 'asc';}
            if (!strcmp('filter2', $filterOption)){ $value = 'name'; $order = 'desc';}
            if(!strcmp('filter3', $filterOption)){ $value='cena';  $order='asc';}
            if(!strcmp('filter4', $filterOption)){ $value='cena';  $order='desc';}
            if (!strcmp('filter5', $filterOption)){ $value = 'datum_pridania'; $order = 'desc';}
            if (!strcmp('filter6', $filterOption)){ $value = 'datum_pridania'; $order = 'asc';}
            if (!strcmp('filter7', $filterOption)){ $value = 'pocet_objednani'; $order = 'desc';}


            $productList = Produkt::where([['kategoria_id', '1'],['cena', '<=',$priceRange]])->join('atribut','produkt.produkt_id', '=', 'atribut.produkt_id')->orderBy($value, $order)->Paginate(6);

            $galeria = Galeria::all();
            $data['productList'] = $productList;
            $data['galeria'] = $galeria;
            return view('produkt.produkty')->with('data', $data)->with('filterOption', $filterOption)->with('priceRange', $priceRange)->with('mode',$mode)->with('kategoria','Káva->Mleta');
        } else {
            $productList = Produkt::where('kategoria_id', '1')->Paginate(6);
            $galeria = Galeria::all();
            $data['productList'] = $productList;
            $data['galeria'] = $galeria;
        }
        return view('produkt.produkty')->with('filterOption', '')->with('priceRange', '')->with('data', $data)->with('mode',$mode)->with('kategoria','Káva->Mleta');
    }

    public function zrnkova(Request $request)
    {
        $mode='zrnkova';
        if ($request->query('filterOption')) {
            $filterOption = $request->query('filterOption');
            $priceRange = $request->query('priceRange');
            $value = "";
            $order = "";
            if (!strcmp('filter1', $filterOption)){ $value = 'name'; $order = 'asc';}
            if (!strcmp('filter2', $filterOption)){ $value = 'name'; $order = 'desc';}
            if(!strcmp('filter3', $filterOption)){ $value='cena';  $order='asc';}
            if(!strcmp('filter4', $filterOption)){ $value='cena';  $order='desc';}
            if (!strcmp('filter5', $filterOption)){ $value = 'datum_pridania'; $order = 'desc';}
            if (!strcmp('filter6', $filterOption)){ $value = 'datum_pridania'; $order = 'asc';}
            if (!strcmp('filter7', $filterOption)){ $value = 'pocet_objednani'; $order = 'desc';}


            $productList = Produkt::where([['kategoria_id', '2'],['cena', '<=',$priceRange]])->join('atribut','produkt.produkt_id', '=', 'atribut.produkt_id')->orderBy($value, $order)->Paginate(6);

            $galeria = Galeria::all();
            $data['productList'] = $productList;
            $data['galeria'] = $galeria;
            return view('produkt.produkty')->with('data', $data)->with('filterOption', $filterOption)->with('priceRange', $priceRange)->with('mode',$mode)->with('kategoria','Káva->Zrnkova');
        } else {
            $productList = Produkt::where('kategoria_id', '2')->Paginate(6);
            $galeria = Galeria::all();
            $data['productList'] = $productList;
            $data['galeria'] = $galeria;
        }
        return view('produkt.produkty')->with('filterOption', '')->with('priceRange', '')->with('data', $data)->with('mode',$mode)->with('kategoria','Káva->Zrnkova');
    }

    public function kapsule(Request $request)
    {
        $mode='kapsule';
        if ($request->query('filterOption')) {
            $filterOption = $request->query('filterOption');
            $priceRange = $request->query('priceRange');
            $value = "";
            $order = "";
            if (!strcmp('filter1', $filterOption)){ $value = 'name'; $order = 'asc';}
            if (!strcmp('filter2', $filterOption)){ $value = 'name'; $order = 'desc';}
            if(!strcmp('filter3', $filterOption)){ $value='cena';  $order='asc';}
            if(!strcmp('filter4', $filterOption)){ $value='cena';  $order='desc';}
            if (!strcmp('filter5', $filterOption)){ $value = 'datum_pridania'; $order = 'desc';}
            if (!strcmp('filter6', $filterOption)){ $value = 'datum_pridania'; $order = 'asc';}
            if (!strcmp('filter7', $filterOption)){ $value = 'pocet_objednani'; $order = 'desc';}


            $productList = Produkt::where([['kategoria_id', '3'],['cena', '<=',$priceRange]])->join('atribut','produkt.produkt_id', '=', 'atribut.produkt_id')->orderBy($value, $order)->Paginate(6);

            $galeria = Galeria::all();
            $data['productList'] = $productList;
            $data['galeria'] = $galeria;
            return view('produkt.produkty')->with('data', $data)->with('filterOption', $filterOption)->with('priceRange', $priceRange)->with('mode',$mode)->with('kategoria','Káva->Kapsule');
        } else {
            $productList = Produkt::where('kategoria_id', '3')->Paginate(6);
            $galeria = Galeria::all();
            $data['productList'] = $productList;
            $data['galeria'] = $galeria;
        }
        return view('produkt.produkty')->with('filterOption', '')->with('priceRange', '')->with('data', $data)->with('mode',$mode)->with('kategoria','Káva->Kapsule');
    }

    public function cierny(Request $request)
    {
        $mode='cierny';
        if ($request->query('filterOption')) {
            $filterOption = $request->query('filterOption');
            $priceRange = $request->query('priceRange');
            $value = "";
            $order = "";
            if (!strcmp('filter1', $filterOption)){ $value = 'name'; $order = 'asc';}
            if (!strcmp('filter2', $filterOption)){ $value = 'name'; $order = 'desc';}
            if(!strcmp('filter3', $filterOption)){ $value='cena';  $order='asc';}
            if(!strcmp('filter4', $filterOption)){ $value='cena';  $order='desc';}
            if (!strcmp('filter5', $filterOption)){ $value = 'datum_pridania'; $order = 'desc';}
            if (!strcmp('filter6', $filterOption)){ $value = 'datum_pridania'; $order = 'asc';}
            if (!strcmp('filter7', $filterOption)){ $value = 'pocet_objednani'; $order = 'desc';}


            $productList = Produkt::where([['kategoria_id', '5'],['cena', '<=',$priceRange]])->join('atribut','produkt.produkt_id', '=', 'atribut.produkt_id')->orderBy($value, $order)->Paginate(6);

            $galeria = Galeria::all();
            $data['productList'] = $productList;
            $data['galeria'] = $galeria;
            return view('produkt.produkty')->with('data', $data)->with('filterOption', $filterOption)->with('priceRange', $priceRange)->with('mode',$mode)->with('kategoria','Čaj->Čierny');
        } else {
            $productList = Produkt::where('kategoria_id', '5')->Paginate(6);
            $galeria = Galeria::all();
            $data['productList'] = $productList;
            $data['galeria'] = $galeria;
        }
        return view('produkt.produkty')->with('filterOption', '')->with('priceRange', '')->with('data', $data)->with('mode',$mode)->with('kategoria','Čaj->Čierny');
    }

    public function zeleny(Request $request)
    {
        $mode='zeleny';
        if ($request->query('filterOption')) {
            $filterOption = $request->query('filterOption');
            $priceRange = $request->query('priceRange');
            $value = "";
            $order = "";
            if (!strcmp('filter1', $filterOption)){ $value = 'name'; $order = 'asc';}
            if (!strcmp('filter2', $filterOption)){ $value = 'name'; $order = 'desc';}
            if(!strcmp('filter3', $filterOption)){ $value='cena';  $order='asc';}
            if(!strcmp('filter4', $filterOption)){ $value='cena';  $order='desc';}
            if (!strcmp('filter5', $filterOption)){ $value = 'datum_pridania'; $order = 'desc';}
            if (!strcmp('filter6', $filterOption)){ $value = 'datum_pridania'; $order = 'asc';}
            if (!strcmp('filter7', $filterOption)){ $value = 'pocet_objednani'; $order = 'desc';}


            $productList = Produkt::where([['kategoria_id', '6'],['cena', '<=',$priceRange]])->join('atribut','produkt.produkt_id', '=', 'atribut.produkt_id')->orderBy($value, $order)->Paginate(6);

            $galeria = Galeria::all();
            $data['productList'] = $productList;
            $data['galeria'] = $galeria;
            return view('produkt.produkty')->with('data', $data)->with('filterOption', $filterOption)->with('priceRange', $priceRange)->with('mode',$mode)->with('kategoria','Čaj->Zelený');
        } else {
            $productList = Produkt::where('kategoria_id', '6')->Paginate(6);
            $galeria = Galeria::all();
            $data['productList'] = $productList;
            $data['galeria'] = $galeria;
        }
        return view('produkt.produkty')->with('filterOption', '')->with('priceRange', '')->with('data', $data)->with('mode',$mode)->with('kategoria','Čaj->Zelený');
    }

    public function ovocny(Request $request)
    {
        $mode='ovocny';
        if ($request->query('filterOption')) {
            $filterOption = $request->query('filterOption');
            $priceRange = $request->query('priceRange');
            $value = "";
            $order = "";
            if (!strcmp('filter1', $filterOption)){ $value = 'name'; $order = 'asc';}
            if (!strcmp('filter2', $filterOption)){ $value = 'name'; $order = 'desc';}
            if(!strcmp('filter3', $filterOption)){ $value='cena';  $order='asc';}
            if(!strcmp('filter4', $filterOption)){ $value='cena';  $order='desc';}
            if (!strcmp('filter5', $filterOption)){ $value = 'datum_pridania'; $order = 'desc';}
            if (!strcmp('filter6', $filterOption)){ $value = 'datum_pridania'; $order = 'asc';}
            if (!strcmp('filter7', $filterOption)){ $value = 'pocet_objednani'; $order = 'desc';}


            $productList = Produkt::where([['kategoria_id', '7'],['cena', '<=',$priceRange]])->join('atribut','produkt.produkt_id', '=', 'atribut.produkt_id')->orderBy($value, $order)->Paginate(6);

            $galeria = Galeria::all();
            $data['productList'] = $productList;
            $data['galeria'] = $galeria;
            return view('produkt.produkty')->with('data', $data)->with('filterOption', $filterOption)->with('priceRange', $priceRange)->with('mode',$mode)->with('kategoria','Čaj->Ovocný');
        } else {
            $productList = Produkt::where('kategoria_id', '7')->Paginate(6);
            $galeria = Galeria::all();
            $data['productList'] = $productList;
            $data['galeria'] = $galeria;
        }
        return view('produkt.produkty')->with('filterOption', '')->with('priceRange', '')->with('data', $data)->with('mode',$mode)->with('kategoria','Čaj->Ovocný');
    }

    public function bylinkovy(Request $request)
    {
        $mode='bylinkovy';
        if ($request->query('filterOption')) {
            $filterOption = $request->query('filterOption');
            $priceRange = $request->query('priceRange');
            $value = "";
            $order = "";
            if (!strcmp('filter1', $filterOption)){ $value = 'name'; $order = 'asc';}
            if (!strcmp('filter2', $filterOption)){ $value = 'name'; $order = 'desc';}
            if(!strcmp('filter3', $filterOption)){ $value='cena';  $order='asc';}
            if(!strcmp('filter4', $filterOption)){ $value='cena';  $order='desc';}
            if (!strcmp('filter5', $filterOption)){ $value = 'datum_pridania'; $order = 'desc';}
            if (!strcmp('filter6', $filterOption)){ $value = 'datum_pridania'; $order = 'asc';}
            if (!strcmp('filter7', $filterOption)){ $value = 'pocet_objednani'; $order = 'desc';}


            $productList = Produkt::where([['kategoria_id', '8'],['cena', '<=',$priceRange]])->join('atribut','produkt.produkt_id', '=', 'atribut.produkt_id')->orderBy($value, $order)->Paginate(6);

            $galeria = Galeria::all();
            $data['productList'] = $productList;
            $data['galeria'] = $galeria;
            return view('produkt.produkty')->with('data', $data)->with('filterOption', $filterOption)->with('priceRange', $priceRange)->with('mode',$mode)->with('kategoria','Čaj->Bylinkový');
        } else {
            $productList = Produkt::where('kategoria_id', '8')->Paginate(6);
            $galeria = Galeria::all();
            $data['productList'] = $productList;
            $data['galeria'] = $galeria;
        }
        return view('produkt.produkty')->with('filterOption', '')->with('priceRange', '')->with('data', $data)->with('mode',$mode)->with('kategoria','Čaj->Bylinkový');
    }

    public function prislusenstvo(Request $request)
    {
        $mode='prislusenstvo';
        if ($request->query('filterOption')) {
            $filterOption = $request->query('filterOption');
            $priceRange = $request->query('priceRange');
            $value = "";
            $order = "";
            if (!strcmp('filter1', $filterOption)){ $value = 'name'; $order = 'asc';}
            if (!strcmp('filter2', $filterOption)){ $value = 'name'; $order = 'desc';}
            if(!strcmp('filter3', $filterOption)){ $value='cena';  $order='asc';}
            if(!strcmp('filter4', $filterOption)){ $value='cena';  $order='desc';}
            if (!strcmp('filter5', $filterOption)){ $value = 'datum_pridania'; $order = 'desc';}
            if (!strcmp('filter6', $filterOption)){ $value = 'datum_pridania'; $order = 'asc';}
            if (!strcmp('filter7', $filterOption)){ $value = 'pocet_objednani'; $order = 'desc';}


            $productList = Produkt::where([['kategoria_id', '9'],['cena', '<=',$priceRange]])->join('atribut','produkt.produkt_id', '=', 'atribut.produkt_id')->orderBy($value, $order)->Paginate(6);

            $galeria = Galeria::all();
            $data['productList'] = $productList;
            $data['galeria'] = $galeria;
            return view('produkt.produkty')->with('data', $data)->with('filterOption', $filterOption)->with('priceRange', $priceRange)->with('mode',$mode)->with('kategoria','Príslušenstvo');
        } else {
            $productList = Produkt::where('kategoria_id', '9')->Paginate(6);
            $galeria = Galeria::all();
            $data['productList'] = $productList;
            $data['galeria'] = $galeria;
        }
        return view('produkt.produkty')->with('filterOption', '')->with('priceRange', '')->with('data', $data)->with('mode',$mode)->with('kategoria','Príslušenstvo');
    }

    public function list($page) {
        // get rowsPerPage from query parameters (after ?), if not set => 5
        $rowsPerPage = request('rowsPerPage', 5);

        // get sortBy from query parameters (after ?), if not set => name
        $sortBy = request('sortBy', 'name');

        // get descending from query parameters (after ?), if not set => false
        $descendingBool = request('descending', 'false');
        // convert descending true|false -> desc|asc
        $descending = $descendingBool === 'true' ? 'desc' : 'asc';

        // pagination
        // IFF rowsPerPage == 0, load ALL rows
        if ($rowsPerPage == 0) {
            // load all products from DB
            $products = DB::table('produkt')
                ->orderBy($sortBy, $descending)
                ->get();
        } else {
            $offset = ($page - 1) * $rowsPerPage;

            // load products from DB
            $products = DB::table('produkt')
                ->orderBy($sortBy, $descending)
                ->offset($offset)
                ->limit($rowsPerPage)
                ->get();
        }

        // total number of rows -> for quasar data table pagination
        $rowsNumber = DB::table('produkt')->count();

        return response()->json(['rows' => $products, 'rowsNumber' => $rowsNumber]);
    }
}
