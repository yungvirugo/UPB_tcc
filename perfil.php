<?php
$conn = new mysqli('localhost', 'root', '', 'ongsdoador_db');

if ($conn->connect_error) {
    die("Erro na conexão: " . $conn->connect_error);
}
session_start(); // Inicia a sessão (caso ainda não esteja iniciada)

// Verifica se o usuário está logado
if (isset($_SESSION['usuario_id'])) {
    // O usuário está logado, então redireciona para a página de perfil de doador ou ONG
    $tipoConta = $_SESSION['tipo']; // Obtém o tipo de conta do usuário logado

    if ($tipoConta == 'doador') {
        header('Location: ../tcc/pags/perfil_doador.php?nome=' . $row['nome']);
    } elseif ($tipoConta == 'ong') {
        header('Location: ../tcc/pags/perfil_ong.php?nome=' . $row['nome']);
    }
} else {
    // O usuário não está logado, então redireciona para a página de login
    header('Location: ../tcc/pags/login.html');
}
?>
