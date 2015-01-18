<?php
require 'SimpleHTTPAuth.class.php';

$auth = new SimpleHTTPAuth();
$auth->addUser('teste', '123456');

/*
$auth->addUser('usuario2', '123456')
    ->addUser('usuario3','123456');
*/

$auth->run();

echo 'Autenticado!';
