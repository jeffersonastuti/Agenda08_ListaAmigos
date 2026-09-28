<?php
require_once 'verificarAcesso.php';

$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT, ['options' => ['min_range' => 1]]);
if ($id === false || $id === null) {
    header('Location: listar.php?mensagem=id_invalido');
    exit;
}

require_once 'conexaoBD.php';

$stmt = $conexao->prepare('SELECT idamigo, nome, sobrenome, telefone, email FROM amigo WHERE idamigo = ?');
$stmt->bind_param('i', $id);
$stmt->execute();
$resultado = $stmt->get_result();
$amigo = $resultado->fetch_assoc();
$stmt->close();
$conexao->close();

if ($amigo === null) {
    header('Location: listar.php?mensagem=nao_encontrado');
    exit;
}

$erro = $_GET['erro'] ?? '';
require_once 'cabecalho.php';
?>
<div class="w3-card-4 w3-white w3-round-large app-narrow">
    <header class="w3-container w3-blue w3-round-large">
        <h2><i class="fa fa-pencil"></i> Editar amigo</h2>
    </header>

    <form class="w3-container w3-padding-24" action="editarAction.php" method="post">
        <?php if ($erro === 'campos'): ?>
            <div class="w3-panel w3-pale-red w3-leftbar w3-border-red">
                <p>Preencha todos os campos antes de salvar.</p>
            </div>
        <?php endif; ?>

        <input type="hidden" name="id" value="<?= (int) $amigo['idamigo'] ?>">

        <label for="nome"><b>Nome</b></label>
        <input class="w3-input w3-border w3-margin-bottom" id="nome" name="nome" type="text" maxlength="60" value="<?= htmlspecialchars($amigo['nome'], ENT_QUOTES, 'UTF-8') ?>" required>

        <label for="sobrenome"><b>Sobrenome</b></label>
        <input class="w3-input w3-border w3-margin-bottom" id="sobrenome" name="sobrenome" type="text" maxlength="60" value="<?= htmlspecialchars($amigo['sobrenome'], ENT_QUOTES, 'UTF-8') ?>" required>

        <label for="telefone"><b>Telefone</b></label>
        <input class="w3-input w3-border w3-margin-bottom" id="telefone" name="telefone" type="text" maxlength="20" value="<?= htmlspecialchars($amigo['telefone'], ENT_QUOTES, 'UTF-8') ?>" required>

        <label for="email"><b>E-mail</b></label>
        <input class="w3-input w3-border w3-margin-bottom" id="email" name="email" type="email" maxlength="120" value="<?= htmlspecialchars($amigo['email'], ENT_QUOTES, 'UTF-8') ?>" required>

        <div class="w3-bar w3-margin-top">
            <a class="w3-button w3-light-grey w3-round" href="listar.php">
                <i class="fa fa-arrow-left"></i> Cancelar
            </a>
            <button class="w3-button w3-blue w3-round w3-right" type="submit">
                <i class="fa fa-save"></i> Salvar alterações
            </button>
        </div>
    </form>
</div>
<?php require_once 'rodape.php'; ?>
