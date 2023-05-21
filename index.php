<?php
?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="utf-8">
    <meta name="description" content="sklep z deskami" />
    <meta name="keywords" content="Deski" />
    <link rel="Shortcut icon" href="img/d-logo.png"/>
    <link rel="stylesheet" type="text/css" href="css/css.css">
    <script src="js/toggle.js"></script>
    <script src="js/map.js"></script>
    <title>DrewnoSklep</title>
</head>
<body>
<div class="sidebar">
    <div><img src="img/drewnosklep-logo.png" alt="drewnosklep-logo" width="200" height="150"></div>
    <div><a href="index.php">Strona Główna</a></div>
    <div><a href="subdomain/products.php">Produkty</a></div>
    <div>3</div>
    <button class="toggle-button" onclick="toggleSidebar()">
        <img src="img/hidden.png" alt="hidde" width="75" height="75">
    </button>
</div>
<div class="right">
<div class="content_a">
    <center><h2>STRONA GŁÓWNA</h2></center>
</div>
<div class="content_b">


    <h2>Nasza Oferta</h2>
    Oferujemy szeroki wybór najwyższej jakości desk, które spełnią nawet najbardziej wymagające oczekiwania. Niezależnie od tego,
    czy szukasz idealnej deski do klasycznego, minimalistycznego czy też nowoczesnego wystroju, mamy dla Ciebie coś wyjątkowego.
<br><br>
    Stawiamy na ekologiczne rozwiązania, dlatego wszystkie nasze produkty pochodzą z certyfikowanych źródeł,
    co zapewnia odpowiedzialne gospodarowanie zasobami przyrody.
</div>
<div class="content_a">
    <center><h2>Nasza lokalizacja</h2></center>
    <div id="map"></div>
    <script src="https://maps.googleapis.com/maps/api/js?key=&callback=initMap" async defer></script>
</div>
</div>
</div>
</body>
</html>
