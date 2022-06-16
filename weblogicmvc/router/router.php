<?php

// Arranque da aplicação
require_once 'startup/boot.php';

// Chamar Models do ActiveRecords
require_once 'Models/ActiveRecords/Empresas.php';
require_once 'Models/ActiveRecords/Users.php';


// Chamar controladores
require_once 'Controllers/LoginController.php';
require_once 'Controllers/FaturasController.php';

if (!isset($_GET['c']) || !isset($_GET['a'])) {
    $controlador = new LoginController();
    $controlador->VistaLogin();
} else {
    $controladorC = $_GET['c'];
    $action = $_GET['a'];

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
