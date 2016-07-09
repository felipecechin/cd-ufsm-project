<?php
require_once './functions.php';
protection();
?>
<style type="text/css">
    #container {
        width: 450px; 
        display: table;
        margin: auto; 
        text-align: center; 
        background-color: #acacac; 
        border-radius: 1em;
        padding: 0px 20px 20px 20px;
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
    .campo {
        text-align: center;
        width: 190px;
    }
</style>
<script type="text/javascript">
    jQuery(document).ready(function () {
        jQuery('#addEquip').submit(function () {
            var dados = jQuery(this).serialize();
            jQuery.ajax({
                type: "POST",
                url: "actions.php?action=addEquip",
                data: dados,
                success: function (data)
                {
                    $('#resultado').html(data);
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
<div id="container">
    <table align="center" style="text-align:center;">
        <tr>
            <td>
                <h2>Cadastrar equipamento</h2>
            </td>
        </tr>
        <tr>
            <td>
                <form id="addEquip">
                    <table align="center" style="text-align:center">
                        <tr>
                            <td>
                                <input type="number" name="registro" placeholder="Número de registro" class="campo" required=""> 
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <br>
                                Local:
                            </td>
                        </tr>
                        <?php
                        require_once './database.php';
                        $dados = SelectBD('local', null, 'predio');
                        if ($dados) {
                            ?>
                            <tr>
                                <td>

                                    <select name="predio" onchange="pesquisaPredio(this.value);" class="campo" required="">
                                        <option value="">Escolha um prédio aqui</option>
                                        <?php
                                        foreach ($dados as $valor) {
                                            $predios[] = $valor['predio'];
                                        }
                                        $predios = array_unique($predios);
                                        foreach ($predios as $predio) {
                                            echo '<option value="' . $predio . '">' . $predio . '</option>';
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
                                            <option value="">Escolha um prédio primeiro</option>
                                        </select>
                                    </div>
                                </td>
                            </tr>
                            <?php
                        } else {
                            ?>
                            <tr>
                                <td> 
                                    Nenhum local cadastrado, <a href="#" onclick="cadastraLocal();">clique aqui</a> para cadastrar.
                                </td>
                            </tr>
                            <?php
                        }
                        ?>
                        <tr>
                            <td>
                                <br>
                                <textarea name="descricao" maxlength="100" placeholder="Descrição" class="campo" required=""></textarea>
                            </td>
                        </tr>
                        <tr>
                            <td><input type="text" name="proprietario" placeholder="Nome do proprietário" class="campo" required=""></td>
                        </tr>
                        <tr>
                            <td ><input type="number" name="ano" placeholder="Ano" id="ano" class="campo" required=""></td>
                        </tr>
                        <tr>
                            <td align="center">
                                <table> 
                                    <tr> 
                                        <td colspan="2"> Equipamento plaquetável?
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <input type="radio" required="" name="plaquetavel" value="s"> Sim
                                        </td>
                                        <td>
                                            <input type="radio" required="" name="plaquetavel" value="n"> Não
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                        <tr>
                            <td align="center">
                                <br>
                                <input type="reset" value="Limpar Campos" class="limpar">
                                <input type="submit" value="Cadastrar" class="cadastrar">
                            </td>
                        </tr>
                    </table>
                </form>
            </td>
        </tr>
        <tr>
            <td>
                <div id="resultado"></div>
            </td>
        </tr>
    </table>
</div>