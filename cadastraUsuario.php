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
    .ui-tooltip {
        width: 230px;
        font-size: 11pt;
    }
</style>
<script>
    $(function () {
        var tooltips = $("[title]").tooltip({
            position: {
                my: "left top",
                at: "right+5 top-5"
            }
        });
    });
</script>
<script type="text/javascript">
    jQuery(document).ready(function () {
        jQuery('#addUser').submit(function () {
            var dados = jQuery(this).serialize();
            jQuery.ajax({
                type: "POST",
                url: "actions.php?action=addUser",
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
                <h2>Cadastrar usuário</h2>
            </td>
        </tr>
        <tr>
            <td>
                <form id="addUser">
                    <table align="center" style="text-align:center">
                        <tr>
                            <td>
                                <input type="email" name="email" placeholder="E-mail" class="campo" id="email" title="Utilizado para logar no sistema." required=""> 
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <input type="password" name="senha" class="campo" placeholder="Senha" title="Utilizada para logar no sistema." required="" >  
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