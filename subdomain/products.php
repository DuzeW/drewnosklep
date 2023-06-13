<?php
include '../php_function/sidebar.php';
include '../php_function/head.php';
function show_products(){
    $msqli = new mysqli("localhost", "root", "", "drewnosklepdb");
    $result = $msqli->query("SELECT
    product.id,product.name,product.quantity_available,product.price,product.img_path,scantling_l,scantling_h,scantling_w,
    c.name,c.description
FROM product
INNER JOIN category c on c.id = product.category_id");
if(isset($_GET['switch'])) {
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
while($row = $result->fetch_assoc()) {
    echo'<div class="product">';
    $name = $row["name"];
    $_SESSION['p_id']=0;
    $p = $row["img_path"];
    echo '<img src="' . $p . '" alt="' . $name . '">';
    echo '<br>';

    echo '<div style="text-align: center; height: 63px;">'.$name.'</div>';
    echo '<br>';
    $quantity_available=$row["quantity_available"];
    $price=$row["price"];
    if(isset($_GET['switch'])){
        $l=$row["scantling_l"];
        $h=$row["scantling_h"];

        $change=$h/1000*$l/1000;
        $quantity_available= number_format($quantity_available*$change,1);
        $price = number_format( $price/$change,2);
    echo '<div style="text-align: center; height: 42px;">Dostępna ilość: '.$quantity_available.' m&sup2;</div>';
    echo '<br>';


    echo '<div style="text-align: center;height: 21px;">Cena: '.$price.' zł za m&sup2</div>';
    echo '<button class="button">Sprwadź</button>';
    echo '</div>';
    }
    else{
        echo '<div style="text-align: center; height: 42px;">Dostępna ilość: '.$quantity_available.' szt;</div>';
        echo '<br>';

        echo '<div style="text-align: center;height: 21px;">Cena: '.$price.' zł za szt</div>';
        echo '<button class="button"><a href="p_chosen.php">Sprwadź</a></button>';
        echo '</div>';
    }
}

}

?>

<?php
head_for_subdomain();
?>
<body>
<?php
sidebar_for_subdomain();
?>
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
