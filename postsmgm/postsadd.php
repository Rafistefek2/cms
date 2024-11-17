<?php 

include('../importy/bazadanych.php');
include('../importy/funkcje.php');
include('../importy/config.php');
Zaloguj_sie_zeby_odwiedzic();   //? strona dostępna tylko po zalogowaniu
chroniona_adminem();
include('../importy/header.php');

if (isset($_POST['title'])) {
    if ($stm = $connect->prepare('INSERT INTO posts(title,content,private,autor,date) VALUES (?, ?, ?, ?, ?)')) {
        $stm->bind_param('sssss', $_POST['title'], $_POST['content'],$_POST['private'], $_SESSION['id'], $_POST['date']);
        $stm->execute();
        //? dodawanie posta o podanych zmiennych

        set_message('Nowy post "' . $_POST['title'] .'" został dodany', "success");
        header('Location:../posts.php');

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
                <div class="form-outline mb-4">
                    <input placeholder="" required type="text" id="title" class="form-control" name="title"/>
                    <label class="form-label" for="email">Tytuł</label>
                </div>

                <!-- content input -->
                <div class="form-outline mb-4">
                    <input placeholder="" required type="" id="content" class="form-control" name="content"/>
                    <label class="form-label" for="content">Content</label>
                </div>

                <!-- private select -->
                <div class="form-outline mb-4">
                    <select name="private" id="private" class="form-select">
                        <option value="0">Publiczny</option>
                        <option value="1">Prywatny</option>
                    </select>
                </div>
                
                <!-- date input -->
                <div class="form-outline mb-4">
                    <input placeholder="" required type="date" id="date" class="form-control" name="date">
                    <label class="form-label" for="date">Data</label>
                </div>

                <!-- Submit button -->
                <button type="submit" class="btn-accept">Dodaj post</button>
            </form>
        </div>
    </div>
</div>

<?php        


include("../importy/footer.php");
?>