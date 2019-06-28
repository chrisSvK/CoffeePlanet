@extends('layouts.app')

@section('title','Coffee Planer - Mleta')

@push('css')
    <link rel="stylesheet" type="text/css" href="../css/mleta.css">
@endpush

@push('script')
    <script src="js/filter.js"></script>
@endpush

@section('filter')
    <div id="filterMode">
        <img alt="close" src="img/close.png" onclick="closeFilter()" height="15" width="15"><br>
        <b>Zoradiť podľa</b>
        <form action="{{action("ProductController@".($mode))}}" method="get">
            {{--<form action="{{url("mleta")}}" method="get">--}}
            {{ csrf_field() }}
            <select name="filterOption">
                <option value="filter1">Názov vzostupne</option>
                <option value="filter2">Názov zostupne</option>
                <option value="filter3">Cena vzostupne</option>
                <option value="filter4">Cena zostupne</option>
                <option value="filter5">Najnovšie</option>
                <option value="filter6">Najstaršie</option>
                <option value="filter7">Najobľúbenejšie</option>
            </select>
            <button type="submit" id="filterOn">Filtruj</button>
            <br>
            <b>Cenová hranica</b>
            <div class="slidecontainer">
                <input name="priceRange" type="range" min="1" max="100" value="50" class="slider" id="myRange">
            </div>
            1€
            <span id="demo" style="margin-left: 45%"></span>
            <span style="float: right">60€</span>
        </form>
    </div>
@stop

@section('content')
    <section id="navigation">
        {{--Káva>Mletá--}}
        {{$kategoria}}
    </section>
    <div id="formButton">
        <button id="filter" onclick="openFilter()">Filter</button>
    </div>
    <section id="obsah">
        <ul>
            @foreach($data['productList'] as $produkt)
                <li>
                    @if($data['galeria']->where('produkt_id',$produkt->produkt_id)->count()>0)
                        <a href="produkt/{{$produkt->produkt_id}}">
                            <img src="img/{{$data['galeria']->where('produkt_id',$produkt->produkt_id)->first()->name}}">
                        </a>
                    @else <img src="img/tovar.png" alt="tovar1">
                    @endif
                    <p>{{$produkt->name}}</p>
                    @if(strcmp($mode, 'prislusenstvo')!=0)
                        <b>{{$produkt->atributy[0]->value}}
                            /</b>
                    @endif
                    <b>{{$produkt->atributy[0]->cena}}€</b>
                    <br>
                    <br>
                </li>
            @endforeach
        </ul>
    </section>
    <div class="pagination">
        {{$data['productList']->appends(['filterOption'=>$filterOption , 'priceRange'=>$priceRange])->render()}}
    </div>

@stop
