<?php
require_once './database.php';
require_once './functions.php';
protection();

if ($_POST) {
    $predio = $_POST['predio'];

    if (empty($predio)) {
        ?>
        <select name="sala" class="campo" required="">
            <option value="">Escolha um prédio primeiro</option>
        </select>
        <?php
    } else {
        $dados = SelectBD('local', 'WHERE predio = "' . $predio . '"', 'sala,especificacao');
        ?>
        <select name="sala" class="campo" required="">
            <option value="">Escolha uma sala aqui</option>
            <?php
            foreach ($dados as $valor) {
                if (!empty($valor['especificacao'])) {
                    echo '<option value="' . $valor['sala'] . '">' . $valor['sala'] . ' - ' . $valor['especificacao'] . '</option>';
                } else {
                    echo '<option value="' . $valor['sala'] . '">' . $valor['sala'] . '</option>';
                }
            }
            ?>
            <option value="outra" onclick="cadastraLocal();">Outra</option>
        </select>
        <?php
    }
}
?>