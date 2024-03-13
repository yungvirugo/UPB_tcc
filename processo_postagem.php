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

// Processar o formulário
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $titulo = $_POST["titulo"];
    $texto = $_POST["texto"];
    $cnpj = $_POST["cnpj"];
    $imagem = $_FILES["imagem"]["name"];
    $imagem_temp = $_FILES["imagem"]["tmp_name"];
    $preferencia = $_POST["preferencia"];

    // Mover a imagem para um diretório no servidor
    move_uploaded_file($imagem_temp, "../tcc/imagens/$imagem");

    // Inserir os dados na tabela 'historico_ong'
    $sql = "INSERT INTO historico_ong (nome, texto, logo, cnpj, preferencia_doacao) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssss", $titulo, $texto, $imagem, $cnpj, $preferencia);
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        echo "Postagem criada com sucesso!";
    } else {
        echo "Erro ao criar a postagem.";
    }

    $stmt->close();
    $conn->close();
}
?>