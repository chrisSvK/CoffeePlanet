@extends('layouts.app')

@section('title','Coffee Planer - Registration')

@push('css')
    <link rel="stylesheet" type="text/css" href="css/registration.css">
@endpush

@section('content')
    <section>
        <form  method="POST" action="registration">
            {{ csrf_field() }}
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            Meno:
            <input type="text" id="meno" name="meno">
            Priezvisko:
            <input type="text" id="priezvisko" name="priezvisko">
            E-mail:
            <input type="text" id="email" name="email">
            Dátum narodenia:
            <input type="text" id="datumNarodenia" name="datumNarodenia">
            Mesto:
            <input type="text" id="mesto" name="mesto">
            Ulica, č. domu:
            <input type="text" id="ulica" name="ulica">
            PSČ:
            <input type="text" id="psc" name="psc">
            Mobil:
            <input type="text" id="mobil" name="mobil">
            Heslo:
            <input type="password" id="password" name="password">
            Heslo znovu:
            <input type="password" id="password2" name="password2">
            <br>
            <br>
            <input id="submit" type="submit" value="Registrovať sa">
            <br>
        </form>
    </section>
@stop
