<?php
require_once 'verificarAcesso.php';
require_once 'cabecalho.php';

$erro = $_GET['erro'] ?? '';
?>
<div class="w3-card-4 w3-white w3-round-large app-narrow">
    <header class="w3-container w3-teal w3-round-large">
        <h2><i class="fa fa-user-plus"></i> Cadastrar amigo</h2>
    </header>

    <form class="w3-container w3-padding-24" action="cadastroAction.php" method="post">
        <?php if ($erro === 'campos'): ?>
            <div class="w3-panel w3-pale-red w3-leftbar w3-border-red">
                <p>Preencha todos os campos antes de salvar.</p>
            </div>
        <?php endif; ?>

        <label for="nome"><b>Nome</b></label>
        <input class="w3-input w3-border w3-margin-bottom" id="nome" name="nome" type="text" maxlength="60" required>

        <label for="sobrenome"><b>Sobrenome</b></label>
        <input class="w3-input w3-border w3-margin-bottom" id="sobrenome" name="sobrenome" type="text" maxlength="60" required>

        <label for="telefone"><b>Telefone</b></label>
        <input class="w3-input w3-border w3-margin-bottom" id="telefone" name="telefone" type="text" maxlength="20" placeholder="(11) 99999-9999" required>

        <label for="email"><b>E-mail</b></label>
        <input class="w3-input w3-border w3-margin-bottom" id="email" name="email" type="email" maxlength="120" placeholder="nome@exemplo.com" required>

        <div class="w3-bar w3-margin-top">
            <a class="w3-button w3-light-grey w3-round" href="principal.php">
                <i class="fa fa-arrow-left"></i> Voltar
            </a>
            <button class="w3-button w3-teal w3-round w3-right" type="submit">
                <i class="fa fa-save"></i> Salvar amigo
            </button>
        </div>
    </form>
</div>
<?php require_once 'rodape.php'; ?>
