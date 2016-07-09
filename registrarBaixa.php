<?php

require_once './database.php';
require_once './functions.php';
protection();

if ($_POST) {
    $equipamento = $_POST['equipamento'];
    if (DeleteBD('equipamento', 'equipamentoid = ' . $equipamento)) {
        echo '<script>alert("Baixa registrada com sucesso.");</script>';
    }
}
?>