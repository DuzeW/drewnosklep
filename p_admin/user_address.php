<?php
$mysqli = new mysqli("localhost", "root", "", "drewnosklepdb");

$query = "SELECT u.id, u.e_mail, u.phone_nr, u.password, u.name, u.last_name, u.permison_lvl, u.address_id,
          a.country, a.city, a.zip_code, a.street, a.house_nr, a.flat_nr
          FROM user_data u
          INNER JOIN address a ON a.id = u.address_id";

$result = $mysqli->query($query);

if ($result->num_rows > 0) {
    echo "<table>";
    echo "<tr>";
    echo "<th>ID</th>";
    echo "<th>E-mail</th>";
    echo "<th>Numer telefonu</th>";
    echo "<th>Hasło</th>";
    echo "<th>Imię</th>";
    echo "<th>Nazwisko</th>";
    echo "<th>Poziom uprawnień</th>";
    echo "<th>ID adresu</th>";
    echo "<th>Kraj</th>";
    echo "<th>Miasto</th>";
    echo "<th>Kod pocztowy</th>";
    echo "<th>Ulica</th>";
    echo "<th>Numer domu</th>";
    echo "<th>Numer mieszkania</th>";
    echo "</tr>";

    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row["id"] . "</td>";
        echo "<td>" . $row["e_mail"] . "</td>";
        echo "<td>" . $row["phone_nr"] . "</td>";
        echo "<td>" . $row["password"] . "</td>";
        echo "<td>" . $row["name"] . "</td>";
        echo "<td>" . $row["last_name"] . "</td>";
        echo "<td>" . $row["permison_lvl"] . "</td>";
        echo "<td>" . $row["address_id"] . "</td>";
        echo "<td>" . $row["country"] . "</td>";
        echo "<td>" . $row["city"] . "</td>";
        echo "<td>" . $row["zip_code"] . "</td>";
        echo "<td>" . $row["street"] . "</td>";
        echo "<td>" . $row["house_nr"] . "</td>";
        echo "<td>" . $row["flat_nr"] . "</td>";
        echo "</tr>";
    }

    echo "</table>";
} else {
    echo "Brak wyników.";
}

$mysqli->close();
?>
