<?php
    session_start();

    include '..\view\main.html';
    $username = getFromUser('username');
    $role = getFromUser('role');

    echo
    "
    <script>
        document.getElementById(\"loggedUser\").innerHTML = \"$username ($role)\";
    </script>
    ";//Muda o nome e o role do utilizador com conta iniciada (não é HTML só faz modificações ao mesmo)

    function getFromUser($column) //Função que vai buscar o dado da coluna inserida do utilizador loggado
    {
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
        $user = User::find(
            array(
                'email' => $_SESSION['email']
            )
        );
        return $user->$column;
    }
