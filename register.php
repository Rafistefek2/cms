<?php 

include('importy/bazadanych.php');
include('importy/funkcje.php');
include('importy/config.php');
include('importy/header.php');



if (isset($_POST['email'])) {

    echo "testuje";

    if ($stm = $connect->prepare("INSERT INTO `users`(`username`, `email`, `password`, `active`, `is_admin`) VALUES (?, ?, ?, 1, 0);")) {

        $hashed = SHA1($_POST['password']);
        $stm->bind_param('sss', $_POST['username'],$_POST['email'], $hashed,);
        $stm->execute();
        $result = $stm->get_result();

        set_message("Pomyślnie dodano użytkownika", "success");
        header("Location:/cms/login.php");


        $stm->close();
        die();
    }
    else {
        echo'statement problem nie można przygotować';
    }
} 
?>
<!-- bednarczyk by wypadł z kapci jakby zobaczył te animacje -->
<div class="container width-5 background-animation">
    <div class="row justify-content-center milky-background border-rounded">
        <div class="md-6">
            <form method="post" class="align-items-center">
                <!-- Username input -->
                <h1 class='page-title'>Rejestracja</h1>
                <div class="form-outline">
                    <input placeholder="" required type="text" id="username" class="form-control" name="username" />
                    <label class="form-label" for="username">Username</label>
                </div>

                <!-- Email input -->
                <div class="form-outline">
                    <input placeholder="" required type="email" id="email" class="form-control" name="email" />
                    <label class="form-label" for="email">Email address</label>
                </div>

                <!-- Password input -->
                <div class="form-outline">
                    <input placeholder="" required type="password" id="password" class="form-control" name="password" />
                    <label class="form-label" for="password">Password</label>
                </div>

                <!-- Repeat Password input -->
                <div class="form-outline">
                    <input placeholder="" required type="password" id="repeat-password" class="form-control"
                        name="repeat-password" />
                    <label class="form-label" for="repeat-password">Repeat Password</label>
                </div>

                <!-- Submit button -->
                <button type="submit" id="register-btn" class="btn-disabled" disabled>Zarejestruj</button>
                <script src='js/register-form.js'></script>
            </form>
        </div>
    </div>
</div>

<?php
include("importy/footer.php");
?>