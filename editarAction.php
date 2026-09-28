<?php
require_once 'verificarAcesso.php';

$id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT, ['options' => ['min_range' => 1]]);
$nome = trim($_POST['nome'] ?? '');
$sobrenome = trim($_POST['sobrenome'] ?? '');
$telefone = trim($_POST['telefone'] ?? '');
$email = trim($_POST['email'] ?? '');

if ($id === false || $id === null) {
    header('Location: listar.php?mensagem=id_invalido');
    exit;
}

if ($nome === '' || $sobrenome === '' || $telefone === '' || $email === '') {
    header('Location: editar.php?id=' . $id . '&erro=campos');
    exit;
}

require_once 'conexaoBD.php';

$stmt = $conexao->prepare('UPDATE amigo SET nome = ?, sobrenome = ?, telefone = ?, email = ? WHERE idamigo = ?');
$stmt->bind_param('ssssi', $nome, $sobrenome, $telefone, $email, $id);
$stmt->execute();
$linhasAfetadas = $stmt->affected_rows;
$stmt->close();

if ($linhasAfetadas === 0) {
    $verifica = $conexao->prepare('SELECT idamigo FROM amigo WHERE idamigo = ?');
    $verifica->bind_param('i', $id);
    $verifica->execute();
    $resultado = $verifica->get_result();
    $existe = $resultado->fetch_assoc() !== null;
    $verifica->close();
    $conexao->close();

    if (!$existe) {
        header('Location: listar.php?mensagem=nao_encontrado');
        exit;
    }

    header('Location: listar.php?mensagem=editado');
    exit;
}

$conexao->close();
header('Location: listar.php?mensagem=editado');
exit;
