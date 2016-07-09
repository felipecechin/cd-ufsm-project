<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>.:: Sistema de controle de equipamentos ::.</title>
        <style type="text/css">
            .DivCampos {
                border-radius: 1em;
                background-color: #254a68;
                display: table;
                padding: 20px;
                -moz-box-shadow: 5px -1px 27px #0b0930;
                -webkit-box-shadow: 5px -1px 27px #0b0930;
                box-shadow: 5px -1px 27px #0b0930;
                margin: auto;
                width:300px;
            }
            .campos {
                width:220px;
                text-align: center;
                height: 20px;
            }
            #rodape {
                width:1200px;
                text-align: center;
                color: #254a68;
                margin:auto;
            }
            #all {
                width:1200px;
                height: 900px;
                margin: auto;
                background-color: #acacac;
                border-radius: 1em;
            }
            #titulo {
                color: #254a68;
                text-shadow:1px 9px 8px #3d7fb6;
                margin-top: 100px;
            }
            #erro {
                width:210px;
                margin:auto;
                background-color: red;
                text-align:center;
                border-radius: 1em;
            }
            .entrar {
                color: black;
                width: 90px;
                height: 30px;
                font-size: 12pt;
                background-color: #ACACAC;
                border-radius: 1em;
            } 

        </style>
    </head>
    <body>
        <div id="all">
            <table align="center" style="width:100%; text-align: center;">
                <tr>
                    <td>
                        <header>
                            <h2 id="titulo"> SISTEMA DE CONTROLE DE EQUIPAMENTOS </h2>
                        </header>   
                    </td>
                </tr>
                <tr>
                    <td>
                        <div class="DivCampos">
                            <form action="login.php" method="post">
                                <table align="center" style="text-align: center">
                                    <tr>
                                        <td>
                                            <input type="email" placeholder="E-mail" class="campos" name="email" required=""> 
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <br>
                                            <input type="password" placeholder="Senha" class="campos" name="senha" required="" > 
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <br> 
                                            <br>
                                            <input type="submit" value="Entrar" class="entrar">
                                        </td>
                                    </tr>
                                </table>
                            </form>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <?php
                        if ($_POST) {
                            require_once './config.php';
                            require_once './functions.php';
                            $mysqli = new mysqli(MYSQL_HOST, MYSQL_USER, MYSQL_PASSWORD, MYSQL_DATABASE);
                            if (mysqli_connect_errno()) {
                                echo 'Erro: ' . mysqli_connect_error();
                            } else {
                                if (!empty($_POST['email']) && !empty($_POST['senha'])) {
                                    $email = $_POST['email'];
                                    $senha = $_POST['senha'];

                                    $query = 'SELECT usuarioid,email, senha FROM usuario WHERE email="' . $email . '"';
                                    if ($result = $mysqli->query($query)) {
                                        while ($row = $result->fetch_assoc()) {
                                            $senhaDB = $row['senha'];
                                            $email = $row['email'];
                                            $id = $row['usuarioid'];
                                        }
                                    }
                                    if (isset($senhaDB)) {
                                        $hash = $senhaDB;
                                        if (crypt($senha, $hash) === $hash) {
                                            header('location:index.php');
                                            session_start();
                                            $_SESSION['id'] = $id;
                                            $_SESSION['email'] = $email;
                                        } else {
                                            ?>
                                            <div id="erro">Senha inválida</div>
                                            <?php
                                        }
                                    } else {
                                        ?>
                                        <div id="erro">E-mail e senha inválidos</div>
                                        <?php
                                    }
                                } else {
                                    ?>
                                    <div id="erro">Por favor, digite corretamente um e-mail e uma senha</div>
                                    <?php
                                }
                            }
                        }
                        ?>
                    </td>
                </tr>
            </table>
        </div>
        <footer id="rodape">
            Departamento de química - UFSM
            <br>
            Desenvolvido por Bruno Frizzo e Felipe Cechin.
        </footer>
    </body>
</html>
