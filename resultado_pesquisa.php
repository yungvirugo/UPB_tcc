<?php
// Conexão com o banco de dados
$conn = new mysqli('localhost', 'root', '', 'ongsdoador_db');

if ($conn->connect_error) {
    die("Erro na conexão: " . $conn->connect_error);
}

$consulta = $_GET['q'];

// Consulta SQL para pesquisar ONGs
$sql = "SELECT * FROM postagem WHERE titulo LIKE '%$consulta%'";
$result = $conn->query($sql);

// Exibir resultados
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "Nome da ONG: " . $row['texto'] . "<br>";
    }
} else {
    echo "Nenhuma ONG encontrada.";
}

$conn->close();
?>