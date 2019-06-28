@extends('layouts.app')

@section('title','Coffee Planer - Sumarizacia')

@push('css')
    <link rel="stylesheet" type="text/css" href="css/sumarizacia.css">
@endpush

@section('content')
    <section id="navigation">
        Košík>Doprava>Spôsob Platby>Sumarizácia
    </section>
    <form action="platba" method="POST" id="form2">
        <input type="hidden" id="meno" name="meno" value="{{$adresa['meno']}}">
        <input type="hidden" id="priezvisko" name="priezvisko" value="{{$adresa['priezvisko']}}">
        <input type="hidden" id="mesto" name="mesto" value="{{$adresa['mesto']}}">
        <input type="hidden" id="ulica" name="ulica" value="{{$adresa['ulica']}}">
        <input type="hidden" id="psc" name="psc" value="{{$adresa['psc']}}">
        <input type="hidden" id="doprava" name="doprava" value="{{$adresa['doprava']}}">
        <input type="hidden" id="platba" name="platba" value="{{$adresa['platba']}}">
    </form>
    <form action="sumarizacia" id="form1" method="POST">
        <section id="obsahSumarizacia">
            <table>
                <tbody>
                @foreach(Cart::content() as $item)
                    <tr>
                        <td class="product-name">{{$item->name}}</td>
                        <td class="product-amount">
                            {{$item->qty}} ks<br>
                            <b> {{$item->model->atributy[0]->cena*$item->qty}}€</b>
                        </td>
                    </tr>
                @endforeach
                <tr>
                    <td class="product-name">
                        @if(!strcmp($adresa['doprava'],'1'))
                            Odber na pobočke
                        @elseif(!strcmp($adresa['doprava'],'2'))
                            Kurier
                        @endif
                    </td>
                    <td class="product-amount">
                        <b>0€</b>
                    </td>
                </tr>
                <tr>
                    <td class="product-name"> @if(!strcmp($adresa['platba'],'1'))
                            Platba kartou
                        @elseif(!strcmp($adresa['platba'],'2'))
                            Bankovy prevod
                        @elseif(!strcmp($adresa['platba'],'3'))
                            Hotovost na predajni
                        @elseif(!strcmp($adresa['platba'],'4'))
                            Hotovost kurierovi
                        @endif

                    </td>
                    <td class="product-amount">
                        <b>0€</b>
                    </td>
                </tr>
                </tbody>
                <tfoot>
                <tr>
                    <td><span style="font-size: 15px; font-weight: bold">CELKOVA SUMA</span></td>
                    <td id="price">{{Cart::subtotal()}}€</td>
                </tr>
                </tfoot>
            </table>
            <div id="faktAdresa">
                <b>Fakturačná adresa</b><br>
                @if( auth()->check() )
                    {{auth()->user()->meno}} {{auth()->user()->priezvisko}}<br>
                    {{auth()->user()->adresa->ulica}}<br>
                    {{auth()->user()->adresa->psc}}<br>
                    {{auth()->user()->adresa->mesto}}<br>
                @else
                    {{$adresa['meno']}} {{$adresa['priezvisko']}}<br>
                    {{$adresa['ulica']}}<br>
                    {{$adresa['psc']}}<br>
                    {{$adresa['mesto']}}<br>
                @endif
            </div>
            <div id="dorucAdresa">
                <b>Doručovacia adresa</b><br>
                {{$adresa['meno']}} {{$adresa['priezvisko']}}<br>
                {{$adresa['ulica']}}<br>
                {{$adresa['psc']}}<br>
                {{$adresa['mesto']}}<br>
            </div>
            <div id="buttons">
                <button id="back" form="form2">Spôsob platby</button>
                <input type="hidden" id="meno" name="meno" value="{{$adresa['meno']}}">
                <input type="hidden" id="priezvisko" name="priezvisko" value="{{$adresa['priezvisko']}}">
                <input type="hidden" id="mesto" name="mesto" value="{{$adresa['mesto']}}">
                <input type="hidden" id="ulica" name="ulica" value="{{$adresa['ulica']}}">
                <input type="hidden" id="psc" name="psc" value="{{$adresa['psc']}}">
                <input type="hidden" id="doprava" name="doprava" value="{{$adresa['doprava']}}">
                <input type="hidden" id="platba" name="platba" value="{{$adresa['platba']}}">
                <button id="potvrdit" form="form1">Potvrdiť objednávku</button>

            </div>
        </section>
    </form>
@stop
