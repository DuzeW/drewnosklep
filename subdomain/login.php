<?php
include '../php_function/head.php';
head_for_login();
?>
<?php
$mysqli = new mysqli("localhost", "root", "", "drewnosklepdb");
if (isset($_COOKIE['email']) && isset($_COOKIE['password'])) {
    $cookie_email = $_COOKIE['email'];
    $cookie_password = $_COOKIE['password'];
    $query = "SELECT * FROM user_data WHERE e_mail = '$cookie_email' AND password = '$cookie_password'";
    $result = $mysqli->query($query);
    if ($result->num_rows == 1) {
        echo "Zalogowano pomyślnie!";
        $query = "SELECT name,id FROM user_data WHERE e_mail = '$cookie_email'";
        $result = $mysqli->query($query);
        $row = mysqli_fetch_assoc($result);
        $name = $row['name'];
        $id = $row['id'];
        $_SESSION['name'] = $name;
        $_SESSION['id'] = $id;
        $_SESSION['logged_in'] = true;
        $_SESSION['email'] = $cookie_email;
        setcookie("email", $cookie_email, time() + (86400 * 30), "/");
        setcookie("password", $cookie_password, time() + (86400 * 30), "/");
        header("Location: ../index.php");
        exit();
    }
}
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
        $query = "SELECT name,id FROM user_data WHERE e_mail = '$email'";
        $result = $mysqli->query($query);
        $row = mysqli_fetch_assoc($result);
        $name = $row['name'];
        $id = $row['id'];
        $_SESSION['name'] = $name;
        $_SESSION['id'] = $id;
        $_SESSION['logged_in'] = true;
        $_SESSION['email'] = $email;
        setcookie("email", $email, time() + (86400 * 30), "/");
        setcookie("password", $password, time() + (86400 * 30), "/");
        header("Location: ../index.php");
        exit();
    }
    else {
        $_SESSION['logged_in'] = false;
        echo'<script>pop_up("Błędnie dane!");</script>';
    }
}
$mysqli->close();
?>
<body>
<div class="container">
    <div class="login-form">
        <h2>Logowanie</h2>
        <form method="POST">
            <input type="email" name="email" placeholder="E-mail">
            <input type="password" name="password" placeholder="Hasło">
            <input type="submit" value="Zaloguj"><br><br>
            <div><a href="register.php">Nie masz konta zarejestruj się kliknij tutaj</a></div>
        </form>
    </div>
</div>
</body>
