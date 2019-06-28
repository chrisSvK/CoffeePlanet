@extends('layouts.app')

@section('title','Coffee Planer')

@push('css')
    <link rel="stylesheet" type="text/css" href="css/main.css">
@endpush


@section('content')
    <img id="mainImg" src="img/main.jpg" alt="mainImage">
    <section class="firstSection">
        <h1>Nové produkty</h1>
        <ul>
            @foreach(($data['productList'])->sortByDesc('datum_pridania')->take(6) as $produkt)
                <li>
                    {{--<img src="img/tovar.png" alt="tovar1">--}}
                    @if($data['galeria']->where('produkt_id',$produkt->produkt_id)->count()>0)
                        <img src="img/{{$data['galeria']->where('produkt_id',$produkt->produkt_id)->first()->name}}">
                    @else <img src="img/tovar.png" alt="tovar1">
                    @endif
                    <p>{{$produkt->name}}</p>
                    @if(strcmp($produkt->atribut, 'farba')!=0)
                        <b>{{$produkt->value}}/</b>
                    @endif
                    <b>{{$produkt->cena}}€</b>
                    <br>
                    <br>
                </li>
            @endforeach
        </ul>
    </section>
    <section>
        <h1>Akcia</h1>
        <ul>
            @foreach(($data['productList'])->sortBy('cena')->take(6) as $produkt)
                <li>
                    @if($data['galeria']->where('produkt_id',$produkt->produkt_id)->count()>0)
                        <img src="img/{{$data['galeria']->where('produkt_id',$produkt->produkt_id)->first()->name}}">
                    @else <img src="img/tovar.png" alt="tovar1">
                    @endif
                        <p>{{$produkt->name}}</p>
                        @if(strcmp($produkt->atribut, 'farba')!=0)
                            <b>{{$produkt->value}}/</b>
                        @endif
                        <b>{{$produkt->cena}}€</b>
                    <br>
                    <br>
                </li>
            @endforeach
        </ul>
    </section>
    <section>
        <h1>Obľúbené</h1>
        <ul>
            @foreach(($data['productList'])->sortByDesc('pocet_objednani')->take(6) as $produkt)
                <li>
                    @if($data['galeria']->where('produkt_id',$produkt->produkt_id)->count()>0)
                        <img src="img/{{$data['galeria']->where('produkt_id',$produkt->produkt_id)->first()->name}}">
                    @else <img src="img/tovar.png" alt="tovar1">
                    @endif
                        <p>{{$produkt->name}}</p>
                        @if(strcmp($produkt->atribut, 'farba')!=0)
                            <b>{{$produkt->value}}/</b>
                        @endif
                        <b>{{$produkt->cena}}€</b>
                    <br>
                    <br>
                </li>
            @endforeach
        </ul>
    </section>
@stop
