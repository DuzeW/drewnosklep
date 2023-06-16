<?php
include '../php_function/sidebar.php';
include '../php_function/head.php';
head_for_subdomain();
?>
<body>
<?php
sidebar_for_subdomain();
function show_details_of_p($p_id){

    $mysqli = new mysqli("localhost", "root", "", "drewnosklepdb");
    $result = $mysqli->query("SELECT id, name,class,price,quantity_available,img_path,scantling_l,scantling_h,scantling_w FROM product WHERE id = '$p_id'");
    $row = mysqli_fetch_assoc($result);
    $name = $row['name'];
    $class = $row['class'];
    $price = $row['price'];
    $quantity_available=$row["quantity_available"];
    $l=$row["scantling_l"];
    $h=$row["scantling_h"];
    $w=$row["scantling_w"];
    $p = $row["img_path"];

    echo '<div class="right">';
    echo '<div class="content_a">';
    echo '<H1>' .$name. '</H1>';
    echo '</div>';
    echo '<div class="content_b">';

    echo '<img src="' . $p . '" alt="' . $name . '">';
    echo '<br></div>';

    if(isset($_GET['switch'])) {


        $change=$h/1000*$l/1000;
        $quantity_available= number_format($quantity_available*$change,1);
        $price = number_format( $price/$change,2);
        echo '
<form method="GET">
    <div class="switch2">
  <button type="submit" class="button" name="switch2" >Przełącz jednostki</button>
</div>
</form>';
    }
    else {
        echo '
<form method="GET">
    <div class="switch">
  <button type="submit" class="button" name="switch" >Przełącz jednostki</button>
</div>
</form>';
    }
    echo '<H2>Nazwa: ' . $name . '</H2>';
    echo '<H2>Klasa: ' . $class . '</H2>';
if(isset($_GET['switch'])) {
    echo '<H2>Cena: ' . $price . ' zł za m&sup2</H2>';
    echo '<H2>Dostępna ilość: ' . $quantity_available . ' m&sup2 </H2>';
}
else {
    echo '<H2>Cena: ' . $price . ' zł za szt </H2>';
    echo '<H2>Dostępna ilość: ' . $quantity_available . ' szt </H2>';
}
    echo '<H2>Długość: ' . number_format($l,0,'', ' ') . 'mm</H2>';
    echo '<H2>Wysokość: ' . number_format($h,0,'', ' ') . 'mm</H2>';
    echo '<H2>Szerokość: ' . number_format($w,0,'', ' ') . 'mm</H2>';
}
show_details_of_p($_SESSION['p_id']);
?>
