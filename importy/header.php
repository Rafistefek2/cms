<!DOCTYPE html>
<html lang="en">
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

<header>
    <nav>
        <a href="#" class="pagelogo">CMS</a>
        <button id="menu-button" aria-expanded="false">☰ Menu</button>
        <ul id="menu">
            <?php 
                if(!isset($_SESSION["username"])){
                    ?>
                        <li>
                            <a href="/cms/">Log in</a>
                    </li>
            <?php
                }
            ?>
            <li>
                <a href="/cms/dashboard.php">Dashboard</a>
            </li>
            <?php 
                if(isset($_SESSION["username"])){
                    ?>
                        <li>
                            <a href="/cms/logout.php">Logout</a>
                    </li>
            <?php
                }
            ?>
        </ul>
        </nav>
</header>
