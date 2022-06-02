<?php
    include '../visual/login.html';
    include '../model/login.php';

    if(isset($_POST['login']))
    {
        if(loginAuthenticate($_POST['email'], $_POST['password']))
        {
            session_start();
            $_SESSION['email'] = $_POST['email'];
            $_SESSION['password'] = $_POST['password'];
            header("Location: ..\controller\main.php");
        }
    }