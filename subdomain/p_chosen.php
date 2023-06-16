<?php
include '../php_function/sidebar.php';
include '../php_function/head.php';

head_for_subdomain_p_chosen();
?>
<body>
<?php
sidebar_for_subdomain();
function show_details_of_p($p_id){

    $mysqli = new mysqli("localhost", "root", "", "drewnosklepdb");
    $result = $mysqli->query("SELECT product.id,c.name,c.description ,product.category_id, product.name, product.class, product.price, product.quantity_available, product.img_path, product.scantling_l, product.scantling_h, product.scantling_w 
FROM product 
INNER JOIN category c ON c.id = product.category_id 
WHERE product.id = '$p_id'");

    $row = mysqli_fetch_assoc($result);
    $name = $row['name'];
    $class = $row['class'];
    $price = $row['price'];
    $quantity_available=$row["quantity_available"];
    $l=$row["scantling_l"];
    $h=$row["scantling_h"];
    $w=$row["scantling_w"];
    $p = $row["img_path"];

    $result = $mysqli->query("SELECT product.id,c.name,c.description ,product.category_id
FROM product 
INNER JOIN category c ON c.id = product.category_id 
WHERE product.id = '$p_id'");
    $row = mysqli_fetch_assoc($result);
    $c_name=$row["name"];
    $c_description=$row["description"];

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
    if (isset($_GET['amount_m'])) {
        $amount_m=$_GET['amount_m'];
        $change=$h/1000*$l/1000;
        $amount_m=ceil($amount_m/$change);
        $id=$_SESSION['id'];
        $add_p = "INSERT INTO products_in_cart (user_data_id, product_id,amount)
                        VALUES ('$id','$p_id','$amount_m')";
        $add_p= $mysqli ->query($add_p);
        header("Location: cart.php");
    }
    if (isset($_GET['amount_s'])) {
        $amount_m=$_GET['amount_s'];
        $id=$_SESSION['id'];
        $add_p = "INSERT INTO products_in_cart (user_data_id, product_id,amount)
                        VALUES ('$id','$p_id','$amount_m')";
        $add_p= $mysqli ->query($add_p);
        header("Location: cart.php");
    }
    if(isset($_GET['switch'])) {
        echo '<div class="add_to_cart">
<form method="GET">
            <input type="number" name="amount_m" placeholder="Ilość" max="' . $quantity_available . '"> m&sup2
            <input type="submit" value="Dodaj do koszyka">
        </form>
        </div>';
    }
    else{
        echo '<div class="add_to_cart">
<form method="GET">
            <input type="number" name="amount_s" placeholder="Ilość" max="' . $quantity_available . '"> szt
            <input type="submit" value="Dodaj do koszyka">
        </form>
        </div>';
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
    echo '<H2>Szerokość: ' . number_format($h,0,'', ' ') . 'mm</H2>';
    echo '<H2>Wysokość: ' . number_format($w,0,'', ' ') . 'mm</H2>';
    echo '<div class="content_a">';
    echo '<H1>Opis produktu</H1>';
    echo '</div>';
    echo '<H2>' . $c_name . '</H2>';
    echo '<H3>' . $c_description . '</H3>';




}
show_details_of_p($_SESSION['p_id']);
?>
