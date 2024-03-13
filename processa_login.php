<?php
// Conexão com o banco de dados
$conn = new mysqli('localhost', 'root', '', 'ongsdoador_db');

if ($conn->connect_error) {
    die("Erro na conexão: " . $conn->connect_error);
}

$tipo = $_POST['tipo'];
$email = $_POST['email'];
$senha = $_POST['senha'];

$sql = "SELECT * FROM usuário WHERE email='$email'";
$result = $conn->query($sql);

// Resto do seu código ...

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    if (password_verify($senha, $row['senha'])) {
        if ($tipo === 'ong' && $row['tipo'] === 'ong') {
            // Autenticação bem-sucedida para uma conta do tipo 'ong'
            session_start();
            $_SESSION['tipo'] = 'ong';
            $_SESSION['usuario_id'] = $row['usuario_id'];
            header('Location: ../tcc/pags/perfil_ong.php?nome=' . $row['nome']);
            exit();
        } elseif ($tipo === 'doador' && $row['tipo'] === 'doador') {
            // Autenticação bem-sucedida para uma conta do tipo 'doador'
            session_start();
            $_SESSION['tipo'] = 'doador';
            $_SESSION['usuario_id'] = $row['usuario_id'];
            header('Location: ../tcc/pags/perfil_doador.php?nome=' . $row['nome']);
            exit();
        } else {
            echo "Tipo de conta incorreto para este login.";
        }
    } else {
        echo "Senha incorreta.";
    }
} else {
    echo "Email não encontrado.";
}

$conn->close();

?>
