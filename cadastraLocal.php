<?php
require_once './functions.php';
require_once './database.php';
protection();
?>
<style type="text/css">
    #container {
        width: 400px; 
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
        jQuery('#addLocal').submit(function () {
            var dados = jQuery(this).serialize();
            jQuery.ajax({
                type: "POST",
                url: "actions.php?action=cadastraLocal",
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
<div id="container">
    <table align="center" style="text-align:center;">
        <tr>
            <td>
                <h2>Cadastrar local</h2>
            </td>
        </tr>
        <tr>
            <td>
                <form id="addLocal">
                    <table align="center" style="text-align:center">
                        <tr>
                            <td>
                                <input type="text" name="predio" placeholder="Prédio" class="campo" required="">
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <input type="text" name="sala" placeholder="Sala" class="campo" required="">
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <input type="text" name="especificacao" placeholder="Especificação" class="campo">
                            </td>
                        </tr>
                        <tr>
                            <td align="right">
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