<!DOCTYPE html>
<html lang="sk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title')</title>
    @stack('css')
</head>
<body>
<header>
    <a class="more" onclick="openNav()"><img alt="more" src="../img/more.png" height="15"></a>
    <a href="/" class="logo">Coffee Planet</a>
    <div class="header-right">
        <a href="#search"><img alt="search" src="../img/search.png" height="25"></a>
        <a href="../kosik"><img alt="kosik" src="../img/kosik.png" height="25"></a>
    </div>
</header>
<nav class="top-nav">
    <ul>
        <li>
            <div class="drop">
                <a>Káva</a>
                <img alt="search" src="../img/sipka.png" height="10" width="15">
                <div class="kava-content">
                    <a href="../mleta">Mletá</a>
                    <a href="../zrnkova">Zrnková</a>
                    <a href="../kapsule">Kapsule</a>
                </div>
            </div>
        </li>


        <li>
            <div class="drop">
                <a href="#caj">Čaj</a>
                <img alt="search" src="../img/sipka.png" height="10" width="15">
                <div class="kava-content">
                    <a href="../cierny">Čierny</a>
                    <a href="../zeleny">Zelený</a>
                    <a href="../ovocny">Ovocný</a>
                    <a href="../bylinkovy">Bylinkovy</a>
                </div>
            </div>
        </li>
        <li><a href="../prislusenstvo">Príslušenstvo</a></li>
        <li><a href="#onas">O nás</a></li>
        @if( auth()->check() )
            <li style="float:right"><a href="../logout">Odhlasit</a></li>
            <li style="float:right">{{auth()->user()->meno}} {{auth()->user()->priezvisko}}</li>
        @else
            <li style="float:right"><a href="../login">Prihlásiť sa</a></li>
        @endif
    </ul>
</nav>
<nav class="side-nav">
    <img id=close alt="close" onclick="closeNav()" src="../img/close.png" height="15" width="15">
    <ul>
        <li>
            <button class="side-dropdown-btn">Káva
                <img alt="search" src="../img/sipka.png" height="10" width="15">
            </button>
            <div class="side-dropdown-container">
                <a href="../mleta">Mletá</a>
                <a href="../zrnkova">Zrnková</a>
                <a href="../kapsule">Kapsule</a>
            </div>
        </li>


        <li>
            <button class="side-dropdown-btn">Čaj
                <img alt="search" src="../img/sipka.png" height="10" width="15">
            </button>
            <div class="side-dropdown-container">
                <a href="../cierny">Čierny</a>
                <a href="../zeleny">Zelený</a>
                <a href="../ovocny">Ovocný</a>
                <a href="../bylinkovy">Bylinkovy</a>
            </div>
        </li>
        <li><a href="../prislusenstvo">Príslušenstvo</a></li>
        <li><a href="#onas">O nás</a></li>
        @if( auth()->check() )
            <li>{{auth()->user()->meno}} {{auth()->user()->priezvisko}}</li>
            <li><a href="../logout">Odhlasit</a></li>
        @else
            <li><a href="../login">Prihlásiť sa</a></li>
        @endif
    </ul>
</nav>
<main>
    @yield('filter')
    <div class="content">
        @yield('content')
    </div>
</main>

<nav class="social">
    <ul>
        <li><a href="#message"><img alt="message" src="../img/message.png" height="25"></a></li>
        <li><a href="#twitter"><img alt="twitter" src="../img/twitter.png" height="25"></a></li>
        <li><a href="#facebook"><img alt="facebook" src="../img/facebook.png" height="25"></a></li>
    </ul>
</nav>

<footer>
    <div class="footer-center">
        <a href="/" class="footer-logo"><img alt="message" src="../img/logo.png"></a>
        <div class="footer-right">
            <a href="#">Všeobecné obchodné podmienky</a>
            <a href="#">Ochrana osobných údajov</a>
            <a href="#">Ako nakupovať</a>
        </div>
        <p>© 2018
    </div>
</footer>
<script src="../js/main.js"></script>
@stack('script')
</body>
</html>
