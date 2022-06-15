<?php
    include_once '../model/ActiveRecord/Users.php';
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
    function CriarConta($username, $password, $email, $telefone, $nif, $morada, $codigoPostal, $localidade)
    {
        $user = new User();
        $user->username = $username; //Máximo 16 caracteres
        $user->password = $password; //Máximo 16 caracteres
        $user->email = $email; //Máximo 32 caracteres
        $user->telefone = $telefone; //Máximo 15 caracteres
        $user->nif = $nif; //Máximo 9 caracteres
        $user->morada = $morada; //Máximo 64 caracteres
        $user->codigoPostal = $codigoPostal; //Máximo 8 caracteres
        $user->localidade = $localidade; //Máximo 32 caracteres
        $user->role = "user"; //Não é introduzido pelo utilizador
        $user->save();
    }