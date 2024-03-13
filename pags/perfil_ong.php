<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil do Ong</title>
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



                <a href="../pags/sobre.html">
                    <p class="menu option" id="mostrarDiv">Sobre-Nós</p>
                </a>


            </div>
        </div>
        <div class="button media">
            <div class="media base">

                <a href="https://www.instagram.com/upb.ofc/" target="_blank"><button class="redes"><img
                            src="../Assets/img/instagram.png" alt=""></button></a>

                <a href="https://twitter.com/UPB_Ofc" target="_blank"><button class="redes"><img
                            src="../Assets/img/twitter (2).png" alt=""></button></a>

            </div>
        </div>
    </header>

    <div class="container profile">
        <div class="second profile">
            <div class="logtree">
                <div class="logfoor">
                    <form action="../processo_postagem.php" method="post" enctype="multipart/form-data" class="cad">
                        <div>
                            <label for="titulo">Título De Sua Ong:</label>
                            <input type="text" name="titulo" id="titulo" required>
                        </div>
                        <div>
                            <label for="cnpj">Seu CNPJ:</label>
                            <input type="text" name="cnpj" id="cnpj">
                        </div>
                        <div>
                            <label for="texto">Texto Sobre a Ong:</label>
                            <br>
                            <textarea name="texto" id="texto" required></textarea>
                        </div>
                        <div>
                            <label for="imagem">Sua Logo:</label>
                            <input type="file" name="imagem" id="imagem" accept="image/*" required class="image send">
                        </div>
                        <div>
                            <label for="preferencia">Preferência de Doação:</label>
                            <select name="preferencia" id="preferencia">
                                <option value="nenhuma">Nenhuma preferência</option>
                                <option value="comida">Comida</option>
                                <option value="roupas">Roupas</option>
                                <option value="medicamentos">Medicamentos</option>
                                <option value="higiene">Higiene</option>
                                <option value="dinheiro">Dinheiro</option>
                            </select>
                        </div>
                        <br>
                        <div>

                            <button type="submit" class="but cas">Criar Postagem</button>
                        </div>
                    </form>
                    <div id="historico-ong" style="display: none;">
                        <!-- Conteúdo da div 'historico-ong' aqui -->
                    </div>
                </div>
            </div>
        </div>

        <div class="principal profile">
            <div class="profile foto">
                <img src="../Assets/img/do-utilizador.png" alt="fotinha" id="usuario-profile">
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
                <p>Você está logado como uma ONG.</p>
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

    <button onclick="toggleHighContrast()" class="night"><img src="../Assets/img/contrast.png" alt=""></button>
    <button onclick="aumentarTamanhoTexto()" class="font"><img src="../Assets/img/lupa.png" alt=""></button>

    <script>
        var valorDoPHP = "<?php echo $logado; ?>";
        console.log(valorDoPHP);

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
    </script>
</body>