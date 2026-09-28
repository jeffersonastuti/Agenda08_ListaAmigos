<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

unset($_SESSION['logado']);

$nome = trim($_POST['txtNome'] ?? '');
$senha = $_POST['txtSenha'] ?? '';

$loginValido = false;

if ($nome !== '' && $senha !== '') {
    require_once 'conexaoBD.php';

    $stmt = $conexao->prepare('SELECT nome, senha FROM usuario WHERE nome = ? LIMIT 1');
    $stmt->bind_param('s', $nome);
    $stmt->execute();
    $resultado = $stmt->get_result();
    $usuario = $resultado->fetch_assoc();

    if ($usuario !== null && $usuario['senha'] === $senha) {
        $_SESSION['logado'] = $usuario['nome'];
        $loginValido = true;
    }

    $stmt->close();
    $conexao->close();
}

require_once 'cabecalho.php';
?>
<div class="w3-card-4 w3-white w3-round-large app-narrow w3-padding-24 w3-center">
    <?php if ($loginValido): ?>
        <i class="fa fa-check-circle w3-text-green" style="font-size:72px"></i>
        <h2>Login realizado com sucesso!</h2>
        <p>Olá, <b><?= htmlspecialchars($_SESSION['logado'], ENT_QUOTES, 'UTF-8') ?></b>.</p>
        <a class="w3-button w3-teal w3-round" href="principal.php">
            <i class="fa fa-arrow-right"></i> Entrar no sistema
        </a>
    <?php else: ?>
        <i class="fa fa-times-circle w3-text-red" style="font-size:72px"></i>
        <h2>Login inválido</h2>
        <p>Confira o usuário e a senha e tente novamente.</p>
        <a class="w3-button w3-teal w3-round" href="index.php">
            <i class="fa fa-arrow-left"></i> Voltar ao login
        </a>
    <?php endif; ?>
</div>
<?php require_once 'rodape.php'; ?>
