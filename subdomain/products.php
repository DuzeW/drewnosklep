<?php
function show_products(){
    $msqli = new mysqli("localhost", "root", "", "drewnosklepdb");
    $result = $msqli->query("SELECT
    product.id,product.name,product.quantity_available,product.price,product.img_path,
    c.name,c.description
FROM product
INNER JOIN category c on c.id = product.category_id");
while($row = $result->fetch_assoc()) {
    echo'<div class="product">';
    $name = $row["name"];
    echo '<div style="text-align: center;">'.$name.'</div>';
    echo '<br>';

    $p = $row["img_path"];
    echo '<img src="' . $p . '" alt="' . $name . '">';
    echo '<br>';

    echo '<div style="text-align: right;">Dostępna ilość: '.$row["quantity_available"].' m&sup2;</div>';
    echo '<br>';

    echo '<div style="text-align: right;">Cena: '.$row["price"].' zł za m&sup2</div>';
    echo '<div>';
}
}

?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="utf-8">
    <meta name="description" content="sklep z deskami" />
    <meta name="keywords" content="Deski" />
    <link rel="Shortcut icon" href="../img/d-logo.png"/>
    <link rel="stylesheet" type="text/css" href="../css/css.css">
    <script src="../js/toggle.js"></script>
    <script src="../js/map.js"></script>
    <title>DrewnoSklep</title>
</head>
<body>
<div class="sidebar">
    <div><img src="../img/drewnosklep-logo.png" alt="drewnosklep-logo" width="200" height="150"></div>
    <div><a href="../index.php">Strona Główna</a></div>
    <div><a href="products.php">Produkty</a></div>
    <div>3</div>
    <button class="toggle-button" onclick="toggleSidebar()">
        <img src="../img/hidden.png" alt="hidde" width="75" height="75">
    </button>
</div>
<div class="right">
    <div class="content_a">
        <center><h2>Produkty</h2></center>
    </div>
</div>
<div class="right_product">
        <?php show_products(); ?>
</div>

</body>
</html>
