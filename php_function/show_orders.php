<?php
function show_orders($user_id){
    $mysqli = new mysqli("localhost", "root", "", "drewnosklepdb");
    $query = "SELECT * FROM status_of_order";
    $result=$mysqli->query($query);
    while ($row = $result->fetch_assoc()) {
    $status_name[$row['id']]=$row['name'];
    $status_description[$row['id']]=$row['description'];
    }

    $query = "SELECT id,order_date,status_of_order_id FROM orders WHERE user_data_id='$user_id' ";
    $result=$mysqli->query($query);
    echo '<div class="right"><div class="cart">';
    echo '<table>';
    echo '<tr><th>Data zamówienia</th><th>Status zamówienia</th><th>Opis statusu zamówienia</th><th></th></tr>';
    while ($row = $result->fetch_assoc()) {
        echo '<tr>';
        echo '<td>' . $row['order_date']. '</td>';
        echo '<td>';
        $name= $status_name[$row['status_of_order_id']];
        echo $name;
        echo '</td>';
        echo '<td>';
        $name= $status_description[$row['status_of_order_id']];
        echo $name;
        echo '</td>';
        echo '<td>';
        $r_id=$row['id'];
        echo '
<form method="GET">
    <div class="add_to_cart">
  <button type="submit" class="button" name="show" value="'. $r_id .'">Zamówione produkty</button>
  
</div>
</form>';
        echo '</td>';
        echo '</tr>';
    }
    echo '</div></div>';
    echo '</table>';
    if(isset($_GET['show'])) {
        $_SESSION['order_id']=$_GET['show'];
        header("Location: ordered_p.php");
    }

}
function show_ordered_p($o_id)
{
    echo '<div class="right"><div class="cart">';
    $mysqli = new mysqli("localhost", "root", "", "drewnosklepdb");

    $query = "SELECT ordered_products.amount,ordered_products.price,
       p.name,p.class,p.img_path
                  FROM ordered_products 
                  INNER JOIN product p ON p.id = product_id
                  WHERE order_id='$o_id'
";
    $result=$mysqli->query($query);

    echo '<table>';
    echo '<tr><th></th><th>Nazwa</th><th>Klasa</th><th>Ilość szt</th><th>Cena</th></tr>';
    while ($row = $result->fetch_assoc()) {
        echo '<tr>';
        echo '<td><img src="' . $row['img_path'] . '" alt="' . $row['name'] . '"></td>';
        echo '<td>' . $row['name'] . '</td>';
        echo '<td>' . $row['class'] . '</td>';
        echo '<td>' . $row['amount'] . '</td>';
        echo '<td>' . $row['price'] . '</td>';
        echo '</tr>';
    }
    echo '</div></div>';
    echo '</table>';
}