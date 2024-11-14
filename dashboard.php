<?php 

include('importy/bazadanych.php');
include('importy/funkcje.php');
include('importy/config.php');
Zaloguj_sie_zeby_odwiedzic();   //? strona dostępna tylko po zalogowaniu

include('importy/header.php');


//var_dump($_SESSION)
?>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <h1 class="display-1">Dashboard</h1>
            <a href="users.php">Zarządzanie użytkownikami</a> |
            <a href="posts.php">Zarządzanie postami</a>
        </div>
    </div>
</div>

<?php
include("importy/footer.php");
?>