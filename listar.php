<?php
require_once 'verificarAcesso.php';
require_once 'conexaoBD.php';

$sql = 'SELECT idamigo, nome, sobrenome, telefone, email FROM amigo ORDER BY nome, sobrenome';
$resultado = $conexao->query($sql);
$mensagem = $_GET['mensagem'] ?? '';

require_once 'cabecalho.php';
?>
<div class="w3-card-4 w3-white w3-round-large app-card">
    <header class="w3-container w3-teal w3-round-large">
        <h2><i class="fa fa-address-book-o"></i> Lista de amigos</h2>
    </header>

    <div class="w3-container w3-padding-24">
        <?php if ($mensagem === 'cadastrado'): ?>
            <div class="w3-panel w3-pale-green w3-leftbar w3-border-green">
                <p>Amigo cadastrado com sucesso.</p>
            </div>
        <?php elseif ($mensagem === 'editado'): ?>
            <div class="w3-panel w3-pale-green w3-leftbar w3-border-green">
                <p>Amigo atualizado com sucesso.</p>
            </div>
        <?php elseif ($mensagem === 'excluido'): ?>
            <div class="w3-panel w3-pale-green w3-leftbar w3-border-green">
                <p>Amigo excluído com sucesso.</p>
            </div>
        <?php elseif ($mensagem === 'nao_encontrado'): ?>
            <div class="w3-panel w3-pale-yellow w3-leftbar w3-border-yellow">
                <p>O amigo informado não foi encontrado.</p>
            </div>
        <?php elseif ($mensagem === 'id_invalido'): ?>
            <div class="w3-panel w3-pale-red w3-leftbar w3-border-red">
                <p>O código informado é inválido.</p>
            </div>
        <?php endif; ?>

        <div class="w3-bar w3-margin-bottom">
            <a class="w3-button w3-light-grey w3-round" href="principal.php">
                <i class="fa fa-home"></i> Página principal
            </a>
            <a class="w3-button w3-teal w3-round w3-right" href="cadastro.php">
                <i class="fa fa-user-plus"></i> Novo amigo
            </a>
        </div>

        <div class="w3-responsive">
            <table class="w3-table-all w3-hoverable">
                <thead>
                    <tr class="w3-teal">
                        <th>Código</th>
                        <th>Nome</th>
                        <th>Sobrenome</th>
                        <th>Telefone</th>
                        <th>E-mail</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                <?php if ($resultado && $resultado->num_rows > 0): ?>
                    <?php while ($linha = $resultado->fetch_assoc()): ?>
                        <tr>
                            <td><?= (int) $linha['idamigo'] ?></td>
                            <td><?= htmlspecialchars($linha['nome'], ENT_QUOTES, 'UTF-8') ?></td>
                            <td><?= htmlspecialchars($linha['sobrenome'], ENT_QUOTES, 'UTF-8') ?></td>
                            <td><?= htmlspecialchars($linha['telefone'], ENT_QUOTES, 'UTF-8') ?></td>
                            <td><?= htmlspecialchars($linha['email'], ENT_QUOTES, 'UTF-8') ?></td>
                            <td class="table-actions">
                                <a class="w3-button w3-small w3-blue w3-round" href="editar.php?id=<?= (int) $linha['idamigo'] ?>">
                                    <i class="fa fa-pencil"></i> Editar
                                </a>
                                <a class="w3-button w3-small w3-red w3-round" href="excluir.php?id=<?= (int) $linha['idamigo'] ?>" onclick="return confirm('Tem certeza que deseja excluir este amigo?');">
                                    <i class="fa fa-trash"></i> Excluir
                                </a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="6" class="w3-center w3-padding-24">Nenhum amigo cadastrado.</td>
                    </tr>
                <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?php
$conexao->close();
require_once 'rodape.php';
?>
