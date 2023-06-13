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
    $email = $_POST["email"];
    $password = $_POST["password"];
    $email = $mysqli->real_escape_string($email);
    $password = $mysqli->real_escape_string($password);
    $query = "SELECT * FROM user_data WHERE e_mail = '$email' AND password = '$password'";
    $result = $mysqli->query($query);
    if ($result->num_rows == 1) {
        echo "Zalogowano pomyślnie!";
        $_SESSION['logged_in'] = true;
        $_SESSION['email'] = $email;
        header("Location: ../index.php");
        exit();
    } 
    else {
        $_SESSION['logged_in'] = false;
     echo
     '<div class="container">
    <div class="login-form">
        <h2>Błędny login lub hasło spróbuj ponownie</h2>
        <br>
        <H2>Logowanie</H2>
        <form method="POST">
            <input type="text" name="email" placeholder="E-mail">
            <input type="password" name="password" placeholder="Hasło">
            <input type="submit" value="Zaloguj">
        </form>
    </div>
</div>';
    }
}
$mysqli->close();
?>
<body>
<div class="container">
    <div class="login-form">
        <h2>Logowanie</h2>
        <form method="POST">
            <input type="text" name="email" placeholder="E-mail">
            <input type="password" name="password" placeholder="Hasło">
            <input type="submit" value="Zaloguj">
        </form>
    </div>
</div>
</body>
