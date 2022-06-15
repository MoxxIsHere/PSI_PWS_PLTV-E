<?php
    include '../visual/factura.html';
    include_once '../model/ActiveRecord/Users.php';
    include_once '../../vendor/autoload.php';
    ActiveRecord\Config::initialize(function($cfg) //Configuração do Active Record
    {
        $cfg->set_model_directory('..\model\ActiveRecord');
        $cfg->set_connections(
            array(
                'development' => 'mysql://root@localhost:3306/phpdb?charset=utf8',
            )
        );
        $cfg->set_default_connection('development');
    });
    if(isset($_POST['novaFactura']))
    {
        $funcionario = User::find(
            array(
                'email' =>$_SESSION['email']
            )
        );
        $cliente = User::find(
            array(
                'username' => $_POST['cliente']
            )
        );
        $empresa = Empresa::find(
            array(
                'designacaosocial' => $_POST['empresa']
            )
        );
        CriarStart($empresa, $funcionario, $cliente);
    }
    function CriarStart($empresa, $funcionario, $cliente)//Iniciar a inserção de dados na factura (inputs: $empresa = objecto da empresa a emitir a factura | $funcionario = objecto do funcionário loggado| $cliente = objecto do cliente receptor da factura)
    {
        // =============== Definição dos campos ===============
        $empresaNome = $empresa->designacaosocial;

        $clienteUsername = $cliente->username;
        $clienteCP = $cliente->codigopostal;
        $clienteNif = $cliente->nif;
        $clienteMorada = $cliente->morada;
        $clienteLocalidade = $cliente->localidade;
        // ====================================================
        echo "
            <div id=\"factura\">
                <div id=\"cabecalho\">
                    <header>$empresaNome</header>
                    <hr>
                    <p>Cliente:</p>
                    <table>
                        <tr>
                            <td>
                                Utilizador:
                            </td>
                            <td>
                                $clienteUsername
                            </td>
                            <td>
                                Código-Postal:
                            </td>
                            <td>
                                $clienteCP
                            </td>
                        </tr>
                        <tr>
                            <td>
                                Contribuinte:
                            </td>
                            <td>
                                $clienteNif
                            </td>
                            <td>
                                Morada:
                            </td>
                            <td>
                                $clienteMorada, $clienteLocalidade
                            </td>
                        </tr>
                        <tr>
                            <td>
                                Telefone:
                            </td>
                            <td>
                                
                            </td>
                        </tr>
                    </table>
                    <hr>
                </div>
                <div id=\"corpo\">";
        //foreach->linha de factura


        echo "
                </div>
                <div id=\"rodape\">
                    
                </div>
            </div>
        ";
    }