<?php

class LoginController
{

    function DestroySession()
    {
        if (isset($_SESSION)) {
            session_destroy();
        }
    }

    function CheckUserExists()
    {
        if (isset($_POST['login'])) {
            if (loginAuthenticate($_POST['email'], $_POST['password'])) //Verifica se o utilizador existe usando a função loginAuthenticate()
            {
                session_start();
                $_SESSION['email'] = $_POST['email'];
                $_SESSION['password'] = $_POST['password'];
                header("Location: ..\controller\main.php");
            }
        }
    }

}