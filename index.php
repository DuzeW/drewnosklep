
<?php
$_SESSION['logged_in']=false;
session_start();
include 'php_function/sidebar.php'
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

<?php
sidebar();
?>

<div class="right">
<div class="content_a">
    <center><h2>STRONA GŁÓWNA</h2></center>
</div>
<div class="content_b">


    <h2>Nasza Oferta</h2>
</div>
    <div class="content_b">
    Oferujemy szeroki wybór najwyższej jakości deski, które spełnią nawet najbardziej wymagające oczekiwania. Niezależnie od tego,
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
