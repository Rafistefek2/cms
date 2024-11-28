<?php 

include('../../importy/bazadanych.php');
include('../../importy/funkcje.php');
include('../../importy/config.php');
Zaloguj_sie_zeby_odwiedzic();   //? strona dostępna tylko po zalogowaniu
chroniona_adminem();
include('../../importy/header.php');

if (isset($_POST['title'])) {
    //? aktualizowanie danych posta
    if ($stm = $connect->prepare('UPDATE posts SET title = ?, content = ?,date = ?, private = ? WHERE id = ?')) {
        $stm->bind_param('ssssi', $_POST['title'], $_POST['content'], $_POST['date'], $_POST['private'], $_GET['id']);
        $stm->execute();

        $stm->close();
        

        set_message('Zmiany dala posta o id ' . $_GET['id'] .' zostały wprowadzone', "success");
        header('Location:../posts.php');
        die();
    }
    else {
        echo'post update statement problem nie można przygotować';
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
                <div class="form-outline mb-4">
                    <input placeholder="" required type="text" id="title" class="form-control" name="title"
                        value="<?php echo $post['title']?>" />
                    <label class="form-label" for="email">Tytuł</label>
                </div>

                <!-- content input -->
                <div class="form-outline mb-4">
                    <input placeholder="" required type="" id="content" class="form-control" name="content"
                        value="<?php echo $post['content']?>" />
                    <label class="form-label" for="content">Content</label>
                </div>

                <!-- private input -->
                <div class="form-outline mb-4">
                    <select name="private" id="private" class="form-select">
                        <!-- skrócony if, wyswietlanie ktore pole jest zaznaczone    -->
                        <option <?php echo ($post['private']) ? '' : 'selected'; ?> value="0">Publiczny</option>
                        <option <?php echo ($post['private']) ? 'selected' : ''; ?> value="1">Prywatny</option>
                    </select>
                </div>


                <!-- date select -->
                <div class="form-outline mb-4">
                    <input placeholder="" required type="date" id="date" class="form-control" name="date"
                        value="<?php echo $post['date']?>">
                    <label class="form-label" for="date">Data</label>
                </div>

                <!-- Submit button -->
                <button type="submit" class="btn-accept">Edit post</button>
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

include("../../importy/footer.php");
?>