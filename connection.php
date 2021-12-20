<?php
require_once './config.php';
require_once './functions.php';
protection();

function ConnectBD() {
    $link = @mysqli_connect(MYSQL_HOST, MYSQL_USER, MYSQL_PASSWORD, MYSQL_DATABASE) or die(mysqli_connect_error());

    return $link;
}

function CloseBD($link) {
    @mysqli_close($link) or die(mysqli_error($link));
}

//Função pra proteger contra mysql injection

function EscapeBD($dados) {
    $link = ConnectBD();
    if (!is_array($dados)) {
        $dados = mysqli_real_escape_string($link, $dados);
    } else {
        $arr = $dados;

        foreach ($arr as $key => $value) {
            $key = mysqli_real_escape_string($link, $key);
            $value = mysqli_real_escape_string($link, $value);

            $dados[$key] = $value;
        }
    }
    CloseBD($link);
    return ($dados);
}
?>
