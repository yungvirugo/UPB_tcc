<?php
// Conexão com o banco de dados
$conn = new mysqli('localhost', 'root', '', 'ongsdoador_db');

if ($conn->connect_error) {
    die("Erro na conexão: " . $conn->connect_error);
}

$tipo = $_POST['tipo'];
$nome = $_POST['nome'];
$email = $_POST['email'];
$senha = password_hash($_POST['senha'], PASSWORD_DEFAULT);

if ($tipo === 'ong' || $tipo === 'doador') {
    // Prepare a consulta SQL
    $sql = "INSERT INTO usuário (nome, email, senha, tipo) VALUES ('$nome', '$email', '$senha', '$tipo')";

    if ($conn->query($sql) === TRUE) {
        // Redirecionar para a página de login após o cadastro ser concluído com sucesso
        header("Location: ../tcc/pags/login.html");
        exit; // Certifique-se de sair após o redirecionamento
    } else {
        echo "Erro ao cadastrar: " . $conn->error;
    }
} else {
    echo "Tipo de conta inválido!";
}

// Feche a conexão com o banco de dados
$conn->close();
?>
