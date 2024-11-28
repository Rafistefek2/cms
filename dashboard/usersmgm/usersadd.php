<?php 

include('../../importy/bazadanych.php');
include('../../importy/funkcje.php');
include('../../importy/config.php');
Zaloguj_sie_zeby_odwiedzic();   //? strona dostępna tylko po zalogowaniu
chroniona_adminem();
include('../../importy/header.php');

if (isset($_POST['username'])) {
    if ($stm = $connect->prepare('INSERT INTO users(username,email,password,active) VALUES (?, ?, ?, ?)')) {
        $hashed = SHA1($_POST['password']);
        $stm->bind_param('ssss', $_POST['username'], $_POST['email'], $hashed, $_POST['active']);
        $stm->execute();
        //? dodawanie użytkownika o podanych zmiennych

        set_message('Nowy użytkownik ' . $_POST ['username'] .' został dodany', "success");
        header('Location:../users.php');

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
            <h1 class="display-1">Dodaj użytkownika</h1>
            <form method="post">
                <!-- Username input -->
                <div class="form-outline mb-4">
                    <input placeholder="" required type="text" id="username" class="form-control" name="username" />
                    <label class="form-label" for="email">Username</label>
                </div>
                <!-- Email input -->
                <div class="form-outline mb-4">
                    <input placeholder="" required type="email" id="email" class="form-control" name="email" />
                    <label class="form-label" for="email">Email address</label>
                </div>

                <!-- Password input -->
                <div class="form-outline mb-4">
                    <input placeholder="" required type="password" id="password" class="form-control" name="password" />
                    <label class="form-label" for="password">Password</label>
                </div>


                <!-- Active select -->
                <div class="form-outline mb-4">
                    <select name="active" id="active" class="form-select">
                        <option value="1">Active</option>
                        <option value="0">Inctive</option>
                    </select>
                </div>

                <!-- Submit button -->
                <button type="submit" class="btn-accept ">Dodaj użytkownika</button>
            </form>
        </div>
    </div>
</div>

<?php        


include("../../importy/footer.php");
?>