<?php
require_once './functions.php';
require_once './database.php';
protection();
?>

<script type="text/javascript">
    function registrarBaixaEquipamento(equipamento) {
        $("#resultadoAction").hide('normal');
        $.post('registrarBaixa.php', {equipamento: equipamento}, function (data) {
            $('#resultadoAction').html(data);
            $("#resultadoAction").show('normal');
            registraBaixa();
        });
    }
</script>
<style type="text/css">
    .botao:link {
        color: #18393D;
        text-decoration: none;
    }
    .botao:visited {
        text-decoration: none;
        color: #18393D;
    }
    .botao:hover {
        text-decoration: none;
        font-weight: bold;
    }
    .botao:active {
        text-decoration: none;
        color: #18393D;
    }
</style>
<?php
if ($_GET) {
    $action = $_GET['action'];
    switch ($action) {
        case 'addEquip': {
                if (!empty($_POST['registro']) && !empty($_POST['predio']) && !empty($_POST['sala']) && !empty($_POST['descricao']) && !empty($_POST['plaquetavel']) && !empty($_POST['ano']) && !empty($_POST['proprietario'])) {
                    $registro = $_POST['registro'];
                    $predio = $_POST['predio'];
                    $sala = $_POST['sala'];
                    $descricao = $_POST['descricao'];
                    $plaquetavel = $_POST['plaquetavel'];
                    $ano = $_POST['ano'];
                    $proprietario = $_POST['proprietario'];
                    $params = 'WHERE registro = ' . $registro . ' AND ano = ' . $ano;
                    $equipamento = SelectBD('equipamento', $params, 'equipamentoid');
                    if ($equipamento == false) {
                        $params = 'WHERE sala = "' . $sala . '" AND predio = "' . $predio . '"';
                        $local = SelectBD('local', $params, 'localid');
                        $localid = $local[0]['localid'];
                        if (isset($localid)) {
                            $data = array(
                                'registro' => $registro,
                                'descricao' => $descricao,
                                'plaquetavel' => $plaquetavel,
                                'ano' => $ano,
                                'proprietario' => $proprietario,
                                'localid' => $localid
                            );
                            if (InsertBD('equipamento', $data)) {
                                echo '<script>alert("Equipamento cadastrado com sucesso."); cadastraEquipamento();</script>';
                            } else {
                                echo '<script>alert("Erro de inserção no banco de dados.");</script>';
                            }
                        } else {
                            echo '<script>alert("Erro ao inserir local.");</script>';
                        }
                    } else {
                        echo '<script>alert("Erro: equipamento já existe no sistema.");</script>';
                    }
                } else {
                    echo '<script>alert("Por favor, preencha todos os campos.");</script>';
                }
                break;
            }
        case 'cadastraLocal': {
                if (!empty($_POST['sala']) && !empty($_POST['predio'])) {
                    $sala = $_POST['sala'];
                    $predio = $_POST['predio'];
                    $params = 'WHERE sala = "' . $sala . '" AND predio = "' . $predio . '"';
                    $dados = SelectBD('local', $params);
                    if ($dados == false) {
                        if (!empty($_POST['especificacao'])) {
                            $especificacao = $_POST['especificacao'];
                            $data = array(
                                'sala' => $sala,
                                'predio' => $predio,
                                'especificacao' => $especificacao
                            );
                        } else {
                            $data = array(
                                'sala' => $sala,
                                'predio' => $predio
                            );
                        }
                        if (InsertBD('local', $data)) {
                            echo '<script>alert("Local cadastrado com sucesso."); cadastraLocal();</script>';
                        } else {
                            echo '<script>alert("Erro de inserção no banco de dados.");</script>';
                        }
                    } else {
                        echo '<script>alert("Esse local já existe no sistema.");</script>';
                    }
                } else {
                    echo '<script>alert("Por favor, preencha todos os campos.");</script>';
                }
                break;
            }
        case 'pesquisa': {
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
                        <div style="max-height: 350px;overflow: auto; width: 925px;">
                            <table class="CSSTableGenerator">
                                <tr>
                                    <td>Registro</td>
                                    <td width="250">Descrição</td>
                                    <td>Proprietário</td>
                                    <td>Plaquetável</td>
                                    <td>Ano</td>
                                    <td>Prédio</td>
                                    <td>Sala</td>
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
                break;
            }
        case 'registra': {
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
                        <div style="max-height: 350px;overflow: auto; width: 925px;">

                            <table class="CSSTableGenerator" >
                                <tr>
                                    <td>Registro</td>
                                    <td width="250">Descrição</td>
                                    <td>Proprietário</td>
                                    <td>Plaquetável</td>
                                    <td>Ano</td>
                                    <td>Prédio</td>
                                    <td>Sala</td>
                                    <td></td>
                                </tr>
                                <?php
                                foreach ($dados as $equipamento) {
                                    echo '<tr height="60">';
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
                                    echo '<td width="72">';
                                    ?>
                                    <a href="#" onclick="registrarBaixaEquipamento(<?php echo $equipamento['equipamentoid']; ?>);" class="botao">Registrar baixa</a>
                                    <?php
                                    echo '</td>';
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
                <div id="resultadoAction"></div>
                <?php
                break;
            }
        case 'alteraEquip': {
                if (!empty($_POST['registro']) && !empty($_POST['predio']) && !empty($_POST['sala']) && !empty($_POST['descricao']) && !empty($_POST['plaquetavel']) && !empty($_POST['ano']) && !empty($_POST['proprietario']) && !empty($_POST['id'])) {
                    $registro = $_POST['registro'];
                    $predio = $_POST['predio'];
                    $sala = $_POST['sala'];
                    $descricao = $_POST['descricao'];
                    $plaquetavel = $_POST['plaquetavel'];
                    $ano = $_POST['ano'];
                    $proprietario = $_POST['proprietario'];
                    $id = $_POST['id'];
                    $params = 'WHERE sala = "' . $sala . '" AND predio = "' . $predio . '"';
                    $local = SelectBD('local', $params, 'localid');
                    if ($local) {
                        $localid = $local[0]['localid'];
                        if (isset($localid)) {
                            $data = array(
                                'registro' => $registro,
                                'descricao' => $descricao,
                                'plaquetavel' => $plaquetavel,
                                'ano' => $ano,
                                'proprietario' => $proprietario,
                                'localid' => $localid
                            );
                            $where = 'equipamentoid = ' . $id;
                            if (UpdateBD('equipamento', $data, $where)) {
                                echo '<script>alert("Dados do equipamento atualizados com sucesso."); alteraDados();</script>';
                            } else {
                                echo '<script>alert("Erro de inserção no banco de dados.");</script>';
                            }
                        } else {
                            echo '<script>alert("Erro ao inserir local.");</script>';
                        }
                    } else {
                        echo '<script>alert("Erro ao inserir local.");</script>';
                    }
                } else {
                    echo '<script>alert("Por favor, preencha todos os campos.");</script>';
                }
                break;
            }
        case 'addUser': {
                if (!empty($_POST['email']) && !empty($_POST['senha'])) {
                    $email = $_POST['email'];
                    $senha = $_POST['senha'];
                    $params = 'WHERE email = "' . $email . '"';
                    $usuario = SelectBD('usuario', $params, 'usuarioid');
                    if ($usuario == false) {
                        $statusEmail = 1;
                        $contEm = 0;
                        for ($i = 0; $i < strlen($email); $i++) {
                            if ($email[$i] == '@') {
                                $contEm++;
                            }
                        }
                        if ($contEm == 1) {
                            $domain = explode('@', $email);
                            if (checkdnsrr($domain[1])) {
                                $statusEmail = 1;
                            } else {
                                echo '<script>alert("Digite um e-mail válido.");</script>';
                                $statusEmail = 0;
                            }
                        } else {
                            echo '<script>alert("Digite um e-mail válido.");</script>';
                            $statusEmail = 0;
                        }

                        if ($statusEmail == 1) {
                            require_once './functions.php';
                            $custo = '08';
                            $salt = geraSenha(22, true, true);
                            // Gera um hash baseado em bcrypt
                            $hash = crypt($senha, '$2a$' . $custo . '$' . $salt . '$');
                            $data = array(
                                'email' => $email,
                                'senha' => $hash
                            );
                            if (InsertBD('usuario', $data)) {
                                echo '<script>alert("Usuário cadastrado com sucesso."); cadastraUsuario();</script>';
                            } else {
                                echo '<script>alert("Erro de inserção no banco de dados.");</script>';
                            }
                        }
                    } else {
                        echo '<script>alert("Usuário já cadastrado, tente outro.");</script>';
                    }
                }
                break;
            }
    }
}
?>
