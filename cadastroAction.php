<?php
require_once 'verificarAcesso.php';

$nome = trim($_POST['nome'] ?? '');
$sobrenome = trim($_POST['sobrenome'] ?? '');
$telefone = trim($_POST['telefone'] ?? '');
$email = trim($_POST['email'] ?? '');

if ($nome === '' || $sobrenome === '' || $telefone === '' || $email === '') {
    header('Location: cadastro.php?erro=campos');
    exit;
}

require_once 'conexaoBD.php';

$stmt = $conexao->prepare('INSERT INTO amigo (nome, sobrenome, telefone, email) VALUES (?, ?, ?, ?)');
$stmt->bind_param('ssss', $nome, $sobrenome, $telefone, $email);
$stmt->execute();

$stmt->close();
$conexao->close();

header('Location: listar.php?mensagem=cadastrado');
exit;
