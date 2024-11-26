<?php 
    include("importy/bazadanych.php");
    include("importy/funkcje.php");
    include("importy/config.php");

    $data = $_POST['data'] ?? 'No data received';
    
    $path = __DIR__ . "/usersposts/" . $_SESSION['id'];

    $filename = $path . "/" . uniqid() . ".md";

    if (!is_dir($path)) {
        mkdir($path, 0777, true);
    }
    
    if (file_put_contents($filename, $data) === false) {
        header("Location: /cms/");
        set_message("Błąd przy zatwierdzaniu posta", "error");
    }
    else{
        if (isset($_POST['title'])) {
            if ($stm = $connect->prepare('INSERT INTO posts(title,content,private,autor,date) VALUES (?, ?, ?, ?, ?)')) {
                $stm->bind_param('sssss', $_POST['title'], $filename,$_POST['private'], $_SESSION['id'], $_POST['date']);
                $stm->execute();
                //? dodawanie posta o podanych zmiennych i ścieżce do jego pliku
        
                set_message("Pomyślnie zatwierdzono dane do posta", "success");
                header("Location: /cms/");
        
                $stm->close();
                die();
                
            }
            else {
                echo'statement problem nie można przygotować';
            }
        }
    }
?>