<?php 
// var_dump($_SERVER['DOCUMENT_ROOT']);
include('importy/bazadanych.php');
include('importy/funkcje.php');
include('importy/config.php');
include('importy/header.php');


?>
Main file

<?php 
    if(isset($_SESSION['username'])){
        ?>
            <p>
                to jest kontent dla zalogowanych
            </p>
        <?php
    }
    if(isset($_SESSION['is_admin']) && $_SESSION['is_admin'] == 1){
        ?>
            <p>
                to jest kontent dla adminow
            </p>
        
        <?php
    }
?>


<?php
include("importy/footer.php");
?>