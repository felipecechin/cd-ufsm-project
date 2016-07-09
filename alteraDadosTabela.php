<?php
require_once './database.php';
require_once './functions.php';
protection();
?>
<script type="text/javascript">
    $('.botao').click(function () {
        var valor = $(this).attr('value');
        $.post('alteraDadosTabelaForm.php', {id: valor}, function (data) {
            $('#formularioEditar').html(data);
            $("#formularioEditar").slideDown('normal');
        });
    });
</script>

<?php
if ($_POST) {
    $erro = 0;
    if (isset($_POST['registro'])) {
        if (!empty($_POST['registro'])) {
            $registro = $_POST['registro'];
            $params = 'WHERE registro = ' . $registro . ' order by ano desc';
            $dados = SelectBD('equipamento', $params);
        } else {
            $erro = 1;
            echo '<script>alert("Por favor, preencha o campo.");</script>';
        }
    } else if (isset($_POST['descricao'])) {
        if (!empty($_POST['descricao'])) {
            $descricao = $_POST['descricao'];
            $params = 'WHERE descricao like "%' . $descricao . '%" order by ano desc';
            $dados = SelectBD('equipamento', $params);
        } else {
            $erro = 1;
            echo '<script>alert("Por favor, preencha o campo.");</script>';
        }
    } else if (isset($_POST['predio']) && isset($_POST['sala'])) {
        if (!empty($_POST['predio']) && !empty($_POST['sala'])) {
            if ($_POST['predio'] != 'escolher' && $_POST['sala'] != 'escolher') {
                $predio = $_POST['predio'];
                $sala = $_POST['sala'];
                $params = 'WHERE sala = "' . $sala . '" and predio = "' . $predio . '"';
                $local = SelectBD('local', $params);
                if ($local) {
                    $localid = $local[0]['localid'];
                    $params = 'WHERE localid = ' . $localid . ' order by ano desc';
                    $dados = SelectBD('equipamento', $params);
                } else {
                    $erro = 1;
                    echo '<script>alert("Erro na escolha do local.");</script>';
                }
            } else {
                $erro = 1;
                echo '<script>alert("Por favor, preencha os campos.");</script>';
            }
        } else {
            $erro = 1;
            echo '<script>alert("Por favor, preencha os campos.");</script>';
        }
    } else if (isset($_POST['proprietario'])) {
        if (!empty($_POST['proprietario'])) {
            $proprietario = $_POST['proprietario'];
            $params = 'WHERE proprietario like "%' . $proprietario . '%" order by ano desc';
            $dados = SelectBD('equipamento', $params);
        } else {
            $erro = 1;
            echo '<script>alert("Por favor, preencha o campo.");</script>';
        }
    } else {
        $erro = 1;
        echo '<script>alert("Erro.");</script>';
    }

    if ($erro == 0) {
        if (isset($dados) && $dados) {
            ?>
            <hr style="color:#254A68;">
            <div style="max-height: 350px;overflow: auto; width: 985px;">
                <table class="CSSTableGenerator" id="tabelaAltera">
                    <tr>
                        <td>Registro</td>
                        <td width="250">Descrição</td>
                        <td>Proprietário</td>
                        <td>Plaquetável</td>
                        <td>Ano</td>
                        <td>Prédio</td>
                        <td>Sala</td>
                        <td>Clique para editar</td>
                    </tr>
                    <?php
                    foreach ($dados as $equipamento) {
                        echo '<tr>';
                        echo '<td>' . $equipamento['registro'] . '</td>';
                        echo '<td>' . $equipamento['descricao'] . '</td>';
                        echo '<td>' . $equipamento['proprietario'] . '</td>';
                        echo '<td>';
                        echo (mb_strtolower($equipamento['plaquetavel']) == 's') ? 'Sim' : 'Não';
                        echo '</td>';
                        echo '<td>' . $equipamento['ano'] . '</td>';
                        $localid = SelectBD('local', 'WHERE localid = ' . $equipamento['localid']);
                        echo '<td>' . $localid[0]['predio'] . '</td>';
                        echo (empty($localid[0]['especificacao'])) ? '<td>' . $localid[0]['sala'] . '</td>' : '<td>' . $localid[0]['sala'] . ' - ' . $localid[0]['especificacao'] . '</td>';
                        ?>
                        <td>
                            <input type="radio" name="ids[]" class="botao" value="<?php echo $equipamento['equipamentoid']; ?>">
                        </td>
                        <?php
                        echo '</tr>';
                    }
                    ?>
                </table>
            </div>
            <?php
        } else {
            echo 'Nenhum equipamento encontrado.';
        }
    }
    ?>
    <?php
}
?>
<br>
<div id="formularioEditar"></div>
