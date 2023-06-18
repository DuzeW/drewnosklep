<?php
include 'Board.php';
include 'Terrace_boards.php';
include 'Facade_boards.php';
function order_maker($user_id,$orders_id)
{
    $mysqli = new mysqli("localhost", "root", "", "drewnosklepdb");
    $result = $mysqli->query("
SELECT product_id,amount
FROM products_in_cart 
INNER JOIN product p ON p.id = product_id
WHERE user_data_id  = '$user_id'");
    $add_amount = [];
    while ($row = $result->fetch_assoc()) {
        $product_id=$row['product_id'];
        $amount=$row['amount'];
        if (array_key_exists($product_id,$add_amount)){
            $add_amount[$product_id]=$add_amount[$product_id]+$amount;
        }
        $add_amount[$product_id]=$amount;
    }
    $tab = [];
    foreach ($add_amount as $key => $i) {
        $result = $mysqli->query("
SELECT product_id,p.name,p.price,p.scantling_w,p.scantling_h,p.scantling_l
FROM products_in_cart 
INNER JOIN product p ON p.id = product_id
WHERE user_data_id  = '$user_id' AND product_id = '$key'");
        while ($row = $result->fetch_assoc()) {
            $product_id=$row['product_id'];
            $name=$row['name'];
            $price=$row['price'];
            $h=$row['scantling_w'];
            $w=$row['scantling_h'];
            $l=$row['scantling_l'];
            if($product_id==1){
                $tab[]=new Facade_boards($name,$l,$w,$h,$i,$price,$product_id);
            }
            else{
                $tab[]=new Terrace_boards($name,$l,$w,$h,$i,$price,$product_id);
            }
        }
    }
    foreach ($tab as $i){
        // $i->show_info(); TO EMAIL
        $i->show_info();
        echo'<br>';
        $price=$i->get_price();
        $p_id=$i->get_id();
        $amount=$i->get_amount();
        $query = $mysqli->query("SELECT quantity_available FROM product WHERE id='$p_id'");
        $row = $query->fetch_assoc();
        $q = $row['quantity_available'] - $amount;

        $updateQuery = "UPDATE product SET quantity_available='$q' WHERE id='$p_id'";
        $updateResult = $mysqli->query($updateQuery);

        $query = $mysqli->query("INSERT INTO 
    ordered_products(order_id	,product_id, amount, price)
VALUES
    ('$orders_id','$p_id','$amount','$price')
    ");


        $query = $mysqli->query("
        DELETE FROM products_in_cart WHERE user_data_id='$user_id'
        ");
        header("Location: ../subdomain/order_history.php");
    }

}



