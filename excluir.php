<?php
require_once 'verificarAcesso.php';

$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT, ['options' => ['min_range' => 1]]);
if ($id === false || $id === null) {
    header('Location: listar.php?mensagem=id_invalido');
    exit;
}

require_once 'conexaoBD.php';

$stmt = $conexao->prepare('DELETE FROM amigo WHERE idamigo = ?');
$stmt->bind_param('i', $id);
$stmt->execute();
$linhasAfetadas = $stmt->affected_rows;
$stmt->close();
$conexao->close();

if ($linhasAfetadas === 0) {
    header('Location: listar.php?mensagem=nao_encontrado');
    exit;
}

header('Location: listar.php?mensagem=excluido');
exit;
