<?php

include '../view/login.html';
include '../model/login.php';

// Arranque da aplicação
require_once '../controller/Boot.php';

// Chamar Models do ActiveRecords
require_once 'model/ActiveRecord/Empresas.php';
require_once 'model/ActiveRecord/Users.php';
require_once 'model/ActiveRecord/Linhasfaturas.php';
require_once 'model/ActiveRecord/Faturas.php';

// Chamar controladores
require_once '../controller/AccountCreatorController.php';
require_once '../controller/AdminController.php';
require_once '../controller/ClienteController.php';
require_once '../controller/FaturasController.php';
require_once '../controller/FuncionarioController.php';
require_once '../controller/LoginController.php';



if (!isset($_GET['cntrl']) || !isset($_GET['action'])) {
    $controlador = new LoginController();
    $controlador->FetchLoginView();
} else {
    $controladorC = $_GET['cntrl'];
    $action = $_GET['action'];

    $controladorTeste = new LoginController();
    if ($controladorC != 'login' && !isset($_SESSION["username"]))
        $controladorTeste->Logout();

    switch ($controladorC) {
        case 'login':
            $controlador = new LoginController();

            switch ($action) {
                case 'show':
                    $controlador->FetchLoginView();
                    break;
                case 'checkAuth':
                    $controlador->CheckUserExists();
                    break;
                case 'logout':
                    $controlador->Logout();
                    break;
            }
            break;


        case 'administrador':
            $controlador = new AdminController();

            switch($action){
                case 'home':
                    $controlador->Home();
                    break;
                case 'showFaturas':
                    $controlador->ShowFaturasTable();
                    break;
                case 'emitirFaturas':
                    $controlador->MostrarPaginaEmitirFatura();
                    break;
            }
            break;

        case 'funcionario':
            $controlador = new FuncionarioController();

            switch($action){
                case 'home':
                    $controlador->Home();
                    break;
            }
            break;

        case 'cliente':
            $controlador = new ClienteController();

            switch($action){
                case 'home':
                    $controlador->Home();
                    break;
            }
            break;

        case 'profile':
            $controlador = new ProfileController();
            switch ($action) {
                case 'show':
                    $controlador->Show();
                    break;
            }
            break;
        case 'fatura':
            $controlador = new FaturasController();
            switch ($action) {
                case 'paginaTabelaFaturas':
                    $controlador->MostrarPaginaTabelaFaturas();
                    break;
                case 'paginaEmitirFatura':
                    $controlador->InicializarFatura();
                    $controlador->MostrarPaginaEmitirFatura();
                    break;
                case 'adicionarLinha':
                    $controlador->AdicionarLinhaFatura($_SESSION['idfatura'], $_POST['selectProdutos'], $_POST['quantidadeProduto']);
                    $controlador->MostrarPaginaEmitirFatura();
                    break;
                case 'emitirFatura':
                    $controlador->EmitirFatura($_SESSION['idfatura']);
                    $controlador->CriarFatura($_SESSION['idfatura']);
                    ?>
                    <script type='text/javascript' language='Javascript'>window.open('Views/fatura.php');</script>
                    <?php
                    $controlador->MostrarPaginaTabelaFaturas();
                    break;
                case 'cancelarFatura':
                    $controlador->CancelarFatura($_SESSION['idfatura']);
                    $controlador->MostrarPaginaTabelaFaturas();
                    break;
                case 'imprimirFatura':
                    $id = (int)$_GET['id'];
                    $controlador->CriarFatura($id);
                    ?>
                    <script type='text/javascript' language='Javascript'>window.open('Views/fatura.php');</script>
                    <?php
                    $controlador->MostrarPaginaTabelaFaturas();
                    break;
            }
            break;
    }
}