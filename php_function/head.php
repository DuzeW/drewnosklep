<?php
session_start();
function head_for_subdomain(){
    echo '
    <head>
    <meta charset="utf-8">
    <meta name="description" content="sklep z deskami" />
    <meta name="keywords" content="Deski" />
    <link rel="Shortcut icon" href="../img/d-logo.png"/>
    <link rel="stylesheet" type="text/css" href="../css/css.css">
    <script src="../js/toggle.js"></script>
    <title>DrewnoSklep</title>
</head>
    ';
}
function head_for_subdomain_p_chosen(){
    echo '
    <head>
    <meta charset="utf-8">
    <meta name="description" content="sklep z deskami" />
    <meta name="keywords" content="Deski" />
    <link rel="Shortcut icon" href="../img/d-logo.png"/>
    <link rel="stylesheet" type="text/css" href="../css/css.css">
    <link rel="stylesheet" type="text/css" href="../css/cart.css">
    <script src="../js/toggle.js"></script>
    <title>DrewnoSklep</title>
</head>
    ';
}

function head_for_login(){
    echo '
    <head>
    <meta charset="utf-8">
    <meta name="description" content="sklep z deskami" />
    <meta name="keywords" content="Deski" />
    <link rel="Shortcut icon" href="../img/d-logo.png"/>
    <link rel="stylesheet" type="text/css" href="../css/login.css">
    <script src="../js/pop_up.js"></script>
    <script src="../js/toggle.js"></script>
    <title>DrewnoSklep</title>
</head>
    ';
}