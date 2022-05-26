<?php
    include '..\visual\main.html';
    require_once '..\php-activerecord\ActiveRecord.php';

    ActiveRecord\Config::initialize(function($cfg)
    {
        $cfg->set_model_directory('..\models');
        $cfg->set_connections(
            array(
                'development' => 'mysql://root@localhost:3306/phpdb',
            )
        );
    });