<?php
include '../php_function/sidebar.php';
include '../php_function/head.php';
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


    $p = $row["img_path"];
    echo '<img src="' . $p . '" alt="' . $name . '">';
    echo '<br>';

    echo '<div style="text-align: center; height: 63px;">'.$name.'</div>';
    echo '<br>';

    echo '<div style="text-align: center;">Dostępna ilość: '.$row["quantity_available"].' szt;</div>';
    echo '<br>';

    echo '<div style="text-align: center;">Cena: '.$row["price"].' zł za szt</div>';
    echo '</div>';
}
}

?>
<!DOCTYPE html>
<html lang="pl">
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
