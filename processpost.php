<?php 
    include("importy/bazadanych.php");
    include("importy/funkcje.php");
    include("importy/config.php");

    $data = $_POST['data'] ?? 'No data received';
    
    $path = __DIR__ . "/usersposts/" . $_SESSION['id'];

    $filename = $path . "/" . str_replace(" ", "_",$_POST['title']) . ".md";

    if (!is_dir($path)) {
        mkdir($path, 0777, true);
    }
    
    if (file_put_contents($filename, $data) === false) {
        set_message("Błąd przy zatwierdzaniu posta", "error");
    }
    else{
        set_message("Pomyślnie zatwierdzono dane do posta", "success");
    }
?>