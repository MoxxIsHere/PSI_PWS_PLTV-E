<?php

class FaturasController


include '../view/factura.html';
include_once '../model/ActiveRecord/Users.php';
include_once '../model/ActiveRecord/Empresas.php';
include_once '../model/ActiveRecord/Faturas.php';
include_once '../model/ActiveRecord/Linhafaturas.php';
include_once '../../vendor/autoload.php';


ActiveRecord\Config::initialize(function ($cfg) //Configuração do Active Record
{
    $cfg->set_model_directory('..\model\ActiveRecord');
    $cfg->set_connections(
        array(
            'development' => 'mysql://root@localhost:3306/phpdb?charset=utf8',
        )
    );
    $cfg->set_default_connection('development');
});

if (isset($_POST['novaFactura']))
{
$funcionario = User::find(
array(
'email' => $_SESSION['email']
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

InicializarFatura($empresa, $funcionario, $cliente);
}


function InicializarFatura($empresa, $funcionario, $cliente)//Iniciar a inserção de dados na factura (inputs: $empresa = objecto da empresa a emitir a factura | $funcionario = objecto do funcionário loggado| $cliente = objecto do cliente receptor da factura)
{
    //É PRECISO ADICIONAR SELECÇÃO DE PRODUCTOS
    // =============== Definição dos campos ===============
    $factura = new Fatura();
    $dataEmissao = date("d/m/Y - H:i");
    $factura->data = $dataEmissao;

    $empresaNome = $empresa->designacaosocial;
    $empresaCP = $empresa->codigopostal;
    $empresaNif = $empresa->nif;
    $empresaMorada = $empresa->morada;
    $empresaLocalidade = $empresa->localidade;
    $empresaTelefone = $empresa->telefone;

    $clienteUsername = $cliente->username;
    $clienteCP = $cliente->codigopostal;
    $clienteNif = $cliente->nif;
    $clienteMorada = $cliente->morada;
    $clienteLocalidade = $cliente->localidade;
    $clienteTelefone = $cliente->telefone;
    // ====================================================
    echo "
            <div id=\"factura\">
                <div id=\"cabecalho\">
                    <p>$dataEmissao</p>
                    <p>Remetente:</p>
                        <table>
                            <tr>
                                <td>
                                    Designação:
                                </td>
                                <td>
                                    $empresaNome
                                </td>
                                <td>
                                    Código-Postal:
                                </td>
                                <td>
                                    $empresaCP
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    Contribuinte:
                                </td>
                                <td>
                                    $empresaNif
                                </td>
                                <td>
                                    Morada:
                                </td>
                                <td>
                                    $empresaMorada, $empresaLocalidade
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    Telefone:
                                </td>
                                <td>
                                    $empresaTelefone
                                </td>
                            </tr>
                        </table>
                    <hr>
                    <p>Destinatário:</p>
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
                                $clienteTelefone
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
                    <p>Emitido por:</p>
                        <table>
                            <tr>
                                <td>
                                    Nome:
                                </td>
                                <td>
                                    $
                                </td>
                                <td>
                                    Código-Postal:
                                </td>
                                <td>
                                    $empresaCP
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    Contribuinte:
                                </td>
                                <td>
                                    $empresaNif
                                </td>
                                <td>
                                    Morada:
                                </td>
                                <td>
                                    $empresaMorada, $empresaLocalidade
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    Telefone:
                                </td>
                                <td>
                                    $empresaTelefone
                                </td>
                            </tr>
                        </table>
                </div>
            </div>
        ";
}

