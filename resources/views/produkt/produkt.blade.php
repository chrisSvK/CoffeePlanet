@extends('layouts.app')

@section('title','Coffee Planer - Produkt')

@push('css')
    <link rel="stylesheet" type="text/css" href="../css/produkt.css">
@endpush

@section('content')
    <section id="navigation">
        {{--Káva>Zrnková--}}
        {{$kategoria}}
    </section>
    <section id="obsah">
        <h1>{{$produkt->name}}</h1>
        <div class="row">
            <div class="column">
                <img src="../img/{{$galeria->first()->name}}">
                <br>
                <br>
                <form action="../kosik" method="POST">
                    @if($produkt->kategoria_id!=3 && $produkt->kategoria_id!=9 )
                        <b>BALENIE</b><br>
                        @foreach($atributy['atributy'] as $atribut)
                            <input type="radio" name="value" value="value5" checked><span
                                    style="display: inline-block">{{$atribut->value}} {{$atribut->cena}} </span><br>
                        @endforeach
                    @elseif($produkt->kategoria_id==3)
                        <b>BALENIE</b><br>
                        {{--<input type="radio" name="value" value="value4"><span style="display: inline-block"> 16ks/3€</span>--}}
                        @foreach($atributy['atributy'] as $atribut)
                            <input type="radio" name="value" value="value5" checked><span
                                    style="display: inline-block">{{$atribut->value}} {{$atribut->cena}} </span><br>
                        @endforeach
                        <br>
                    @else  <b>FARBA</b><br>
                    @foreach($atributy['atributy'] as $atribut)
                        <input type="radio" name="value" value="value5" checked><span
                                style="display: inline-block">{{$atribut->value}} {{$atribut->cena}} </span><br>
                    @endforeach
                    @endif
                    <br>
                    <br>
                    <input type="text" id="pocet" name="pocet" value="1"> ks<br>
                    <br>
                    {{csrf_field()}}
                    <input type="hidden" name="produkt_id" value={{$produkt->produkt_id}}>
                    <input type="hidden" name="name" value="{{$produkt->name}}">
                    <input type="hidden" name="cena" value={{$atributy['atributy'][0]->cena}}>
                    <button id="submit" type="submit">Vložiť do košíka</button>
                </form>
            </div>
            <div class="column">
                {{$produkt->popis}}
                <br>
                <br>
                <b>Dostupnosť:</b> U dodávateľa
                <br>
                <b>Dátum doručenia:</b> 05.10.2018
            </div>
        </div>
    </section>
@stop
