@extends('layouts.app')

@section('title','Coffee Planer - Login')

@push('css')
    <link rel="stylesheet" type="text/css" href="css/login.css">
@endpush

@section('content')
    <section>
        <form method="POST" action="login">
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
            Prihlasovacie meno:<br>
            <br>
            <input type="text" id="login" name="login">
            <br>
            <br>
            Heslo:<br>
            <br>
            <input type="password" id="password" name="password">
            <br>
            <br>
            <input id="submit" type="submit" value="Prihlásiť sa">
            <br>
        </form>
        <form action="registration">
            <button>Registrácia</button>
            <p>Zabudli ste heslo?</p>
        </form>
    </section>
@stop
