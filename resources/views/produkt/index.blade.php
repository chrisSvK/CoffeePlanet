<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Produkt Index</title>
</head>
<body><h1>Produkt Index</h1>

{{--<table>
    <tr><th>ID</th><th>Meno</th><th>kategoria</th><th>Nazov</th></tr>
    @foreach($data['productList'] as $produkt)
        <tr>
            <td>{{ $produkt->produkt_id }}</td>
            <td>{{ $produkt->name }}</td>
            <td>{{ $produkt->kategoria_id }}</td>
            <td>{{ $data['kategoria']->where('kategoria_id',$produkt->kategoria_id)->first()->name }}</td>
        </tr>
    @endforeach
</table>--}}



<ul>
   {{-- <li><a href="produkt">
            <img src="img/tovar.png" alt="tovar1">
            <p>Espreso blend Costa Ricca + India Zrnková <b>1000g/12€</b></p>
        </a>
    </li>
    <li>
        <img src="img/tovar.png" alt="tovar4">
        <p>Espreso blend Costa Ricca + India Zrnková <b>1000g/12€</b></p>
    </li>
    <li>
        <img src="img/tovar.png" alt="tovar2">
        <p>Espreso blend Costa Ricca + India Zrnková <b>1000g/12€</b></p>
    </li>
    <li>
        <img src="img/tovar.png" alt="tovar5">
        <p>Espreso blend Costa Ricca + India Zrnková <b>1000g/12€</b></p>
    </li>
    <li>
        <img src="img/tovar.png" alt="tovar3">
        <p>Espreso blend Costa Ricca + India Zrnková <b>1000g/12€</b></p>
    </li>
    <li>
        <img src="img/tovar.png" alt="tovar6">
        <p>Espreso blend Costa Ricca + India Zrnková <b>1000g/12€</b></p>
    </li>--}}
    @foreach(($data['productList'])->sortByDesc('pocet_objednani')->take(10) as $produkt)
        <li>
            <img src="img/tovar.png" alt="tovar1">
            <p>{{$produkt->name}} <b>1000g/12€</b></p>
            <p>{{ $data['kategoria']->where('kategoria_id',$produkt->kategoria_id)->first()->name }}</p>
        </li>
    @endforeach

</ul>
</body>

</html>