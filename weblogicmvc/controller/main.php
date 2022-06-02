<?php
    session_start();

    include '..\visual\main.html';
    $username = getFromUser('username');
    $role = getFromUser('role');

    echo
    "
    <script>
        document.getElementById(\"loggedUser\").innerHTML = \"$username ($role)\";
    </script>
    ";

    function getFromUser($column)
    {
        include_once '../model/ActiveRecord/Users.php';
        include_once '../../vendor/autoload.php';

        ActiveRecord\Config::initialize(function($cfg)
        {
            $cfg->set_model_directory('..\model\ActiveRecord');
            $cfg->set_connections(
                array(
                    'development' => 'mysql://root@localhost:3306/phpdb?charset=utf8',
                )
            );
            $cfg->set_default_connection('development');
        });
        $user = User::find(
            array(
                'email' => $_SESSION['email']
            )
        );
        return $user->$column;
    }
