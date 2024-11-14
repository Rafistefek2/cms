<?php
$connect = mysqli_connect(
    "localhost",
    "CMS",
    "admin",
    "cms"
);

if(mysqli_connect_errno()){
    exit("Błąd w połączeniu z bazą danych CMS: " . mysqli_connect_error());

}