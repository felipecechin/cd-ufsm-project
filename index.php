<?php
require_once './functions.php';
protection();
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset='utf-8'>
        <link rel="stylesheet" href="css/estilo.css">
        <script src="js/jquery-ui-1.11.4.custom/external/jquery/jquery.js" type="text/javascript"></script>
        <script src="js/jquery-ui-1.11.4.custom/jquery-ui.js" type="text/javascript"></script>
        <script src="js/jquery-ui-1.11.4.custom/jquery-ui.min.js" type="text/javascript"></script>
        <script src="js/jquery-ui-1.11.4.custom/jquery.maskedinput.min.js" type="text/javascript"></script>
        <link rel="stylesheet" href="js/jquery-ui-1.11.4.custom/jquery-ui.css" type="text/css">
        <link rel="stylesheet" href="js/jquery-ui-1.11.4.custom/jquery-ui.min.css" type="text/css">
        <link rel="stylesheet" href="js/jquery-ui-1.11.4.custom/jquery-ui.structure.css" type="text/css">
        <link rel="stylesheet" href="js/jquery-ui-1.11.4.custom/jquery-ui.structure.min.css" type="text/css">
        <link rel="stylesheet" href="js/jquery-ui-1.11.4.custom/jquery-ui.theme.css" type="text/css">
        <link rel="stylesheet" href="js/jquery-ui-1.11.4.custom/jquery-ui.theme.min.css" type="text/css">
        <link rel="stylesheet" href="css/tabela.css" type="text/css">
        <script src="js/script.js"></script>
        <script type="text/javascript" src="js/functions.js"></script>
        <title>.:: Página inicial ::.</title>
        <style type="text/css">
            body {
                background-color: #fbf9ee;
            }
            #menu li {
                width:150px;
                text-align: center;
                height: 75px;
            }
            #all {
                width:1200px;
                height: 900px;
                margin: auto;
                background-color: #C5C6C7;
                border-radius: 1em;
                display: table;
            }
            #cont {
                width:100%;
                height:80%;
                display: table;
                border-radius: 1em;
                margin-top: 15px;
                color:#254a68;
                padding: 20px 0px 20px 0px;
            }
            #mensagem {
                padding-top: 250px;
                padding-left: 50px;
            }
            #rodape {
                width:1200px;
                margin: auto;
                text-align: center;
                color: #254a68;
            }
            a:link {
                color: #254a68;
                text-decoration: none;
            }
            a:visited {
                color: #254a68;
                text-decoration: none;
            }

            a:hover {
                text-decoration: underline;
                color: #C5C6C7;
            }
            a:active {
                color: #254a68;
                text-decoration: none;
            }
        </style>
    </head>
    <body>
        <div id="all">
            <div id='cssmenu' width='100%'>
                <ul id="menu">
                    <li id="cadastraEquipamento" onclick="cadastraEquipamento();"><a href='#'>Cadastrar equipamento</a></li>
                    <li id="pesquisaEquipamento" onclick="pesquisaEquipamento();"><a href='#'>Pesquisar equipamento</a></li>
                    <li id="registraBaixa" onclick="registraBaixa();"><a href='#'>Registrar baixa de um equipamento</a></li>
                    <li id="alteraDados" onclick="alteraDados();"><a href='#'>Alterar dados do equipamento</a></li>
                    <li id="cadastraLocal" onclick="cadastraLocal();"><a href='#'>Cadastrar local</a></li>
                    <li id="cadastraUsuario" onclick="cadastraUsuario();"><a href='#'>Cadastrar usuário</a></li>
                    <li  style="float: right;"><a href="logout.php">Sair</a></li>
                </ul>
            </div>
            <div id="cont">
                <div id="mensagem">
                    <h1>Bem vindo, <b><?php echo $_SESSION['email']; ?>!</b></h1>
                    <h2>Selecione um item do menu para começar.</h2>
                </div>
            </div>
            <div id="frame" style="display: none">
                <iframe id="frameForm" name="frameForm">
                </iframe>
            </div>
        </div>
        <footer id="rodape">
            Departamento de química - UFSM
            <br>
            Desenvolvido por Bruno Frizzo e Felipe Cechin.
        </footer>
    </body>
</html>
