<?php
function sidebar(){
    echo '
    <div class="sidebar">
    <div><img src="img/drewnosklep-logo.png" alt="drewnosklep-logo" width="200" height="150"></div>
    <div><a href="index.php">Strona Główna</a></div>
    <div><a href="subdomain/products.php">Produkty</a></div>';
    if(isset($_SESSION['logged_in']) && $_SESSION['logged_in']){

        echo '<div><a href="subdomain/logout.php">Logout</a></div>';
    }
    else{
        echo '<div><a href="subdomain/login.php">Login</a></div>';
    }
    if(isset($_SESSION['logged_in']) && $_SESSION['logged_in']) {
        echo '<div><a href="subdomain/cart.php">Koszyk</a></div>';
        echo '<div><a href="subdomain/order_history.php">Historia zmówień</a></div>';
    }
    echo '<button class="toggle-button" onclick="toggleSidebar()">
        <img src="img/hidden.png" alt="hidde" width="75" height="75">
    </button>';
    if(isset($_SESSION['logged_in']) && $_SESSION['logged_in']) {
        echo 'Cześć: ';
        echo $_SESSION['name'];
    }
        echo '
</div>
    ';}

    function sidebar_for_subdomain(){
        echo '
    <div class="sidebar">
    <div><img src="../img/drewnosklep-logo.png" alt="drewnosklep-logo" width="200" height="150"></div>
    <div><a href="../index.php">Strona Główna</a></div>
    <div><a href="../subdomain/products.php">Produkty</a></div>';
    if(isset($_SESSION['logged_in']) && $_SESSION['logged_in']){
        echo '<div><a href="../subdomain/logout.php">Logout</a></div>';
    }
    else{
        echo '<div><a href="../subdomain/login.php">Login</a></div>';
    }
        if(isset($_SESSION['logged_in']) && $_SESSION['logged_in']) {
            echo '<div><a href="../subdomain/cart.php">Koszyk</a></div>';
            echo '<div><a href="../subdomain/order_history.php">Historia zmówień</a></div>';
        }
    echo '
    <button class="toggle-button" onclick="toggleSidebar()">
        <img src="../img/hidden.png" alt="hidde" width="75" height="75">
    </button>
</div>
    ';}
