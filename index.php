<?php
require 'SimpleHTTPAuth.class.php';

$auth = new SimpleHTTPAuth();
$auth->addUser('teste', '123456');
$auth->run();

echo 'Autenticado!';
