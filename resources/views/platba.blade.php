@extends('layouts.app')

@section('title','Coffee Planer - Platba')

@push('css')
    <link rel="stylesheet" type="text/css" href="css/platba.css">
@endpush

@section('content')
    <section id="navigation">
        Košík>Doprava>Spôsob Platby><span style="color: gray; font-size: 14px ">Sumarizácia</span>
    </section>
    <form action="doprava" id="form2"></form>
    <form action="sumarizacia" method="GET" id="form1">
        <section id="obsahPlatba">
            <input type="radio" name="platba" {{--value="Platba kartou"--}} value="1" checked><span
                    style="display: inline-block"> Platba kartou</span><span
                    style="float: right; margin-right: 30px">+0€</span>
            <span style="display: block"><input type="radio" name="platba" {{--value="Bankovy prevod"--}} value="2">Bankovy prevod <span
                        style="float: right; margin-right: 30px">+1€</span></span>
            <input type="radio" name="platba" {{--value="Hotovost na predajni"--}} value="3"> V hotovosti na predajni <span
                    style="float: right; margin-right: 30px">+0€</span><br>
            <input type="radio" name="platba"{{-- value="Hotovost kurierovi"--}} value="4"> V hotovosti kuriérovi <span
                    style="float: right; margin-right: 30px">+0€</span><br>
            {{--{{csrf_field()}}--}}
            <input type="hidden" id="mesto" name="mesto" value="{{$adresa['mesto']}}">
            <input type="hidden" id="ulica" name="ulica" value="{{$adresa['ulica']}}">
            <input type="hidden" id="psc" name="psc" value="{{$adresa['psc']}}">
            <input type="hidden" id="meno" name="meno" value="{{$adresa['meno']}}">
            <input type="hidden" id="priezvisko" name="priezvisko" value="{{$adresa['priezvisko']}}">
            <input type="hidden" id="doprava" name="doprava" value="{{$adresa['doprava']}}">
            <div id="buttons">
                <button id="back" form="form2">Doprava</button>
                <button id="sumarizacia" form="form1">Sumarizácia</button>
            </div>
        </section>
    </form>
@stop
