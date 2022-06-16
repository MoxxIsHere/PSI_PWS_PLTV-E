<?php
include '../view/factura.html';
include_once '../model/ActiveRecord/Users.php';
include_once '../model/ActiveRecord/Empresas.php';
include_once '../model/ActiveRecord/Faturas.php';
include_once '../model/ActiveRecord/Linhafaturas.php';
include_once '../model/ActiveRecord/Produtos.php';
include_once '../model/ActiveRecord/Ivas.php';
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
echo "
    <script>
        document.getElementById(\"selectProductos\").innerHTML = \"";
foreach(Produto::all() as $produto)
{
    $nomeProd = $produto->descricao;
    $idProd = $produto->idproduto;
    echo "<option value=\\\"$idProd\\\">$nomeProd</option>";
}
echo "\"
        ;
    </script>
    ";
$arrayProductos = array();
$arrayTabela = array();
if(isset($_POST['novaFactura']))
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
    CriarStart($empresa, $funcionario, $cliente, $arrayProductos);
}
if(isset($_POST['empresa']))
{

}
if(isset($_POST['produto']))
{
    $produtoId = $_POST['addProdutos'];
    $produtoQuantidade = $_POST['quantityProd'];
    $arrayProductos += array($produtoId => $produtoQuantidade);
    $produtoSelected = Produto::find($_POST['addProdutos']);
    $produtoPreco = $produtoSelected->preco;
    $produtoNome = $produtoSelected->descricao;
    array_push($arrayTabela, (array($produtoId => array($produtoNome, $produtoQuantidade, $produtoPreco))));
    echo "
          <script>
            document.getElementById(\"produtoSelect\").innerHTML = \"<tr><th>Id</th><th>Nome</th><th>Quantidade</th><th>Preço</th></tr>";
        foreach($arrayTabela as $produto => $dados)
        {
            echo "<tr><td>$produto</td><td>$dados[0]</td><td>$dados[1]</td><td>$dados[2]\€</td></tr>";
        }
    echo "\"</script>";
}
function CriarStart($empresa, $funcionario, $cliente, $productos)// Iniciar a inserção de dados na factura (inputs: $empresa = objecto da empresa a emitir a factura | $funcionario = objecto do funcionário loggado| $cliente = objecto do cliente receptor da factura)
{
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
                                    $funcionarioNome
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