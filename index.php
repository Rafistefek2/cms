<?php 
// var_dump($_SERVER['DOCUMENT_ROOT']);
include('importy/bazadanych.php');
include('importy/funkcje.php');
include('importy/config.php');
include('importy/header.php');

if (isset($_SESSION['id'])) {
    header('Location:dashboard.php');
    die();
}   


//? działanie login form 
if (isset($_POST['email'])) {
    if ($stm = $connect->prepare('SELECT * FROM users WHERE email = ? AND password = ?')) {
        $hashed = SHA1($_POST['password']);
        $stm->bind_param('ss', $_POST['email'], $hashed);
        $stm->execute();

        //? bezpiecznie przesyłanie zmiennych do przygotowania statement

        $result = $stm->get_result();
        $user = $result->fetch_assoc();
        
        if ($user) {

            if ($user['active'] == 0) {
                set_message("User account is inactive.");
                header("Location:/cms/");
                die();
            }
            else {
                //? przechowywanie informacji o uzytkowniku w sesji
                $_SESSION['email'] = $user['email'];
                $_SESSION['id'] = $user['ID'];
                $_SESSION['username'] = $user['username'];

                //? informacja o zalogowaniu
                set_message('Zalogowano jako ' . $_SESSION['username']);

                header('Location:dashboard.php');
                die();
            }
        }
        $stm->close();
    }
    else {
        echo'statement problem nie można przygotować';
    }
} 
?>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <form method="post">
                <!-- Email input -->
                <div data-mdb-input-init class="form-outline mb-4">
                    <input type="email" id="email" class="form-control" name="email"/>
                    <label class="form-label" for="email">Email address</label>
                </div>

                <!-- Password input -->
                <div data-mdb-input-init class="form-outline mb-4">
                    <input type="password" id="password" class="form-control" name="password"/>
                    <label class="form-label" for="password">Password</label>
                </div>

                <!-- Submit button -->
                <button data-mdb-ripple-init type="submit" class="btn btn-primary btn-block">Sign in</button>
            </form>
        </div>
    </div>
</div>

<?php
include("importy/footer.php");
?>