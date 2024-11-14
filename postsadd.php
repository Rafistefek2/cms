<?php 

include('importy/bazadanych.php');
include('importy/funkcje.php');
include('importy/config.php');
Zaloguj_sie_zeby_odwiedzic();   //? strona dostępna tylko po zalogowaniu

include('importy/header.php');

if (isset($_POST['title'])) {
    if ($stm = $connect->prepare('INSERT INTO posts(title,content,autor,date) VALUES (?, ?, ?, ?)')) {
        $stm->bind_param('ssss', $_POST['title'], $_POST['content'], $_SESSION['id'], $_POST['date']);
        $stm->execute();
        //? dodawanie posta o podanych zmiennych

        set_message('Nowy post "' . $_POST['title'] .'" został dodany');
        header('Location:users.php');

        $stm->close();
        die();
        
    }
    else {
        echo'statement problem nie można przygotować';
    }
}

?>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <h1 class="display-1">Dodaj post</h1>
            <form method="post">
                <!-- title input -->
                <div data-mdb-input-init class="form-outline mb-4">
                    <input type="text" id="title" class="form-control" name="title"/>
                    <label class="form-label" for="email">Tytuł</label>
                </div>

                <!-- content input -->
                <div data-mdb-input-init class="form-outline mb-4">
                    <input type="" id="content" class="form-control" name="content"/>
                    <label class="form-label" for="content">Content</label>
                </div>

                
                <!-- date select -->
                <div data-mdb-input-init class="form-outline mb-4">
                    <input type="date" id="date" class="form-control" name="date">
                    <label class="form-label" for="date">Data</label>
                </div>

                <!-- Submit button -->
                <button data-mdb-ripple-init type="submit" class="btn btn-primary btn-block">Add post</button>
            </form>
        </div>
    </div>
</div>

<?php        


include("importy/footer.php");
?>