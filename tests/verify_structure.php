<?php
$errors = [];

function requireFile(string $path, array &$errors): ?string
{
    if (!is_file($path)) {
        $errors[] = "Arquivo ausente: {$path}";
        return null;
    }

    return file_get_contents($path);
}

$baseFiles = ['banco/agenda08_lista_amigos.sql', 'conexaoBD.php', 'cabecalho.php', 'rodape.php'];
foreach ($baseFiles as $file) {
    requireFile($file, $errors);
}

$sql = is_file('banco/agenda08_lista_amigos.sql') ? file_get_contents('banco/agenda08_lista_amigos.sql') : '';
if (!preg_match('/CREATE\s+TABLE\s+(?:IF\s+NOT\s+EXISTS\s+)?`?usuario`?/i', $sql)) {
    $errors[] = 'SQL não cria a tabela usuario.';
}
if (!preg_match('/CREATE\s+TABLE\s+(?:IF\s+NOT\s+EXISTS\s+)?`?amigo`?/i', $sql)) {
    $errors[] = 'SQL não cria a tabela amigo.';
}
if (stripos($sql, 'gabi') === false || stripos($sql, 'gabi123') === false) {
    $errors[] = 'SQL não contém o usuário didático gabi/gabi123.';
}

$authFiles = ['index.php', 'loginAction.php', 'verificarAcesso.php', 'acessoNegado.php', 'logoutAction.php', 'principal.php'];
foreach ($authFiles as $file) {
    requireFile($file, $errors);
}

$index = is_file('index.php') ? file_get_contents('index.php') : '';
if (stripos($index, 'type="password"') === false && stripos($index, "type='password'") === false) {
    $errors[] = 'index.php não possui campo de senha com type=password.';
}

$loginAction = is_file('loginAction.php') ? file_get_contents('loginAction.php') : '';
if (strpos($loginAction, 'unset($_SESSION[\'logado\'])') === false) {
    $errors[] = 'loginAction.php não limpa uma autenticação anterior antes de validar novas credenciais.';
}
if (stripos($loginAction, 'session_start') === false || strpos($loginAction, '$_SESSION[\'logado\']') === false) {
    $errors[] = 'loginAction.php não inicia sessão e/ou não define $_SESSION[logado].';
}

$verificar = is_file('verificarAcesso.php') ? file_get_contents('verificarAcesso.php') : '';
if (stripos($verificar, 'session_start') === false || stripos($verificar, 'acessoNegado.php') === false || strpos($verificar, '$_SESSION[\'logado\']') === false) {
    $errors[] = 'verificarAcesso.php não contém a proteção esperada.';
}

$logout = is_file('logoutAction.php') ? file_get_contents('logoutAction.php') : '';
if (stripos($logout, 'unset') === false || strpos($logout, '$_SESSION[\'logado\']') === false || stripos($logout, 'index.php') === false) {
    $errors[] = 'logoutAction.php não remove a sessão e retorna ao login.';
}

$principal = is_file('principal.php') ? file_get_contents('principal.php') : '';
if (stripos($principal, 'verificarAcesso.php') === false) {
    $errors[] = 'principal.php não está protegido por verificarAcesso.php.';
}

$createReadFiles = ['cadastro.php', 'cadastroAction.php', 'listar.php'];
foreach ($createReadFiles as $file) {
    requireFile($file, $errors);
}

$cadastro = is_file('cadastro.php') ? file_get_contents('cadastro.php') : '';
foreach (['nome', 'sobrenome', 'telefone', 'email'] as $campo) {
    if (stripos($cadastro, 'name="' . $campo . '"') === false && stripos($cadastro, "name='" . $campo . "'") === false) {
        $errors[] = "cadastro.php não contém o campo {$campo}.";
    }
}
if (stripos($cadastro, 'verificarAcesso.php') === false) {
    $errors[] = 'cadastro.php não está protegido.';
}

$cadastroAction = is_file('cadastroAction.php') ? file_get_contents('cadastroAction.php') : '';
if (stripos($cadastroAction, 'INSERT INTO') === false || stripos($cadastroAction, 'amigo') === false || stripos($cadastroAction, 'prepare') === false) {
    $errors[] = 'cadastroAction.php não implementa INSERT preparado em amigo.';
}
if (stripos($cadastroAction, 'verificarAcesso.php') === false) {
    $errors[] = 'cadastroAction.php não está protegido.';
}

$listar = is_file('listar.php') ? file_get_contents('listar.php') : '';
if (stripos($listar, 'SELECT') === false || stripos($listar, 'FROM amigo') === false) {
    $errors[] = 'listar.php não consulta a tabela amigo.';
}
if (stripos($listar, 'verificarAcesso.php') === false) {
    $errors[] = 'listar.php não está protegido.';
}

$updateDeleteFiles = ['editar.php', 'editarAction.php', 'excluir.php'];
foreach ($updateDeleteFiles as $file) {
    requireFile($file, $errors);
}

$editar = is_file('editar.php') ? file_get_contents('editar.php') : '';
if (stripos($editar, 'SELECT') === false || stripos($editar, 'FROM amigo') === false || stripos($editar, 'WHERE idamigo') === false || stripos($editar, 'prepare') === false) {
    $errors[] = 'editar.php não carrega o amigo por ID com consulta preparada.';
}
if (stripos($editar, 'filter_input') === false || stripos($editar, 'FILTER_VALIDATE_INT') === false) {
    $errors[] = 'editar.php não valida o ID recebido.';
}
if (stripos($editar, 'verificarAcesso.php') === false) {
    $errors[] = 'editar.php não está protegido.';
}

$editarAction = is_file('editarAction.php') ? file_get_contents('editarAction.php') : '';
if (stripos($editarAction, 'UPDATE amigo') === false || stripos($editarAction, 'WHERE idamigo') === false || stripos($editarAction, 'prepare') === false) {
    $errors[] = 'editarAction.php não implementa UPDATE preparado.';
}
if (stripos($editarAction, 'FILTER_VALIDATE_INT') === false) {
    $errors[] = 'editarAction.php não valida o ID recebido.';
}

$excluir = is_file('excluir.php') ? file_get_contents('excluir.php') : '';
if (stripos($excluir, 'DELETE FROM amigo') === false || stripos($excluir, 'WHERE idamigo') === false || stripos($excluir, 'prepare') === false) {
    $errors[] = 'excluir.php não implementa DELETE preparado.';
}
if (stripos($excluir, 'filter_input') === false || stripos($excluir, 'FILTER_VALIDATE_INT') === false) {
    $errors[] = 'excluir.php não valida o ID recebido.';
}

$listarConfirmacao = is_file('listar.php') ? file_get_contents('listar.php') : '';
if (stripos($listarConfirmacao, 'confirm(') === false) {
    $errors[] = 'listar.php não pede confirmação antes da exclusão.';
}

$readme = requireFile('README.md', $errors) ?? '';
foreach (['htdocs', 'phpMyAdmin', 'pwii', 'gabi', 'gabi123', 'Cadastrar', 'Listar', 'Editar', 'Excluir'] as $termo) {
    if (stripos($readme, $termo) === false) {
        $errors[] = "README.md não contém a orientação esperada: {$termo}.";
    }
}

if ($errors) {
    fwrite(STDERR, "FAIL\n- " . implode("\n- ", $errors) . "\n");
    exit(1);
}

echo "PASS: estrutura base verificada.\n";
