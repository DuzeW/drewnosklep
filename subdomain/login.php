<?php
include '../php_function/head.php';
head_for_login();
?>
<?php
$msqli = new mysqli("localhost", "root", "", "drewnosklepdb");

$login_post = trim($_POST['e_mail']);
$haslo_post = trim($_POST['haslo']);
?>
<body>
<div class="container">
    <div class="login-form">
        <h2>Logowanie</h2>
        <form method="POST">
            <input type="text" placeholder="E-mail">
            <input type="password" placeholder="Hasło">
            <input type="submit" value="Zaloguj">
        </form>
    </div>
</div>
</body>
