<?php
require_once 'verificarAcesso.php';
require_once 'cabecalho.php';
?>
<div class="w3-card-4 w3-white w3-round-large app-card">
    <header class="w3-container w3-teal w3-round-large">
        <h2><i class="fa fa-users"></i> Projeto Lista de Amigos</h2>
    </header>

    <div class="w3-container w3-padding-24">
        <p>Bem-vinda, <b><?= htmlspecialchars($_SESSION['logado'], ENT_QUOTES, 'UTF-8') ?></b>!</p>
        <p class="w3-text-grey">Escolha uma opção para administrar sua lista de amigos.</p>

        <div class="w3-row-padding w3-stretch">
            <div class="w3-half w3-margin-bottom">
                <a class="w3-button w3-teal w3-block w3-padding-32 w3-round" href="cadastro.php">
                    <i class="fa fa-user-plus" style="font-size:52px"></i><br>
                    <span class="w3-large">Cadastrar amigo</span>
                </a>
            </div>
            <div class="w3-half w3-margin-bottom">
                <a class="w3-button w3-blue w3-block w3-padding-32 w3-round" href="listar.php">
                    <i class="fa fa-address-book-o" style="font-size:52px"></i><br>
                    <span class="w3-large">Listar amigos</span>
                </a>
            </div>
        </div>

        <div class="w3-center w3-margin-top">
            <a class="w3-button w3-red w3-round" href="logoutAction.php">
                <i class="fa fa-sign-out"></i> Logout
            </a>
        </div>
    </div>
</div>
<?php require_once 'rodape.php'; ?>
