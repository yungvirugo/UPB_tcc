<?php
session_start(); // Certifique-se de ter iniciado a sessão no início do seu script PHP

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $tipo_alimento = $_POST["tipo_alimento"];
    $quantidade = $_POST["quantidade"];
    $validade = $_POST["validade"];
    $peso = $_POST["peso"];
    $cpf = $_POST["cpf"];

    // Verifica se a chave "preferencia_doacao" está definida no array $_POST
    $preferencia_doacao = isset($_POST["preferencia_doacao"]) ? $_POST["preferencia_doacao"] : "";

    if ($preferencia_doacao == "aleatorio") {
        // Conecte-se ao banco de dados e selecione aleatoriamente uma ONG com a preferência de doação em alimentos
        $conn = new mysqli('localhost', 'root', '', 'ongsdoador_db');
        if ($conn->connect_error) {
            die("Erro na conexão: " . $conn->connect_error);
        }

        $sql = "SELECT DISTINCT titulo FROM postagem WHERE preferencia_doacao = 'Comida' ORDER BY RAND() LIMIT 1";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $ong_afiliada = $row['titulo'];
        } else {
            // Tratar caso não haja ONGs com preferência de doação em comida
            echo "Nenhuma ONG encontrada para a preferência de doação escolhida.";
            exit;
        }

        $conn->close();
    } else {
        // Se uma preferência específica de doação foi escolhida
        $ong_afiliada = $_POST["ong_afiliada"];
    }

    $id_conta_usuario = $_SESSION["usuario_id"];

    // Conecte-se ao banco de dados
    $conn = new mysqli('localhost', 'root', '', 'ongsdoador_db');

    if ($conn->connect_error) {
        die("Erro na conexão: " . $conn->connect_error);
    }

    // Inserir dados na tabela 'doacoes'
    $sql = "INSERT INTO doacoes (tipo_alimento, quantidade, validade, peso, cpf, ong_afiliada, id_conta) VALUES (?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sissisi", $tipo_alimento, $quantidade, $validade, $peso, $cpf, $ong_afiliada,  $id_conta_usuario);
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        echo "Doação registrada com sucesso!";
        echo "<script>window.location.href = '../tcc/complete_donate.html';</script>";
    } else {
        echo "Erro ao registrar a doação.";
    }

    $stmt->close();
    $conn->close();
}
?>
