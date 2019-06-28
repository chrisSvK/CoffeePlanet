@extends('layouts.app')

@section('title','Coffee Planer - Doprava')

@push('css')
    <link rel="stylesheet" type="text/css" href="/css/doprava.css">
@endpush

@section('content')
    <section id="navigation">
        Košík>Doprava><span style="color: gray; font-size: 14px ">Spôsob Platby>Sumarizácia</span>
    </section>
    <form action="kosik" id="form2"></form>
    <form action="platba" method="POST" id="form1">
        <section id="obsahDoprava">
            <input type="radio" name="doprava" {{--value="Odber na pobočke"--}} value="1" checked> Osobný odber na pobočke <span
                    style="float: right; margin-right: 20px">+0€</span>
            <select>
                <option value="pobocka1">Bánovce n. Bebravou, Trenčianska cesta 59</option>
                <option value="pobocka2">Banská Bystrica, Robotnícka 6</option>
                <option value="pobocka3">Bratislava, Borská 1</option>
                <option value="pobocka4">Bratislava, Blagoevova 16</option>
            </select>
            <input type="radio" name="doprava" {{--value="Kuriér"--}} value="2"> Kuriér <span
                    style="float: right; margin-right: 20px">+2.5€</span><br>

            @if( auth()->check() )
                Meno:
                <input type="text" id="meno" name="meno" value="{{auth()->user()->meno}}">
                Priezvisko:
                <input type="text" id="priezvisko" name="priezvisko" value="{{auth()->user()->priezvisko}}">
                Mesto:
                <input type="text" id="mesto" name="mesto" value="{{auth()->user()->adresa->mesto}}">
                Ulica, č. domu:
                <input type="text" id="ulica" name="ulica" value="{{auth()->user()->adresa->ulica}}">
                PSČ:
                <input type="text" id="psc" name="psc" value="{{auth()->user()->adresa->psc}}">
            @else
                Meno:
                <input type="text" id="meno" name="meno">
                Priezvisko:
                <input type="text" id="priezvisko" name="priezvisko">
                Mesto:
                <input type="text" id="mesto" name="mesto">
                Ulica, č. domu:
                <input type="text" id="ulica" name="ulica">
                PSČ:
                <input type="text" id="psc" name="psc">
            @endif

            <div id="buttons">
                <button id="back" form="form2">Späť na košík</button>
                <button id="doprava" form="form1">Platba</button>
            </div>
        </section>
    </form>
@stop
