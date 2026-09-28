<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (isset($_SESSION['logado'])) {
    header('Location: principal.php');
    exit;
}

require_once 'cabecalho.php';
?>
<div class="w3-card-4 w3-white w3-round-large app-narrow">
    <header class="w3-container w3-teal w3-round-large">
        <h2 class="w3-center"><i class="fa fa-users"></i> Lista de Amigos da Gabi</h2>
    </header>

    <form class="w3-container w3-padding-24" action="loginAction.php" method="post">
        <p class="w3-text-grey">Entre com seu usuário e senha para acessar o projeto.</p>

        <label for="txtNome"><b>Usuário</b></label>
        <input class="w3-input w3-border w3-margin-bottom" id="txtNome" type="text" name="txtNome" placeholder="Digite o usuário" required autofocus>

        <label for="txtSenha"><b>Senha</b></label>
        <input class="w3-input w3-border" id="txtSenha" type="password" name="txtSenha" placeholder="Digite a senha" required>

        <button class="w3-button w3-block w3-teal w3-section w3-padding" type="submit">
            <i class="fa fa-sign-in"></i> Entrar
        </button>
    </form>
</div>
<?php require_once 'rodape.php'; ?>
