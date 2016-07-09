<?php
require_once './database.php';
require_once './functions.php';
protection();
?>
<script type="text/javascript">
    function pesquisaPredio(valor) {
        if (valor == 'adiciona') {
            cadastraLocal();
        } else {
            $("#resultadoLocal").hide('normal');
            $.post('pesquisarLocal.php', {predio: valor}, function (data) {
                $('#resultadoLocal').html(data);
                $("#resultadoLocal").show('normal');
            });
        }
    }
    jQuery(document).ready(function () {
        jQuery('#alteraEquip').submit(function () {
            var dados = jQuery(this).serialize();
            jQuery.ajax({
                type: "POST",
                url: "actions.php?action=alteraEquip",
                data: dados,
                success: function (data)
                {
                    $('#resultado').html(data);
                }
            });
            return false;
        });
    });
</script>
<style>
    .tabelaForm {
        border: 2px solid #254A68;
        border-radius: 1em;
        padding: 10px;
    }
    .cadastrar {
        color: black;
        width: 100px;
        height: 40px;
        font-size: 12pt;
    } 

    .cadastrar:hover {
        background-color: rgba(0, 63, 0, 1);

        color: white;
    }
    .limpar {
        color: black;
        width: 120px;
        height: 30px;
    }
    .limpar:hover {
        background-color: rgba(255, 0, 0, 1);
        color: white;
    }
</style>
<?php
if ($_POST) {
    if (!empty($_POST['id'])) {
        $id = $_POST['id'];
        $dados = SelectBD('equipamento', 'WHERE equipamentoid = ' . $id);
        ?>
        <hr style="color:#254A68;">

        <form id="alteraEquip">
            <table align="center" class="tabelaForm">
                <tr>
                    <td style="text-align:left;">
                        Registro:
                    </td>
                    <td>
                        <input type="number" name="registro" placeholder="Número de registro" class="campo" value="<?php echo $dados[0]['registro']; ?>" required=""> 
                    </td>
                </tr>
                <tr>
                    <td style="text-align:left;">
                        Prédio:
                    </td>
                    <td>
                        <select name="predio" onchange="pesquisaPredio(this.value);" class="campo" required="">
                            <option value="">Escolha um prédio aqui</option>
                            <?php
                            $dadosLocal = SelectBD('local');

                            if ($dadosLocal) {
                                foreach ($dadosLocal as $valor) {
                                    $predios[$valor['localid']] = $valor['predio'];
                                }
                                $predios = array_unique($predios);
                                foreach ($predios as $localid => $predio) {
                                    if ($localid == $dados[0]['localid']) {
                                        echo '<option value="' . $predio . '" selected>' . $predio . '</option>';
                                    } else {
                                        echo '<option value="' . $predio . '">' . $predio . '</option>';
                                    }
                                }
                            }
                            echo '<option value="adiciona">Outro</option>';
                            ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td style="text-align:left;">
                        Sala:
                    </td>
                    <td>
                        <div id="resultadoLocal">
                            <select name="sala" class="campo" required="">
                                <?php
                                $dadosSala = SelectBD('local', 'WHERE localid = ' . $dados[0]['localid']);
                                $dadosSl = SelectBD('local', 'WHERE predio = "' . $dadosSala[0]['predio'] . '"');
                                if ($dadosSl) {
                                    foreach ($dadosSl as $valor) {
                                        if ($valor['localid'] == $dados[0]['localid']) {
                                            echo '<option value="' . $valor['sala'] . '" selected>' . $valor['sala'] . '</option>';
                                        } else {
                                            echo '<option value="' . $valor['sala'] . '">' . $valor['sala'] . '</option>';
                                        }
                                    }
                                }
                                ?>
                            </select>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td style="text-align:left;">

                        Descrição:
                    </td>
                    <td>
                        <br>
                        <textarea name="descricao" required="" maxlength="100" placeholder="Descrição" class="campo"><?php echo $dados[0]['descricao']; ?></textarea>
                    </td>
                </tr>
                <tr>
                    <td style="text-align:left;">

                        Proprietário:
                    </td>
                    <td>
                        <input type="text" name="proprietario" placeholder="Nome do proprietário" class="campo" value="<?php echo $dados[0]['proprietario']; ?>" required="">
                    </td>
                </tr>
                <tr>
                    <td style="text-align:left;">

                        Ano:
                    </td>
                    <td>
                        <input type="number" name="ano" placeholder="Ano" id="ano" class="campo" value="<?php echo $dados[0]['ano']; ?>" required="">
                    </td>
                </tr>
                <tr>
                    <td align="center" colspan="2">
                        <table> 
                            <tr> 
                                <td colspan="2"> Equipamento plaquetável?
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <input type="radio" name="plaquetavel" required="" value="S" <?php echo (mb_strtolower($dados[0]['plaquetavel']) == 's') ? 'checked' : ''; ?>> Sim
                                </td>
                                <td>
                                    <input type="radio" name="plaquetavel" required="" value="N" <?php echo (mb_strtolower($dados[0]['plaquetavel']) == 'n') ? 'checked' : ''; ?>> Não
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td style="text-align: center;" colspan="2">
                        <div style="display: none;">
                            <input type="hidden" name="id" value="<?php echo $id; ?>">
                        </div>
                        <br>
                        <input type="submit" value="Salvar" class="cadastrar">
                    </td>
                </tr>
            </table>
        </form>
        <?php
    }
}
?>
<div id="resultado"></div>



