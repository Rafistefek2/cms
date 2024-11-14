<?php 

include('importy/bazadanych.php');
include('importy/funkcje.php');
include('importy/config.php');
Zaloguj_sie_zeby_odwiedzic();   //? strona dostępna tylko po zalogowaniu
include('importy/header.php');


if (isset($_GET['delete'])) {
    if ($stm = $connect->prepare('DELETE FROM posts WHERE id = ?')) {
        $hashed = SHA1($_POST['password']);
        $stm->bind_param('i', $_GET['delete']);
        $stm->execute();
        //? usuwanie uzytkownika o id $_GET['delete']

        set_message('Post o id ' . $_GET['delete'] .' został usunięty', "success");
        header('Location:posts.php');

        $stm->close();
        die();
        
    }
    else {
        echo'statement problem nie można przygotować';
    }
}


if ($stm = $connect->prepare('SELECT * FROM posts')) {
    $stm->execute();

    //? bezpiecznie przesyłanie zmiennych do przygotowania statement

    $result = $stm->get_result();
    //var_dump($result->num_rows);
    
    if ($result->num_rows > 0) {
//var_dump($_SESSION)
?>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <h1 class="display-1">Posty</h1>
            <table class="table table-striped table-hover">
                <tr>
                    <th>Id</th>
                    <th>Tytuł</th>
                    <th>Autor ID</th>   <!--TODO Zmienić na username autora (querry)-->
                    <th>Kontent</th>
                    <th>Edytuj | Usuń</th>
                </tr>
                <?php while ($record = $result->fetch_assoc()) { ?>
                    <tr>
                        <td><?php echo $record['ID']?></td>
                        <td><?php echo $record['title']?></td>
                        <td><?php echo $record['autor']?></td>
                        <td><?php echo $record['content']?></td>
                        <td>
                            <a href="/cms/postsmgm/postsedit.php?id=<?php echo $record['ID']?>">Edytuj</a> |
                            <a href="/cms/posts.php?delete=<?php echo $record['ID']?>">Usuń</a>
                        </td>
                    </tr>
                <?php } ?>
            </table>
            <a href="postsmgm/postsadd.php">Dodaj nowego posta</a>
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

include("importy/footer.php");
?>