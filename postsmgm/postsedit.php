<?php 

include('../importy/bazadanych.php');
include('../importy/funkcje.php');
include('../importy/config.php');
Zaloguj_sie_zeby_odwiedzic();   //? strona dostępna tylko po zalogowaniu

include('../importy/header.php');

if (isset($_POST['title'])) {
    //? aktualizowanie danych posta
    if ($stm = $connect->prepare('UPDATE posts SET title = ?, content = ?, date = ? WHERE id = ?')) {
        $stm->bind_param('sssi', $_POST['title'], $_POST['content'], $_POST['date'], $_GET['id']);
        $stm->execute();

        $stm->close();
        
        //? jeśli zmienione hasło
        if (isset($_POST['password'])) {
            if ($stm = $connect->prepare('UPDATE users SET password = ? WHERE id = ?')) {
                $hashed = SHA1($_POST['password']);
                $stm->bind_param('si', $hashed, $_GET['id']);
                $stm->execute();
            }
            else {
                echo'password update statement problem nie można przygotować';
            }
        }
        set_message('Zmiany dala użytkownika o id ' . $_GET['id'] .' zostały wprowadzone', "success");
        header('Location:../posts.php');
        die();
    }
    else {
        echo'user update statement problem nie można przygotować';
    }
}

if (isset($_GET['id'])) {
    if ($stm = $connect->prepare('SELECT * FROM posts WHERE id = ?')) {
        $stm->bind_param('i', $_GET['id']);
        $stm->execute();

        $result = $stm->get_result();
        $post = $result->fetch_assoc();
        if ($post) {
?>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <h1 class="display-1">Edytuj posta</h1>
            <form method="post">
                <!-- title input -->
                <div data-mdb-input-init class="form-outline mb-4">
                    <input type="text" id="title" class="form-control" name="title" value="<?php echo $post['title']?>"/>
                    <label class="form-label" for="email">Tytuł</label>
                </div>

                <!-- content input -->
                <div data-mdb-input-init class="form-outline mb-4">
                    <input type="" id="content" class="form-control" name="content" value="<?php echo $post['content']?>"/>
                    <label class="form-label" for="content">Content</label>
                </div>

                
                <!-- date select -->
                <div data-mdb-input-init class="form-outline mb-4">
                    <input type="date" id="date" class="form-control" name="date" value="<?php echo $post['date']?>">
                    <label class="form-label" for="date">Data</label>
                </div>

                <!-- Submit button -->
                <button data-mdb-ripple-init type="submit" class="btn btn-primary btn-block">Edit post</button>
            </form>
        </div>
    </div>
</div>

<?php        
        }
        $stm->close();
    }
    else {
        echo'statement problem nie można przygotować';
    }
}else {
    echo "Nie wybrano posta";
    die();
}

include("../importy/footer.php");
?>