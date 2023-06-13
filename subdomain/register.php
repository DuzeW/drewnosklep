<?php
include '../php_function/head.php';
head_for_login();
?>

<?php
$mysqli = new mysqli("localhost", "root", "", "drewnosklepdb");
if ($mysqli->connect_errno) {
    die("Błąd połączenia: " . $mysqli->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $e_mail = $_POST["e_mail"];
    $phone_nr = $_POST["phone_nr"];
    $password = $_POST["password"];
    $name = $_POST["name"];
    $last_name = $_POST["last_name"];
    $country = $_POST["country"];
    $city = $_POST["city"];
    $zip_code = $_POST["zip_code"];
    $street = $_POST["street"];
    $house_nr = $_POST["house_nr"];
    $flat_nr = $_POST["flat_nr"];

    $e_mail = $mysqli->real_escape_string($e_mail);
    $phone_nr = $mysqli->real_escape_string($phone_nr);
    $password = $mysqli->real_escape_string($password);
    $name = $mysqli->real_escape_string($name);
    $last_name = $mysqli->real_escape_string($last_name);
    $country = $mysqli->real_escape_string($country);
    $city = $mysqli->real_escape_string($city);
    $zip_code = $mysqli->real_escape_string($zip_code);
    $street = $mysqli->real_escape_string($street);
    $house_nr = $mysqli->real_escape_string($house_nr);
    $flat_nr = $mysqli->real_escape_string($flat_nr);

    $checkemail = "SELECT * FROM user_data WHERE e_mail = '$e_mail'";
    $checkemail = $mysqli->query($checkemail);
    if ($checkemail->num_rows > 0) {
        echo "Użytkownik o podanym adresie e-mail już istnieje!";
    } else {
        /* problem z polaczeniem odpowiedzniego id do uzytkownika :(
          $addaddress = "INSERT INTO address (country,city,zip_code,street,house_nr,flat_nr)
                        VALUES ('$country','$city','$zip_code','$street','$house_nr','$flat_nr')";
        $id_address="SELECT id FROM address ";
        echo $country;
        $id_address = $mysqli->query($id_address);

        echo $id_address;
        
        $adduser = "INSERT INTO user_data (e_mail, phone_nr, password, name, last_name, address_id, permison_lvl)
                        VALUES ('$e_mail','$phone_nr','$name','$last_name','$phone_nr',$id_address,0)";
        $adduser= $mysqli ->query($adduser);
        $addaddress= $mysqli ->query($addaddress);*/
        
    }
}

$mysqli->close();
?>

<body>
<div class="container">
    <div class="register-form">
        <h2>Rejestracja</h2>
        <form method="POST">
            <H3>Dane osobowe</H3>
            <input type="text" name="e_mail" placeholder="E-mail" required> 
            <input type="password" name="password" placeholder="Hasło" required>
            <input type="text" name="name" placeholder="Imię" required>
            <input type="text" name="last_name" placeholder="Nazwisko" required>
            <input type="text" name="phone_nr" placeholder="Numer telefonu" required>
            <H3>Adres</H3>
            <input type="text" name="country" placeholder="Kraj" required>
            <input type="text" name="city" placeholder="Miasto" required>
            <input type="text" name="zip_code" placeholder="Kod pocztowy" required>
            <input type="text" name="street" placeholder="Ulica" required>
            <input type="text" name="house_nr" placeholder="Numer domu" required>
            <input type="text" name="flat_nr" placeholder="Numer mieszkania (opcjonalnie)">
            <input type="submit" value="Zarejestruj">
        </form>
    </div>
</div>
</body>
