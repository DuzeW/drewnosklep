<?php
function sidebar(){
    echo '
    <div class="sidebar">
    <div><img src="img/drewnosklep-logo.png" alt="drewnosklep-logo" width="200" height="150"></div>
    <div><a href="index.php">Strona Główna</a></div>
    <div><a href="subdomain/products.php">Produkty</a></div>
    <div><a href="subdomain/login.php">Login</a></div>
    <button class="toggle-button" onclick="toggleSidebar()">
        <img src="img/hidden.png" alt="hidde" width="75" height="75">
    </button>
</div>
    ';}

    function sidebar_for_subdomain(){
        echo '
    <div class="sidebar">
    <div><img src="../img/drewnosklep-logo.png" alt="drewnosklep-logo" width="200" height="150"></div>
    <div><a href="../index.php">Strona Główna</a></div>
    <div><a href="../subdomain/products.php">Produkty</a></div>
    <div><a href="../subdomain/login.php">Login</a></div>
    <button class="toggle-button" onclick="toggleSidebar()">
        <img src="../img/hidden.png" alt="hidde" width="75" height="75">
    </button>
</div>
    ';}
