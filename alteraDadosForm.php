<?php
require_once './functions.php';
protection();
?>
<script type="text/javascript">
    jQuery(document).ready(function () {
        jQuery('#altera').submit(function () {
            var dados = jQuery(this).serialize();
            jQuery.ajax({
                type: "POST",
                url: "alteraDadosTabela.php",
                data: dados,
                success: function (data)
                {
                    $('#resultado').html(data);
                    $('#resultado').show('normal');

                }
            });
            return false;
        });
    });
    function pesquisaPredio(valor) {
        if (valor == "adiciona") {
            cadastraLocal();
        } else {
            $("#resultadoLocal").hide('normal');
            $.post('pesquisarLocal.php', {predio: valor}, function (data) {
                $('#resultadoLocal').html(data);
                $("#resultadoLocal").show('normal');
            });
        }
    }
</script>

<style type="text/css">
    .pesquisar {
        color: black;
        width: 100px;
        height: 40px;
        font-size: 12pt;
    } 

    .pesquisar:hover {
        background-color: rgba(0, 63, 0, 1);
        color: white;
    }
</style>

<?php
if ($_POST) {
    $modo = $_POST['modo'];

    if (empty($modo)) {
        die();
    } else {
        ?>
        <br>
        <form id="altera">
            <table align="center" style="text-align: center">
                <?php
                if ($modo == 'registro') {
                    ?>
                    <tr>
                        <td>
                            <input type="text" name="registro" placeholder="Número de registro" class="campo" required="">
                        </td>
                    </tr>
                    <?php
                } else if ($modo == 'descricao') {
                    ?>
                    <tr>
                        <td>
                            <textarea name="descricao" placeholder="Descrição" class="campo" required=""></textarea>
                        </td>
                    </tr>
                    <?php
                } else if ($modo == 'local') {
                    ?>
                    <tr>
                        <td>
                            <select name="predio" onchange="pesquisaPredio(this.value);" class="campo" required="">
                                <option value="escolher">Escolha um prédio aqui</option>
                                <?php
                                require_once './database.php';
                                $dados = SelectBD('local', null, 'predio');
                                if ($dados) {
                                    foreach ($dados as $valor) {
                                        $predios[] = $valor['predio'];
                                    }
                                    $predios = array_unique($predios);
                                    foreach ($predios as $predio) {
                                        echo '<option value="' . $predio . '">' . $predio . '</option>';
                                    }
                                }
                                echo '<option value="adiciona">Outro</option>';
                                ?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div id="resultadoLocal">
                                <select name="sala" class="campo" required="">
                                    <option value="escolher">Escolha um prédio primeiro</option>
                                </select>
                            </div>
                        </td>
                    </tr>
                    <?php
                } else if ($modo == 'proprietario') {
                    ?>
                    <tr>
                        <td>
                            <input type="text" name="proprietario" placeholder="Proprietário" class="campo" required="">
                        </td>
                    </tr>
                    <?php
                }
                ?>
                <tr>
                    <td>
                        <br>
                        <input type="submit" value="Pesquisar" class="pesquisar">
                    </td>
                </tr>
                <tr>
                    <td>
                        <div id="resultado"></div>
                    </td>
                </tr>
            </table>
        </form>
        <?php
    }
}
?>
