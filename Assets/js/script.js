// JavaScript para mostrar/ocultar a janela modal
var openModalBtn = document.getElementById("openModalBtn");
var doacaoModal = document.getElementById("doacaoModal");
var closeModalBtn = document.getElementById("closeModalBtn");

openModalBtn.addEventListener("click", function () {
    doacaoModal.style.display = "block";
});

closeModalBtn.addEventListener("click", function () {
    doacaoModal.style.display = "none";
});


function atualizarSelecao() {
    var opcaoOng = document.getElementById("opcao-ong").value;
    var imagemOng = document.getElementById("imagem-ong");
    var textoInformativo = document.getElementById("texto-informativo");
    var titleInformativo = document.getElementById("title-informativo");

    // Defina imagens e textos para as diferentes opções de ONGs
    if (opcaoOng === "ong1") {
        imagemOng.src = "/Assets/img/Design_sem_nome-removebg-preview (1).png";
        titleInformativo.textContent = "UPB";
        textoInformativo.textContent = "Escolha a ONG que mais lhe agrada.";
    } else if (opcaoOng === "ong2") {
        imagemOng.src = "imagem_ong2.jpg";
        titleInformativo.textContent = "UPB";
        textoInformativo.textContent = "Texto informativo para a ONG 2";
    } else if (opcaoOng === "ong3") {
        imagemOng.src = "/Assets/img/Logo_proara.jpeg";
        titleInformativo.textContent = "PROARA";
        textoInformativo.textContent = "O Proara Projeto Araci acredita que intervenções na atmosfera da educação, cultura e lazer são imprescindíveis na transformação comunitária.";
    } else if (opcaoOng === "ong4") {
        imagemOng.src = "/Assets/img/Logo_SOS.jpeg";
        titleInformativo.textContent = " S.O.Sopão";
        textoInformativo.textContent = "O projeto S.O.Sopão atua de forma a suprir as primeiras necessidades das pessoas em situação de rua e seus cãezinhos.";
    } else if (opcaoOng === "ong5") {
        imagemOng.src = "/Assets/img/Logo_SM.jpeg";
        titleInformativo.textContent = "Instituto Se Mudando";
        textoInformativo.textContent = "O Instituto Se Mudando foi criado em 2018, com a finalidade de transformar a vida de pessoas em situação de rua.";
    } else if (opcaoOng === "ong6") {
        imagemOng.src = "/Assets/img/Logo_Helena.jpeg";
        titleInformativo.textContent = "Helena Dornfeld";
        textoInformativo.textContent = "O Asilo Helena Dornfeld atua no setor de acolhimento de pessoas idosas. Realizando os trabalhos de prestação de serviços à pessoa idosa, tem como objetivo acolher.";
    } else {
        // Defina uma imagem e texto padrão caso nenhuma opção de ONG seja selecionada
        imagemOng.src = "/Assets/img/Design_sem_nome-removebg-preview (1).png";
        textoInformativo.textContent = "Escolha a ONG que mais lhe agrada.";
    }
}

let slideIndex = 0;
showSlides();

function showSlides() {
    let slides = document.getElementsByClassName("slide");

    for (let i = 0; i < slides.length; i++) {
        slides[i].style.display = "none";
    }

    slideIndex++;

    if (slideIndex > slides.length) {
        slideIndex = 1;
    }

    slides[slideIndex - 1].style.display = "block";

    setTimeout(showSlides, 4000); // Altere aqui para ajustar o tempo de troca de imagem (6 segundos).
}

// Verificar se o usuário está logado
if (usuarioLogado) { // Substitua "usuarioLogado" pela sua verificação real
    var tipoUsuario = "doador"; // ou "ong", dependendo do tipo de usuário

    // Redirecionar para a página de perfil apropriada
    if (tipoUsuario === "doador") {
        window.location.href = "perfil_doador.php"; // Substitua pelo URL da página de perfil do doador
    } else if (tipoUsuario === "ong") {
        window.location.href = "perfil_ong.php"; // Substitua pelo URL da página de perfil da ONG
    }
}

/*

const openModalButton = document.getElementById('openModalButton');
const overlay = document.getElementById('overlay');
const modal = document.getElementById('modal');


document.addEventListener("DOMContentLoaded", function () {
    const etapa1 = document.getElementById('etapa1');
    const etapa2 = document.getElementById('etapa2');
    const etapa3 = document.getElementById('etapa3'); // nova seção de login
    const proximaEtapa1Button = document.getElementById('proximaEtapa1');
    const voltarEtapa2Button = document.getElementById('voltarEtapa2');
    const proximaEtapa2Button = document.getElementById('proximaEtapa2'); // botão para ir para a seção de login
    const voltarEtapa3Button = document.getElementById('voltarEtapa3'); // botão para voltar da seção de login

    proximaEtapa1Button.addEventListener('click', () => {
        etapa1.style.display = 'none';
        etapa2.style.display = 'block';
    });

    voltarEtapa2Button.addEventListener('click', () => {
        etapa1.style.display = 'block';
        etapa2.style.display = 'none';
    });

    proximaEtapa2Button.addEventListener('click', () => {
        etapa2.style.display = 'none';
        etapa3.style.display = 'block'; // exibir seção de login
    });

    voltarEtapa3Button.addEventListener('click', () => {
        etapa2.style.display = 'block'; // voltar para a seção de cadastro
        etapa3.style.display = 'none';
    });
}); */