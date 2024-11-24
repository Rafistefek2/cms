<?php 
// var_dump($_SERVER['DOCUMENT_ROOT']);
include('importy/bazadanych.php');
include('importy/funkcje.php');
include('importy/config.php');
include('importy/header.php');
include('importy/MarkdownParser.php');
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
<script src="/cms/js/post-logic.js"></script>
<div class="width-10">
    <div class="row">
        <div class="relative-width md-10">
            <?php
            $postCounter = 1; //? zacznie zliczac posty

            while ($record = $result->fetch_assoc()) {
                $isPrivate = $record['private'] == 1;
                $canView = $isPrivate ? isset($_SESSION['username']) : true;
                
                if ($canView) { ?>
                    <div class="post" style="--order: <?php echo $postCounter; ?>">
                        <span class="post-title"><?php echo $record['title']; ?></span>
                        <span class="post-date"><?php echo $record['date']; ?></span>
                        <span class="post-autor">Autor: <?php echo $record['username']; ?></span>
                        <div class="post-content post-hidden" aria-expanded="false">
                        <?php
                            if (file_exists($record['content']) && is_readable($record['content'])) {
                                $content = file_get_contents($record['content']);

                                $Parsedown = new Parsedown();
                                echo nl2br($Parsedown->text($content));

                            } else {
                                echo "File does not exist or cannot be read.";
                            }
                        ?>
                        </div>
                        <?php if (!$isPrivate) { ?>
                            <button class="btn-show">czytaj więcej</button>
                        <?php } ?>
                    </div>
            <?php } 
                $postCounter++;     //? zwiększa counter
            } ?>
        </div>
        <div class="right">
            <div class="info">
                <span class="gradient-text">Liczba zarejestrowantych: <?php echo $usersnum['liczbaUzytkownikow']?></span>
                <?php 
                    if (isset($_SESSION['username'])) {
                        ?>
                            <hr>
                            <span class="gradient-text">Zalogowano jako: <?php echo $_SESSION['username']?></span>
                        <?php
                    }
                ?>
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