<?php 

include('../importy/bazadanych.php');
include('../importy/funkcje.php');
include('../importy/config.php');
Zaloguj_sie_zeby_odwiedzic();   //? strona dostępna tylko po zalogowaniu
chroniona_adminem();
include('../importy/header.php');

if (isset($_POST['username'])) {
    //? aktualizowanie danych użytkownika
    if ($stm = $connect->prepare('UPDATE users SET username = ?, email = ?, active = ?, is_admin = ? WHERE id = ?')) {
        $stm->bind_param('ssssi', $_POST['username'], $_POST['email'], $_POST['active'], $_POST['is_admin'], $_GET['id']);
        $stm->execute();

        $stm->close();
        
        //? jeśli zmienione hasło
        if (isset($_POST['password']) && !empty($_POST['password'])) {
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
                <div class="form-outline mb-4">
                    <input placeholder="" type="text" id="username" class="form-control active" name="username" value="<?php echo $user['username']?>"/>
                    <label class="form-label" for="email">Username</label>
                </div>
                <!-- Email input -->
                <div class="form-outline mb-4">
                    <input placeholder="" type="email" id="email" class="form-control active" name="email" value="<?php echo $user['email']?>"/>
                    <label class="form-label" for="email">Email address</label>
                </div>

                <!-- Password input -->
                <div class="form-outline mb-4">
                    <input placeholder="" type="password" id="password" class="form-control" name="password" />
                    <label class="form-label" for="password">Password</label>
                </div>

                <!-- admin select -->
                <div class="form-outline mb-4">
                    <select name="is_admin" id="is_admin" class="form-select">
                        <!-- skrócony if, wyswietlanie ktore pole jest zaznaczone    -->
                        <option <?php echo ($user['is_admin']) ? 'selected' : ''; ?> value="1">Administrator</option>
                        <option <?php echo ($user['is_admin']) ? '' : 'selected'; ?> value="0">Użytkownik</option>
                    </select>
                </div>
                
                <!-- Active select -->
                <div class="form-outline mb-4">
                    <select name="active" id="active" class="form-select">
                        <!-- skrócony if, wyswietlanie ktore pole jest zaznaczone    -->
                        <option <?php echo ($user['active']) ? 'selected' : ''; ?> value="1">Active</option>
                        <option <?php echo ($user['active']) ? '' : 'selected'; ?> value="0">Inctive</option>
                    </select>
                </div>

                <!-- Submit button -->
                <button type="submit" class="btn-accept">Aktualizuj</button>
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