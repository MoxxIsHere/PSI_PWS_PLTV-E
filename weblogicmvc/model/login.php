<?php
    function loginAuthenticate($email, $password)
    {
        include '../model/ActiveRecord/Users.php';
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
                'email' => $email
            )
        );
        if($user == null)
        {
            return false;
        }
        else
        {
            if($user->password == $password)
            {
                return true;
            }
            else
            {
                return false;
            }
        }

    }