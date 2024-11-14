<?php

//? blokowanie strony jeśli użytkownik nie jest zalogowany
function Zaloguj_sie_zeby_odwiedzic() {
    if (!isset($_SESSION['id'])) {
        set_message('Najpierw zaloguj się żeby zobaczyć te stronę');
        header('Location:/cms/');
        die();
    }     
}


function set_message($message){
    {
        $_SESSION['message'] = $message;
    }
}

function get_message(){
    if(isset($_SESSION['message'])){
        echo "<script type='text/javascript'>dawajTosta('" . $_SESSION['message'] ."', 'top right', 'success')</script>";
        unset($_SESSION['message']);
    }
}