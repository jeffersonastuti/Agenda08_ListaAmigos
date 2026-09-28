<?php
$servername = 'localhost';
$username = 'root';
$password = '';
$dbname = 'pwii';

$conexao = new mysqli($servername, $username, $password, $dbname);

if ($conexao->connect_error) {
    die('Não foi possível conectar ao banco de dados. Verifique se o MySQL está iniciado no XAMPP.');
}

$conexao->set_charset('utf8mb4');
