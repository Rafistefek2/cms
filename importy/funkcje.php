<?php

//? blokowanie strony jeśli użytkownik nie jest zalogowany
function Zaloguj_sie_zeby_odwiedzic() {
    if (!isset($_SESSION['id'])) {
        set_message('Najpierw zaloguj się żeby zobaczyć te stronę', "warning");
        header('Location:/cms/');
        die();
    }     
}


function set_message($message, $messtype){
    {
        //? zmienna messtype okresla styl komunikatu okreslony w css/tosty.css
        //? messtype może przyjmować wartości ['success'] ['error'] lub ['warning']

        $_SESSION['message'] = $message;
        $_SESSION['messtype'] = $messtype;
    }
}

function get_message(){
    if(isset($_SESSION['message'])){
        echo "<script type='text/javascript'>dawajTosta('" . $_SESSION['message'] ."', 'top right', '" . $_SESSION['messtype'] ."')</script>";
        unset($_SESSION['message']);
        unset($_SESSION['messtype']);
    }
}