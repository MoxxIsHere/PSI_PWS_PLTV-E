<?php

include '../view/login.html';
include '../model/login.php';

// Arranque da aplicação
require_once 'startup/boot.php';

// Chamar Models do ActiveRecords
require_once 'model/ActiveRecord/Empresas.php';
require_once 'model/ActiveRecord/Users.php';
require_once 'model/ActiveRecord/Linhasfaturas.php';
require_once 'model/ActiveRecord/Faturas.php';

// Chamar controladores
require_once '../controller/LoginController.php';
require_once '../controller/FaturasController.php';
require_once '../controller/AccountCreatorController.php';
require_once '../controller/BootController';


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
                    $controlador->CheckLogin();
                    break;
                case 'logout':
                    $controlador->Logout();
                    break;
            }
            break;
    }}
