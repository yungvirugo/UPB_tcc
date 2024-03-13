<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil do Doador</title>
    <link rel="stylesheet" href="../Assets/css/style.css">
    <link rel="icon" href="../Assets/img/Design_sem_nome-removebg-preview (1).png">
</head>

<body>
    <header>

        <div class="logo">
            <a href="../index.html"><img src="../Assets/img/Unidos_Pelo_Bem-removebg-preview.png" alt=""
                    class="logo principal"></a>
        </div>
        <div class="button">
            <div class="button base">

                <a href="../pags/participe.html">
                    <p class="menu option">Participe Já!</p>
                </a>

                <a href="../pags/afiliadas.html">
                    <p class="menu option">O.N.G's Afilidas</p>
                </a>



                <a href="../perfil.php">
                    <p class="menu option">Meu Perfil</p>
                </a>



                <p class="menu option" id="mostrarDiv">Sobre-Nós</p>


            </div>

        </div>
        <div class="button media">
            <div class="media base">

                <a href="https://www.instagram.com/upb.ofc/" target="_blank"><button class="redes"><img
                            src="../Assets/img/instagram.png" alt=""></button></a>

                <a href="https://twitter.com/UPB_Ofc" target="_blank"><button class="redes"><img src="../Assets/img/twitter (2).png" alt=""></button></a>

            </div>
        </div>
    </header>

    <div class="container profile">
        <div class="second profile">
            <div class="doador but">
                <button class="btn option donate" id="openBtnMed">Medicamentos</button>
                <button class="btn option donate" id="openModalBtnvibes">Vestuários</button>
                <button class="btn option donate" id="openModalBtn">Alimentos</button>
            </div>
            <div class="doador but">
                <button class="btn option donate" id="openBtnMoney">Valor em dinheiro</button>
                <button class="btn option donate" id="openBtnHigi">Produtos de Higiene</button>
            </div>

        </div>
        <div class="principal profile">
            <div class="profile foto">
                <img src="../Assets/img/imagem_2023-03-16_075940751-removebg-preview (1).png" alt="fotinha">
            </div>
            <div class="title profile">
                <h2>Bem-vindo,
                    <?php
                    if (!empty($_GET['nome'])) {
                        echo $_GET['nome'];
                    }
                    ?>
                </h2>
            </div>
            <div class="title profile">
                <p>Você está logado como um Doador.</p>
            </div>
            <div class="logouf count">
                <form method="post" action="../logout.php">
                    <div class="centralizar">
                        <input type="submit" value="Sair" class="logout-btn">
                    </div>
                </form>
            </div>

        </div>
    </div>

    <div class="history">
        <div class="title v4">
            <p>Histórico</p>

            <?php
                session_start(); // Certifique-se de ter iniciado a sessão no início do seu script PHP

                // Conexão com o banco de dados
                $conn = new mysqli('localhost', 'root', '', 'ongsdoador_db');
                if ($conn->connect_error) {
                    die("Erro na conexão: " . $conn->connect_error);
                }

                // ID da conta do usuário logado
                $id_conta_usuario = $_SESSION["usuario_id"];

                // Consulta para obter o histórico de doações da conta logada
                $sql = "SELECT ong_afiliada, tipo_alimento, quantidade, validade, peso FROM doacoes WHERE id_conta = ?";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("i", $id_conta_usuario);
                $stmt->execute();
                $result = $stmt->get_result();

                if ($result->num_rows > 0) {
                    // Exibir histórico de doações
                    echo "<div class='history'>";
                    echo "<h2>Histórico de Doações</h2>";
                    echo "<ul>";

                    while ($row = $result->fetch_assoc()) {
                        echo "<li>";
                        echo "ONG: " . $row['ong_afiliada'] . "<br>";
                        echo "Tipo de Alimento: " . $row['tipo_alimento'] . "<br>";
                        echo "Quantidade: " . $row['quantidade'] . "<br>";
                        echo "Validade: " . $row['validade'] . "<br>";
                        echo "Peso: " . $row['peso'] . "<br>";
                        echo "</li>";
                    }

                    echo "</ul>";
                    echo "</div>";
                } else {
                    // Mensagem se não houver histórico de doações
                    echo "<div class='history'>";
                    echo "<h2>Sem Histórico de Doações</h2>";
                    echo "</div>";
                }

                $stmt->close();
                $conn->close();
            ?>

        </div>
    </div>
    <br>
    
    <div class="modal5" id="doacaoHigi">
        <div class="view-higi">
            <form action="../processo_doacao.php" method="post">
                <label for="">descrição e Quantidade:</label>
                <br>
                <input type="text" name="" id="" placeholder="'2 pacotes de 12 unidades de absorvente'">
                <br>
                <label for="">Data de Validade:</label>
                <br>
                <input type="date" name="" id="">
                <br>
                <label for="">Peso:</label>
                <br>
                <input type="text" name="" id="">
                <br>
                <label for="">CPF:</label>
                <br>
                <input type="text" name="" id="">
                <br>
                <label for="ong_afiliada">ONG Afiliada:</label>
                <br>
                <select name="ong_afiliada" id="ong_afiliada">

                    <option value="aleatorio">Aleatório</option>
                        <?php
                        // Conecte-se ao banco de dados e consulte as ONGs afiliadas com preferência de doação em comida
                        $conn = new mysqli('localhost', 'root', '', 'ongsdoador_db');
                        if ($conn->connect_error) {
                            die("Erro na conexão: " . $conn->connect_error);
                        }
                    
                        $sql = "SELECT DISTINCT nome FROM historico_ong WHERE preferencia_doacao = 'Higiene'";
                        $result = $conn->query($sql);
                    
                        while ($row = $result->fetch_assoc()) {
                            echo "<option value='" . $row['nome'] . "'>" . $row['nome'] . "</option>";
                        }
                    
                        $conn->close();
                        ?>
                </select>
                <br>
                <br>
                <button type="submit" class="but cas2">Enviar Doação</button>
            </form>
            <button id="closeBtnHigi"><img src="../Assets/img/close.png" alt="" width="100%" height="auto"></button>
        </div>
    </div>
    <div class="modal4" id="doacaoMoney">
        <div class="view-money">
            <form action="../processo_doacao.php" method="post">
                <label for="">Forma de Pagamento:</label>
                <br>
                <input type="checkbox" name="" id="Yes">
                <label for="">Pix</label>
                <br>
                <input type="checkbox" name="" id="Yes">
                <label for="">Boleto</label>
                <br>
                <label for="">Valor:</label>
                <br>
                <select name="" id="">
                    <option value="">Pix</option>
                    <option value="">Boleto</option>
                </select>
                <br>
                <label for="">CPF:</label>
                <br>
                <input type="text" name="" id="">
                <br>
                <label for="ong_afiliada">ONG Afiliada:</label>
                <br>
                <select name="ong_afiliada" id="ong_afiliada">
                    <option value="aleatorio">Aleatório</option>
                            <?php
                            // Conecte-se ao banco de dados e consulte as ONGs afiliadas com preferência de doação em comida
                            $conn = new mysqli('localhost', 'root', '', 'ongsdoador_db');
                            if ($conn->connect_error) {
                                die("Erro na conexão: " . $conn->connect_error);
                            }
                        
                            $sql = "SELECT DISTINCT nome FROM historico_ong";
                            $result = $conn->query($sql);
                        
                            while ($row = $result->fetch_assoc()) {
                                echo "<option value='" . $row['nome'] . "'>" . $row['nome'] . "</option>";
                            }
                        
                            $conn->close();
                            ?>
                </select>
                <br>
                <br>
                <button type="submit" class="but cas2">Enviar Doação</button>
            </form>
            <button id="close-money"><img src="../Assets/img/close.png" alt="" width="100%" height="auto"></button>
        </div>
    </div>
    <div id="doacaoropModal" class="modal2">
        <div class="view">
            <form action="../processo_doacao.php" method="post">
                <label for="">São roupas usadas?:</label>
                <br>
                <select name="" id="">
                    <option value="">Não</option>
                    <option value="">Sim</option>
                </select>
                <br>
                <label for="">Selecione o tipo de roupa:</label>
                <br>
                <select name="" id="">
                    <option value="">Agasalhos</option>
                    <option value="">Roupas Infantis</option>
                    <option value="">Roupas femininas</option>
                    <option value="">Roupas masculinas</option>
                </select>
                <br>
                <label for="">Faça uma breve descrição sobre o vestuário:</label>
                <br>
                <input type="text" name=""
                    placeholder="1 peça de roupa infantil masculina de frio,1 camiseta feminina tamanho p" id="">
                <br>
                <label for="">Quantidade de peças:</label>
                <br>
                <input type="number" name="" id="">
                <br>
                <label for="cpf">CPF:</label>
                <br>
                <input type="text" name="cpf" id="cpf" required>
                <br>

                <label for="ong_afiliada">ONG Afiliada:</label>
                <br>
                <select name="ong_afiliada" id="ong_afiliada">
                    <option value="aleatorio">Aleatório</option>
                        <?php
                        // Conecte-se ao banco de dados e consulte as ONGs afiliadas com preferência de doação em comida
                        $conn = new mysqli('localhost', 'root', '', 'ongsdoador_db');
                        if ($conn->connect_error) {
                            die("Erro na conexão: " . $conn->connect_error);
                        }
                    
                        $sql = "SELECT DISTINCT nome FROM historico_ong WHERE preferencia_doacao = 'Roupas'";
                        $result = $conn->query($sql);
                    
                        while ($row = $result->fetch_assoc()) {
                            echo "<option value='" . $row['nome'] . "'>" . $row['nome'] . "</option>";
                        }
                    
                        $conn->close();
                        ?>
                </select>
                <br>
                <br>
                <button type="submit" class="but cas2">Enviar Doação</button>
            </form>
            <button id="closeModalBtnvibes"><img src="../Assets/img/close.png" alt="" width="100%"
                    height="auto"></button>
        </div>
    </div>
    <div class="modal3" id="doacaoMed">
        <div class="view-med">
            <form action="../processo_doacao.php" method="post">
                <label for="">Nome Do Medicamento:</label>
                <input type="text" placeholder="'Dramaloz'">
                <br>
                <label for="">É manipulada?</label>
                <br>
                <input type="checkbox" name="" id="Yes" value="">
                <label for="">Sim</label>
                <br>
                <input type="checkbox" name="" id="Yes" value="Não">
                <label for="">Não</label>
                <br>
                <label for="">Dosagem:</label>
                <br>
                <input type="text" placeholder="'120mg'">
                <br>
                <label for="">Quantidade:</label>
                <br>
                <input type="text" name="" id="" placeholder="'2 caixas com 2 cartelas de 6 comprimidos'">
                <br>
                <label for="">Insira á Validade:</label>
                <br>
                <input type="date" name="" id="">
                <br>
                <label for="">CPF:</label>
                <br>
                <input type="text">
                <br>
                <label for="">ONG's Afiliadas:</label>
                <br>

                <select name="ong_afiliada" id="ong_afiliada">
                    <option value="aleatorio">Aleatório</option>
                        <?php
                        // Conecte-se ao banco de dados e consulte as ONGs afiliadas com preferência de doação em comida
                        $conn = new mysqli('localhost', 'root', '', 'ongsdoador_db');
                        if ($conn->connect_error) {
                            die("Erro na conexão: " . $conn->connect_error);
                        }
                    
                        $sql = "SELECT DISTINCT nome FROM historico_ong WHERE preferencia_doacao = 'Medicamentos'";
                        $result = $conn->query($sql);
                    
                        while ($row = $result->fetch_assoc()) {
                            echo "<option value='" . $row['nome'] . "'>" . $row['nome'] . "</option>";
                        }
                    
                        $conn->close();
                        ?>
                </select>
                <br>
                <br>
                <button type="submit" class="but cas2">Enviar Doação</button>

            </form>
            <button id="close-med"><img src="../Assets/img/close.png" alt="" width="100%" height="auto"></button>
        </div>
    </div>
    <div id="doacaoModal" class="modal">
        <div class="modal-content">
            <h2>Formulário de Doação de Alimentos</h2>
            <form action="../processo_doacao.php" method="post" netlify>
                <label for="tipo_alimento">Tipo de Alimento:</label>
                <br>
                <select name="tipo_alimento" id="tipo_alimento">
                    <option value="Cesta Básica">Cesta Básica</option>
                    <option value="Outro Tipo de Alimento">Outro Tipo de Alimento</option>
                </select>
                <br>

                <label for="quantidade">Quantidade:</label>
                <br>
                <input type="number" name="quantidade" id="quantidade" required>
                <br>

                <label for="validade">Validade:</label>
                <br>
                <input type="date" name="validade" id="validade" required>
                <br>

                <label for="peso">Peso (em quilogramas):</label>
                <br>
                <input type="number" name="peso" id="peso" step="0.01" required>
                <br>
                <label for="">CPF:</label>
                <br>
                <input type="text" name="cpf" id="cpf" required>
                <br>

                <label for="ong_afiliada">ONG Afiliada:</label>
                <br>
                <select name="ong_afiliada" id="ong_afiliada">
                    <option value="aleatorio">Aleatório</option>
                    <?php
                    // Conecte-se ao banco de dados e consulte as ONGs afiliadas com preferência de doação em comida
                    $conn = new mysqli('localhost', 'root', '', 'ongsdoador_db');
                    if ($conn->connect_error) {
                        die("Erro na conexão: " . $conn->connect_error);
                    }
                
                    $sql = "SELECT DISTINCT nome FROM historico_ong WHERE preferencia_doacao = 'Comida'";
                    $result = $conn->query($sql);
                
                    while ($row = $result->fetch_assoc()) {
                        echo "<option value='" . $row['nome'] . "'>" . $row['nome'] . "</option>";
                    }
                
                    $conn->close();
                    ?>
                </select>
                <br>
                <br>
                <button type="submit" class="but cas2">Enviar Doação</button>
            </form>
            <button id="closeModalBtn"><img src="../Assets/img/close.png" alt="" width="100%" height="auto"></button>
        </div>
    </div>

    <button onclick="scrollToTop()" class="but-volt"><img src="/tcc/Assets/img/right.png" alt=""></button>
    <button onclick="toggleHighContrast()" class="night"><img src="../Assets/img/contrast.png" alt=""></button>
    <button onclick="aumentarTamanhoTexto()" class="font"><img src="../Assets/img/lupa.png" alt=""></button>

    <script>
        function scrollToTop() {
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        }

        document.addEventListener("DOMContentLoaded", function () {
            var form = document.querySelector("form");
            var cpfInput = document.getElementById("cpf");
            var mostrarModalButton = document.getElementById("mostrarModal");
            var doacaoModal = document.getElementById("doacaoModal");

            form.addEventListener("submit", function (event) {
                // Verifica se o modal está visível
                if (doacaoModal.style.display === "block") {
                    var cpf = cpfInput.value;

                    if (!validarCPF(cpf)) {
                        alert("CPF inválido. Por favor, insira um CPF válido.");
                        event.preventDefault(); // Impede o envio do formulário
                    }
                }
            });
        });

        // Adicione os eventos de clique para exibir os modais
        document.getElementById("openBtnHigi").addEventListener("click", function () {
            document.getElementById("doacaoHigi").style.display = "block";
        });

        document.getElementById("closeBtnHigi").addEventListener("click", function () {
            document.getElementById("doacaoHigi").style.display = "none";
        });

        document.getElementById("openModalBtn").addEventListener("click", function () {
            document.getElementById("doacaoModal").style.display = "block";
        });

        document.getElementById("closeModalBtn").addEventListener("click", function () {
            document.getElementById("doacaoModal").style.display = "none";
        });

        document.getElementById("openModalBtnvibes").addEventListener("click", function () {
            document.getElementById("doacaoropModal").style.display = "block";
        });

        document.getElementById("closeModalBtnvibes").addEventListener("click", function () {
            document.getElementById("doacaoropModal").style.display = "none";
        });

        document.getElementById("openBtnMed").addEventListener("click", function () {
            document.getElementById("doacaoMed").style.display = "block";
        });

        document.getElementById("close-med").addEventListener("click", function () {
            document.getElementById("doacaoMed").style.display = "none";
        });

        document.getElementById("openBtnMoney").addEventListener("click", function () {
            document.getElementById("doacaoMoney").style.display = "block";
        });

        document.getElementById("close-money").addEventListener("click", function () {
            document.getElementById("doacaoMoney").style.display = "none";
        });

        function toggleHighContrast() {
            var bodyElement = document.querySelector('body');
            bodyElement.classList.toggle('high-contrast');

            // Verifica se a classe high-contrast está ativada
            if (bodyElement.classList.contains('high-contrast')) {
                // Se estiver ativada, define a cor para as classes desejadas
                applyTextColorsForHighContrast(true);
                applyBackGroundForHighContrast(true);
            } else {
                // Se estiver desativada, remove a cor personalizada
                applyTextColorsForHighContrast(false);
                applyBackGroundForHighContrast(false);
            }
        }

        function aumentarTamanhoTexto() {
            var targetClasses = ['title v5', 'title v4', 'title v3', 'title v2', 'title v1', 'text v1', 'text v2', 'text v3', 'text sobre', 'title sobre', 'title integrantes', 'text integrante', 'menu option', 'footer links', 'text v6', 'title v6', 'text v5']; // Substitua com as suas classes desejadas

            targetClasses.forEach(function (className) {
                var elements = document.getElementsByClassName(className);

                for (var i = 0; i < elements.length; i++) {
                    // Obtém o tamanho atual do texto em pixels
                    var currentSize = parseInt(window.getComputedStyle(elements[i]).fontSize);

                    // Aumenta o tamanho do texto em 2 pixels
                    elements[i].style.fontSize = (currentSize + 2) + 'px';
                }
            });
        }

        function applyTextColorsForHighContrast(isActive) {
            var targetClasses = ['title v5', 'title v4', 'title v3', 'title v2', 'title v1', 'text v1', 'text v2', 'text v3', 'text sobre', 'title sobre', 'title integrantes', 'text integrante', 'text v6', 'title v6', 'text v5']; // Substitua com as suas classes desejadas

            targetClasses.forEach(function (className) {
                var elements = document.getElementsByClassName(className);

                for (var i = 0; i < elements.length; i++) {
                    if (isActive) {
                        // Aplica a cor desejada quando o modo de alto contraste está ativado
                        elements[i].style.color = '#c0c700';
                    } else {
                        // Remove a cor personalizada quando o modo de alto contraste é desativado
                        elements[i].style.color = '';
                    }
                }
            });
        }

        function applyBackGroundForHighContrast(isActive) {
            var targetClasses = ['retro explica', 'second profile']; // Substitua com as suas classes desejadas

            targetClasses.forEach(function (className) {
                var elements = document.getElementsByClassName(className);

                for (var i = 0; i < elements.length; i++) {
                    if (isActive) {
                        // Aplica a cor desejada quando o modo de alto contraste está ativado
                        elements[i].style.backgroundColor = 'black';
                    } else {
                        // Remove a cor personalizada quando o modo de alto contraste é desativado
                        elements[i].style.backgroundColor ='';
                    }
                }
            });
        }
    </script>
</body>

<!--
    
            <div class="log">
                <div class="logsec">
                    <form action="" method="post" class="cad">
                        <label for="">Doações:</label>
                        <br>
                        <br>
                        <br>
                        <label for="">Forma de pagamento:</label>
                        <br>
                        <select name="" id="">
                            <option value="">escolha</option>
                            <option value="">Pix</option>
                            <option value="">boleto</option>
                            <option value="">débito</option>
                            <option value="">crédito</option>
                        </select>
                        <br>
                        <label for="">Escolha o Valor:</label>
                        <br>
                        <select name="" id="">
                            <option value="">Escolha</option>
                            <option value="">faculdade1</option>
                            <option value="">faculdade2</option>
                            <option value="">faculdade3</option>
                        </select>
                        <br>
                        <label for="">Escolha a Ong:</label>
                        <br>
                        <select name="" id="">
                            <option value="">escolha</option>
                            <option value="">1</option>
                            <option value="">2</option>
                            <option value="">3</option>
                            <option value="">4</option>
                        </select>
                        <br>
                        <br>
                        <br>
                        <br>
                        <input type="button" value="Doar" class="but cas">
                    </form>
                </div>
            </div>
 -->

</html>