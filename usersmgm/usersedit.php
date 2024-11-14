<?php 

include('../importy/bazadanych.php');
include('../importy/funkcje.php');
include('../importy/config.php');
Zaloguj_sie_zeby_odwiedzic();   //? strona dostępna tylko po zalogowaniu

include('../importy/header.php');

if (isset($_POST['username'])) {
    //? aktualizowanie danych użytkownika
    if ($stm = $connect->prepare('UPDATE users SET username = ?, email = ?, active = ? WHERE id = ?')) {
        $stm->bind_param('sssi', $_POST['username'], $_POST['email'], $_POST['active'], $_GET['id']);
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
        header('Location:../users.php');
        die();
    }
    else {
        echo'user update statement problem nie można przygotować';
    }
}

if (isset($_GET['id'])) {
    if ($stm = $connect->prepare('SELECT * FROM users WHERE id = ?')) {
        $stm->bind_param('i', $_GET['id']);
        $stm->execute();

        $result = $stm->get_result();
        $user = $result->fetch_assoc();
        
        if ($user) {
?>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <h1 class="display-1">Edytuj użytkownika</h1>
            <form method="post">
                <!-- Username input -->
                <div data-mdb-input-init class="form-outline mb-4">
                    <input type="text" id="username" class="form-control active" name="username" value="<?php echo $user['username']?>"/>
                    <label class="form-label" for="email">Username</label>
                </div>
                <!-- Email input -->
                <div data-mdb-input-init class="form-outline mb-4">
                    <input type="email" id="email" class="form-control active" name="email" value="<?php echo $user['email']?>"/>
                    <label class="form-label" for="email">Email address</label>
                </div>

                <!-- Password input -->
                <div data-mdb-input-init class="form-outline mb-4">
                    <input type="password" id="password" class="form-control" name="password" />
                    <label class="form-label" for="password">Password</label>
                </div>

                
                <!-- Active select -->
                <div data-mdb-input-init class="form-outline mb-4">
                    <select name="active" id="active" class="form-select">
                        <!-- skrócony if, wyswietlanie ktore pole jest zaznaczone    -->
                        <option <?php echo ($user['active']) ? 'selected' : ''; ?> value="1">Active</option>
                        <option <?php echo ($user['active']) ? '' : 'selected'; ?> value="0">Inctive</option>
                    </select>
                </div>

                <!-- Submit button -->
                <button data-mdb-ripple-init type="submit" class="btn btn-primary btn-block">Update user</button>
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
    echo "Nie wybrano użytkownika";
    die();
}

include("../importy/footer.php");
?>