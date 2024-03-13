<?php
// Inicie a sessão
session_start();

// Encerre a sessão (isso deslogará o usuário)
session_destroy();

// Redirecione o usuário de volta para a página de login ou outra página inicial
header('Location: ../tcc/index.html');
exit();
?>
