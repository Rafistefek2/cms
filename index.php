<?php 
// var_dump($_SERVER['DOCUMENT_ROOT']);
include('importy/bazadanych.php');
include('importy/funkcje.php');
include('importy/config.php');
include('importy/header.php');
    if ($stm = $connect->prepare('SELECT COUNT(ID) as liczbaUzytkownikow FROM users WHERE is_admin != 1;')) {
        $stm->execute();
    
        $result = $stm->get_result();
        // var_dump( $result->fetch_assoc() );
        $usersnum = $result->fetch_assoc();
    }

if ($stm = $connect->prepare('SELECT * FROM posts JOIN users ON users.ID = posts.autor ORDER BY date DESC;')) {
    $stm->execute();

    $result = $stm->get_result();
    //var_dump($result->num_rows);
    
    if ($result->num_rows > 0) {
//var_dump($_SESSION)
?>

<div class="width-10">
    <div class="row">
        <div class="column md-10">
            <?php 
            while ($record = $result->fetch_assoc()) {
                if ($record['private'] == 1) {
                    if(isset($_SESSION['username'])) {   //? tutaj są posty prywatne
                    ?>
                        <div class="post">
                            <span class="post-title"><?php echo $record['title']?></span>
                            <span class="post-date"><?php echo $record['date']?></span>
                            <span class="post-autor">Autor: <?php echo $record['username']?></span>
                            <div class="post-content"><?php echo $record['content']?></div>
                        </div>
                    <?php
                    }
                }
                else{   //? tu są posty publiczne
                    ?>
                        <div class="post">
                            <span class="post-title"><?php echo $record['title']?></span>
                            <span class="post-date"><?php echo $record['date']?></span>
                            <span class="post-autor">Autor: <?php echo $record['username']?></span>
                            <div class="post-content"><?php echo $record['content']?></div>
                        </div>
                    <?php
                }
            } 
            ?>
        </div>
        <div class="right">
            <div class="info">
                <span class="gradient-text">Liczba zarejestrowantych: <?php echo $usersnum['liczbaUzytkownikow']?></span>
                <hr>
                <span class="gradient-text">inna liczba np pi</span>
                <hr>
                <span class="gradient-text">jeszcze inna liczba 14</span>
            </div>
        </div>
    </div>
</div>

<?php        
    }
    else {
        echo'nie znaleziono posta';
    }
        
    $stm->close();
}
else {
    echo'statement problem nie można przygotować';
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