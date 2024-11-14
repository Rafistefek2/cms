<?php 

include('importy/bazadanych.php');
include('importy/funkcje.php');
include('importy/config.php');
Zaloguj_sie_zeby_odwiedzic();   //? strona dostępna tylko po zalogowaniu

include('importy/header.php');

if (isset($_GET['delete'])) {
    if ($stm = $connect->prepare('DELETE FROM users WHERE id = ?')) {
        $hashed = SHA1($_POST['password']);
        $stm->bind_param('i', $_GET['delete']);
        $stm->execute();
        //? usuwanie uzytkownika o id $_GET['delete']

        set_message('Użytkownik o id ' . $_GET['delete'] .' został usunięty', "success");
        header('Location:users.php');

        $stm->close();
        die();
        
    }
    else {
        echo'statement problem nie można przygotować';
    }
}


if ($stm = $connect->prepare('SELECT * FROM users')) {
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
            <h1 class="display-1">Użytkownicy</h1>
            <table class="table table-striped table-hover">
                <tr>
                    <th>Id</th>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Status</th>
                    <th>Edytuj | Usuń</th>
                </tr>
                <?php while ($record = $result->fetch_assoc()) { ?>
                    <tr>
                        <td><?php echo $record['ID']?></td>
                        <td><?php echo $record['username']?></td>
                        <td><?php echo $record['email']?></td>
                        <td><?php echo $record['active']?></td>
                        <td>
                            <a href="/cms/usersmgm/usersedit.php?id=<?php echo $record['ID']?>">Edytuj</a> |
                            <a href="/cms/users.php?delete=<?php echo $record['ID']?>">Usuń</a>
                        </td>
                    </tr>
                <?php } ?>
            </table>
            <a href="usersmgm/usersadd.php">Dodaj nowego użytkownika</a>
        </div>
    </div>
</div>

<?php        
    }
    else {
        echo'nie znaleziono użytkowników';
    }
        
    $stm->close();
}
else {
    echo'statement problem nie można przygotować';
}

include("importy/footer.php");
?>