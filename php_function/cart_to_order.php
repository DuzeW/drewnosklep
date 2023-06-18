<?php
include 'php_class/order_maker.php';
function cart_to_order($user_id,$user_addres)
{
    $mysqli = new mysqli("localhost", "root", "", "drewnosklepdb");
    $currentDateTime = date('Y-m-d');
    $query = $mysqli->query("INSERT INTO 
    orders(order_date,user_data_id, status_of_order_id, address_id)
VALUES
    ('$currentDateTime','$user_id','1','$user_addres');
    ");
    $orders_id = $mysqli->insert_id;
    order_maker($user_id,$orders_id);
}
?>


