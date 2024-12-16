// Variável para armazenar o texto atual sendo lido
let textoAtual = "";

// Adicionando integração para capturar gestos e texto selecionado no iOS
document.addEventListener('selectionchange', () => {
    if (leituraAtivada) {
        const selection = window.getSelection();
        const textoSelecionado = selection ? selection.toString().trim() : '';
        if (textoSelecionado && textoSelecionado !== textoAtual) {
            textoAtual = textoSelecionado; // Atualiza o texto atual
            lerTexto(textoSelecionado);
        }
    }
});

// Inicializando ao carregar a página
document.addEventListener('DOMContentLoaded', () => {
    // Restaurar estado inicial do menu e botões de acessibilidade
    const elements = document.querySelectorAll('p, h1, h2, h3, h4, h5, h6, span, a, div');
    elements.forEach((element, index) => {
        const fontSize = getComputedStyle(element).fontSize;
        initialFontSizes[index] = {
            element: element,
            fontSize: fontSize
        };
    });

    console.log("Tamanhos de fonte salvos:", initialFontSizes);
});

// Alternar exibição do menu de acessibilidade
document.getElementById('btn-acessibilidade').addEventListener('click', function () {
    const menu = document.getElementById('menu-acessibilidade');
    menu.style.display = (menu.style.display === 'none' || menu.style.display === '') ? 'block' : 'none';
    document.body.classList.toggle('menu-ativado');
});

// Função para alternar alto contraste
function toggleHighContrast() {
    document.body.classList.toggle('high-contrast');
    document.body.classList.remove('negative-contrast');
    synth.cancel();
}

// Função para alternar contraste negativo
function toggleNegativeContrast() {
    document.body.classList.toggle('negative-contrast');
    document.body.classList.remove('high-contrast');
    synth.cancel();
}

// Função para alternar tons de cinza
function toggleGrayScale() {
    document.body.classList.toggle('tons-cinza');
    synth.cancel();
}

// Função para sublinhar links
function toggleLinkSub() {
    document.body.classList.toggle('link-sub');
    synth.cancel();
}

// Função para alternar fonte legível
function toggleFontLeg() {
    document.body.classList.toggle('font-leg');
    synth.cancel();
}

// Função para aumentar o tamanho da fonte
function increaseFontSize() {
    const elements = document.querySelectorAll('p, h1, h2, h3, h4, h5, h6, span, a');
    elements.forEach(element => {
        const currentSize = parseFloat(getComputedStyle(element).fontSize);
        const newSize = currentSize * 1.1; // Aumenta 10%
        element.style.fontSize = `${newSize}px`;
    });
    synth.cancel();
}

// Função para diminuir o tamanho da fonte
function decreaseFontSize() {
    const elements = document.querySelectorAll('p, h1, h2, h3, h4, h5, h6, span, a');
    elements.forEach(element => {
        const currentSize = parseFloat(getComputedStyle(element).fontSize);
        const newSize = currentSize * 0.9; // Diminui 10%
        element.style.fontSize = `${newSize}px`;
    });
    synth.cancel();
}

// Função para restaurar configurações iniciais
function resetConfig() {
    document.body.classList.remove('font-leg', 'link-sub', 'tons-cinza', 'high-contrast', 'negative-contrast');

    // Restaurar tamanhos iniciais das fontes
    Object.values(initialFontSizes).forEach(item => {
        item.element.style.fontSize = item.fontSize;
    });

    document.documentElement.style.fontSize = '';

    // Desativar leitura, se ativa
    if (leituraAtivada) {
        leituraAtivada = false;
        synth.cancel();
        const botao = document.getElementById('btnAtivarLeitura');
        botao.innerHTML = `
            <i class="bi bi-soundwave"></i> 
            Leia a Página
        `;
        lerTexto("A leitura foi desativada.");
    }
}

// Ativar ou desativar a funcionalidade de leitura
document.getElementById('btnAtivarLeitura').addEventListener('click', () => {
    leituraAtivada = !leituraAtivada;
    synth.cancel();
    const botao = document.getElementById('btnAtivarLeitura');
    botao.innerHTML = `
        <i class="bi bi-soundwave"></i> 
        ${leituraAtivada ? "Desativar Leitura" : "Leia a página"}
    `;
    if (leituraAtivada) {
        lerTexto("A leitura foi ativada. Saia do menu de acessibilidade e selecione um texto para começar.");
    } else {
        lerTexto("A leitura foi desativada.");
    }
});

// Função para leitura do texto selecionado
function lerTexto(texto) {
    synth.cancel();
    const utterance = new SpeechSynthesisUtterance(texto);
    utterance.lang = 'pt-BR';
    synth.speak(utterance);
}

// Leitura ao soltar o mouse
document.addEventListener('mouseup', () => {
    if (leituraAtivada) {
        const textoSelecionado = window.getSelection().toString().trim();
        if (textoSelecionado && textoSelecionado !== textoAtual) {
            textoAtual = textoSelecionado; // Atualiza o texto atual
            lerTexto(textoSelecionado);
        }
    }
});

let leituraAtivada = false;
const synth = window.speechSynthesis;
const initialFontSizes = {};