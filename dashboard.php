<?php 

include('importy/bazadanych.php');
include('importy/funkcje.php');
include('importy/config.php');
Zaloguj_sie_zeby_odwiedzic();   //? strona dostępna tylko po zalogowaniu
chroniona_adminem();

include('importy/header.php');


//var_dump($_SESSION)
?>

<div class="container width-5">
    <div class="row">
        <div class="md-10">
            <h1 class="page-title">Dashboard</h1>
            <a href="users.php">Zarządzanie użytkownikami</a> |
            <a href="posts.php">Zarządzanie postami</a> |
            <a href="" class="inactive">Zarządzanie </a>
        </div>
    </div>
</div>

<?php
include("importy/footer.php");
?>