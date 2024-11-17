<?php 

include('importy/bazadanych.php');
include('importy/funkcje.php');
include('importy/config.php');
Zaloguj_sie_zeby_odwiedzic();   //? strona dostępna tylko po zalogowaniu
chroniona_adminem();
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


if ($stm = $connect->prepare('SELECT * FROM users WHERE ID != 1')) {
    $stm->execute();

    //? bezpiecznie przesyłanie zmiennych do przygotowania statement

    $result = $stm->get_result();
    //var_dump($result->num_rows);
    
    if ($result->num_rows > 0) {
//var_dump($_SESSION)
?>

<div class="container width-7">
    <div class="row justify-content-center">
        <div class="md-10">
            <h1 class="page-title">Użytkownicy</h1>
            <button class="btn-add">
                <a href="usersmgm/usersadd.php">Dodaj nowego użytkownika</a>
            </button>
            <table class="table table-striped table-hover">
                <tr>
                    <th>Id</th>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Status</th>
                    <th>Administrator</th>
                    <th class="text-center"><span>Edytuj | Usuń</span></th>
                </tr>
                <?php while ($record = $result->fetch_assoc()) { ?>
                    <tr>
                        <td><?php echo $record['ID']?></td>
                        <td><?php echo $record['username']?></td>
                        <td><?php echo $record['email']?></td>
                        <td class="td-bool"><?php echo $record['active']?></td>
                        <td class="td-bool"><?php echo $record['is_admin']?></td>
                        <td class="text-center">
                            <a href="/cms/usersmgm/usersedit.php?id=<?php echo $record['ID']?>">Edytuj</a> |
                            <a href="/cms/users.php?delete=<?php echo $record['ID']?>">Usuń</a>
                        </td>
                    </tr>
                <?php } ?>
            </table>
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