<?php

include '../view/login.html';
include '../model/login.php';

// Arranque da aplicação
require_once 'startup/boot.php';

// Chamar Models do ActiveRecords
require_once 'Models/ActiveRecords/Empresas.php';
require_once 'Models/ActiveRecords/Users.php';
require_once 'Models/ActiveRecords/Linhasfaturas.php';
require_once 'Models/ActiveRecords/Faturas.php';

// Chamar controladores
require_once 'Controllers/LoginController.php';
require_once 'Controllers/FaturasController.php';
require_once 'Controllers/AccountCreatorController.php';
require_once 'Controller/BootController';


if (!isset($_GET['cntrl']) || !isset($_GET['action'])) {
    $controlador = new LoginController();
    $controlador->VistaLogin();
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
                    $controlador->VistaLogin();
                    break;
                case 'checkAuth':
                    $controlador->CheckLogin();
                    break;
                case 'logout':
                    $controlador->Logout();
                    break;
            }
            break;

        case 'administrador':
            $controlador = new AdminController();

