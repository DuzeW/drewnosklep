<?php
include '../php_function/sidebar.php';
include '../php_function/head.php';

head_for_subdomain_p_chosen();
?>
    <body>
<?php
sidebar_for_subdomain();
echo '<div class="right">';
echo '<div class="content_a">';
echo '<H1>Koszyk</H1>';
echo '</div>';

function show_cart(){
    $mysqli = new mysqli("localhost", "root", "", "drewnosklepdb");
    $id=$_SESSION['id'];
    $result = $mysqli->query("
SELECT user_data_id, product_id,amount,p.name,p.class,p.price,p.img_path
FROM products_in_cart 
INNER JOIN product p ON p.id = product_id
WHERE user_data_id  = '$id'");

    if ($result->num_rows > 0) {
        echo '<div class="cart">';
        echo '<table>';
        echo '<tr><th></th><th>Nazwa</th><th>Klasa</th><th>Cena za szt</th><th>ilość</th><th>suma</th></tr>';
        $sum=0;
        while ($row = $result->fetch_assoc()) {
            $sum_p = $row['amount']*$row['price'];
            echo '<tr>';
            echo '<td><img src="' . $row['img_path'] . '" alt="' . $row['name'] . '"></td>';
            echo '<td>' . $row['name'] . '</td>';
            echo '<td>' . $row['class'] . '</td>';
            echo '<td>' . $row['price'] . ' zł</td>';
            echo '<td>' . $row['amount'] . '</td>';
            echo '<td>' . $sum_p . ' zł</td>';
            $sum+=$sum_p;
            echo '</tr>';
        }
        echo '<tr>';
        echo '<th colspan="4"></th>';
        echo '<th> Suma</th>';
        echo '<td>' . $sum . ' zł</td>';
        echo '</tr>';
        echo '</table>';

        if(isset($_GET['switch'])) {
            echo '
<form method="GET">
    <div class="switch2">
  <button type="submit" class="button" name="switch2" >Zmień adres</button>
</div>
</form>';


if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $country = $_POST["country"];
    $city = $_POST["city"];
    $zip_code = $_POST["zip_code"];
    $street = $_POST["street"];
    $house_nr = $_POST["house_nr"];
    $flat_nr = $_POST["flat_nr"];


    $country = $mysqli->real_escape_string($country);
    $city = $mysqli->real_escape_string($city);
    $zip_code = $mysqli->real_escape_string($zip_code);
    $street = $mysqli->real_escape_string($street);
    $house_nr = $mysqli->real_escape_string($house_nr);
    $flat_nr = $mysqli->real_escape_string($flat_nr);


    $user_address_id = $mysqli->query("
    SELECT user_data.address_id
    FROM user_data 
    INNER JOIN address a ON a.id = user_data.address_id
    WHERE user_data.id = '$id'");

    if ($user_address_id->num_rows > 0) {
        while ($row = $user_address_id->fetch_assoc()) {
            $user_address_id1 = $row['address_id'];
        }
        $address_update = "UPDATE address SET
        country = '$country',
        city = '$city',
        zip_code = '$zip_code',
        street = '$street',
        house_nr = '$house_nr',
        flat_nr = '$flat_nr'
    WHERE id = '$user_address_id1'";

        if ($mysqli->query($address_update) === TRUE) {
            echo "Dane adresowe zostały zaktualizowane.";
        } else {
            echo "Wystąpił błąd podczas aktualizacji danych adresowych: " . $mysqli->error;
        }
    } else {
        echo "Brak wyników.";
    }


}

$mysqli->close();
echo'


<body>
<div class="container">
    <div class="register-form">
        <h2>Rejestracja</h2>
        <form method="POST">
            <input type="text" name="country" placeholder="Kraj" required><br>
            <input type="text" name="city" placeholder="Miasto" required><br>
            <input type="text" name="zip_code" placeholder="Kod pocztowy" required><br>
            <input type="text" name="street" placeholder="Ulica" required><br>
            <input type="text" name="house_nr" placeholder="Numer domu" required><br>
            <input type="text" name="flat_nr" placeholder="Numer mieszkania (opcjonalnie)"><br>
            <div class="add_to_cart">
            <input type="submit" value="Zmień adres">
            </div>
        </form>
    </div>
</div>
</body>
';
        }
        else {
            echo '
<form method="GET">
    <div class="switch">
  <button type="submit" class="button" name="switch" >Zmień adres</button>
</div>
</form>';

            $result = $mysqli->query("
SELECT user_data.id, user_data.address_id, a.country, a.city, a.zip_code, a.street, a.house_nr,a.flat_nr
FROM user_data 
INNER JOIN address a ON a.id = user_data.address_id
WHERE user_data.id = '$id'");

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<br>";
                    echo "Kraj: " . $row['country'] . "<br>";
                    echo "Miejscowość: " . $row['city'] . "<br>";
                    echo "Kod pocztowy: " . $row['zip_code'] . "<br>";
                    echo "Ul: " . $row['street'] . "<br>";
                    echo "Numer Domu: " . $row['house_nr'] . "<br>";
                    echo "Numer Mieszkania: " . $row['flat_nr'] . "<br>";
                }
            } else {
                echo "Brak wyników.";
            }

        }


        if(isset($_GET['final'])) {

            header("Location: orders.php");
        }
        echo '<form method="GET">
<div class="add_to_cart">
  <button type="submit" class="button" name="final" >Zamów i zapłać</button>
  </div>
</form>';
        echo '</div></div>';
    } else {
        echo 'Brak produktów w koszyku';
    }


}
show_cart();