<?php
include '../php_function/sidebar.php';
include '../php_function/head.php';
include '../php_function/show_orders.php';
head_for_subdomain_p_chosen();
sidebar_for_subdomain();
show_orders($_SESSION['id']);
?>


