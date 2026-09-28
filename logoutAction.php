<?php
require_once 'verificarAcesso.php';

unset($_SESSION['logado']);
session_regenerate_id(true);

header('Location: index.php');
exit;
