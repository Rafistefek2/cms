<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CMS</title>
    <!-- Font Awesome -->
    <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"
    />
    <!-- Google Fonts Roboto -->
    <link
        rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700;900&display=swap"
    />
    <!-- Styleeee -->
    <link rel="stylesheet" href="/cms/css/general.css" />       <!-- ogólne elementy strony -->
    <link rel="stylesheet" href="/cms/css/menu.css" />      <!-- style do górnej części strony -->
    <link rel="stylesheet" href="/cms/css/tosty.css"/>      <!-- style do tosta -->
</head>
<body>
<?php
    if ($stm = $connect->prepare('SELECT COUNT(ID) as liczbaUzytkownikow FROM users WHERE is_admin != 1;')) {
        $stm->execute();
    
        $result = $stm->get_result();
        // var_dump( $result->fetch_assoc() );
        $usersnum = $result->fetch_assoc();
    }
?>
<header>
    <nav>
        <a href="/cms/" class="pagelogo">CMS</a>
        <button id="menu-button" aria-expanded="false"><i class="fas fa-bars"></i></button>
        <ul id="menu">
                
            <?php 
                if(!isset($_SESSION["username"])){
            ?>  
                <li class="indent">
                    <a href="/cms/login.php">Zaloguj</a>
                </li>
                <li class="indent">
                    <a href="/cms/register.php">Zarejestruj</a>
                </li>
            <?php
                }
                if(isset($_SESSION["is_admin"]) && $_SESSION["is_admin"] == 1){
            ?>
                <li class="indent">
                    <a href="/cms/dashboard.php">Dashboard</a>
                </li>
            <?php
                }
                if(isset($_SESSION["username"])){
            ?>
                <li class="indent">
                    <a href="/cms/userspostadd.php">Dodaj post</a>
                </li>
                <li class="indent">
                    <a href="/cms/logout.php">Wyloguj</a>
                </li>
            <?php
                }
            ?>
        </ul>
        </nav>
</header>
