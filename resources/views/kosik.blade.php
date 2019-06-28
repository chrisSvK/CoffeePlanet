@extends('layouts.app')

@section('title','Coffee Planer - Kosik')

@push('css')
    <link rel="stylesheet" type="text/css" href="css/kosik.css">
@endpush

@section('content')
    <section id="navigation">
        Košík><span style="color: gray; font-size: 14px ">Doprava>Spôsob Platby>Sumarizácia</span>
    </section>
    @if(session()->has('success_message'))
        {{session()->get('success_message')}}
    @endif
    <section id="obsahKosika">
        @if(Cart::count()>0)
            <h1>{{Cart::count()}} Produktov v kosiku</h1>
            <br>
            <table>
                <tbody>
                @foreach(Cart::content() as $item)
                    {{--<tr>
                        <td class="product-img">
                            <img src="img/tovar-kosik.png" alt="tovar1">
                        </td>
                        <td class="product-name">Espreso blend Costa Ricca + India Zrnková 1000g</td>
                        <td class="product-amount">
                            50€/ks
                            <img alt="close" src="img/close.png" height="15" width="15">
                            <input type="text" class="amount">
                        </td>
                    </tr>
                    <tr>
                        <td class="product-img">
                            <img src="img/tovar-kosik.png" alt="tovar1">
                        </td>
                        <td class="product-name">Espreso blend Costa Ricca + India Zrnková 1000g</td>
                        <td class="product-amount">
                            94€/ks
                            <img alt="close" src="img/close.png" height="15" width="15">
                            <input type="text" class="amount">
                        </td>
                    </tr>--}}
                    <tr>
                        <td class="product-img">
                            <img src="../img/{{$item->model->galeria[0]->name}}" alt="tovar1" width="64px"
                                 height="64px">
                        </td>
                        <td class="product-name">{{$item->name}}</td>
                        <td class="product-amount">
                            <form action="/kosik/{{$item->rowId}}"
                                  method="POST">
                                {{csrf_field()}}
                                {{method_field('DELETE')}}
                                <input type="image" src="img/close.png" height="15" width="15" alt="Submit Form"/>
                            </form>
                            {{$item->model->atributy[0]->cena}}/ks
                            <input type="text" class="amount" value="{{$item->qty}}" readonly>
                        </td>
                    </tr>
                @endforeach
                </tbody>
                <tfoot>
                <tr>
                    <td><span style="font-size: 15px; font-weight: bold">CELKOVA SUMA</span></td>
                    <td id="price">{{Cart::subtotal()}}€</td>
                </tr>
                </tfoot>
            </table>
            <div id="buttons">
                <form action="/">
                    <button id="back" href="/">Späť do obchodu</button>
                </form>
                <form action="doprava">
                    <button id="doprava">Doprava</button>
                </form>
            </div>
        @else <h1>Kosik Prazdny</h1>
        @endif
    </section>
@stop
