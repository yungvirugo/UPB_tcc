<?php
// Conexão com o banco de dados
$host = "localhost";
$usuario = "root";
$senha = "";
$banco = "ongsdoador_db";

$conn = new mysqli($host, $usuario, $senha, $banco);

if ($conn->connect_error) {
    die("Falha na conexão com o banco de dados: " . $conn->connect_error);
}

// Consulta para recuperar as postagens
$sql = "SELECT * FROM historico_ong";
$result = $conn->query($sql);

$postagens = array();

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $postagens[] = $row;
    }
}

$conn->close();

// Retorna as postagens em formato JSON
echo json_encode($postagens);
?>
