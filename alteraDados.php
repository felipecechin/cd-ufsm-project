<?php
require_once './functions.php';
protection();
?>
<script type="text/javascript">
    function abreForm(modo) {
        $("#formulario").hide('normal');
        $.post('alteraDadosForm.php', {modo: modo}, function (data) {
            $('#formulario').html(data);
            $("#formulario").show('normal');
        });
    }
</script>
<style type="text/css">
    #container {
        width: 700px; 
        display: table;
        margin: auto; 
        text-align: center; 
        background-color: #acacac; 
        border-radius: 1em;
        padding: 0px 20px 20px 20px;
    }
    .campo {
        text-align: center;
        width: 190px;
    }
</style>
<div id="container">
    <table align="center" style="text-align: center;">
        <tr>
            <td>
                <h2>Alterar dados do equipamento</h2>
            </td>
        </tr>
        <tr>
            <td>
                <select onchange="abreForm(this.value);" class="campo" required="">
                    <option value="">Escolha um modo de busca</option>
                    <option value="registro">Por registro</option>
                    <option value="descricao">Por descrição</option>
                    <option value="local">Por local</option>
                    <option value="proprietario">Por proprietário</option>
                </select>
            </td>
        </tr>
        <tr>
            <td>
                <div id="formulario"></div>
            </td>
        </tr>
    </table>
</div>