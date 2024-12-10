// Adicionando integração para capturar gestos e texto selecionado no iOS
document.addEventListener('selectionchange', () => {
    if (leituraAtivada) {
        const selection = window.getSelection();
        const textoSelecionado = selection ? selection.toString().trim() : '';
        if (textoSelecionado) {
            lerTexto(textoSelecionado);
        }
    }
});

document.addEventListener('DOMContentLoaded', () => {
    // Seleciona os botões
    const increaseFontButton = document.getElementById('increase-font');
    const decreaseFontButton = document.getElementById('decrease-font');
    const toggleContrastButton = document.getElementById('toggle-contrast');
    const toggleNContrastButton = document.getElementById('toggle-Ncontrast');
    const toggleLinkSubButton = document.getElementById('toggle-Link');
    const toggleFontLegButton = document.getElementById('font-legi');
    const toggleGrayScale = document.getElementById('toggleGrayButton');

    // Define o tamanho de fonte padrão
    let fontSize = 100; // Percentual base (100% = 16px)
    const minFontSize = 75; // Limite mínimo (75% = 12px)
    const maxFontSize = 150; // Limite máximo (150% = 24px)

    // Aumentar fonte
    increaseFontButton.addEventListener('click', () => {
        if (fontSize < maxFontSize) {
            fontSize += 10;
            document.documentElement.style.fontSize = `${fontSize}%`;
        }
    });

    // Diminuir fonte
    decreaseFontButton.addEventListener('click', () => {
        if (fontSize > minFontSize) {
            fontSize -= 10;
            document.documentElement.style.fontSize = `${fontSize}%`;
        }
    });

    // Alternar contraste
    toggleContrastButton.addEventListener('click', () => {
        document.body.classList.toggle('high-contrast');
    });

    toggleLinkSubButton.addEventListener('click', () => {
        document.body.classList.toggle('link-sub');
    });

    toggleNContrastButton.addEventListener('click', () => {
        document.body.classList.toggle('toggle-NegativeContrast');
    });

    toggleFontLegButton.addEventListener('click', () => {
        document.body.classList.toggle('font-leg');
    });

    // Tons de cinza
    toggleGrayScale.addEventListener('click', () => {
        document.body.classList.toggle('tons-cinza');
    });
});

document.getElementById('btn-acessibilidade').addEventListener('click', function () {
    const menu = document.getElementById('menu-acessibilidade');
    const messageDisappear = document.getElementById('messageBoxAccess');
    menu.style.display = (menu.style.display === 'none' || menu.style.display === '') ? 'block' : 'none';
    messageDisappear.style.display = (messageDisappear.style.display === 'none' || menu.style.display === '') ? 'none' : 'none';
    document.body.classList.toggle('menu-ativado');
    
});

function toggleHighContrast() {
    document.body.classList.toggle('high-contrast');
    synth.cancel();
}

function toggleNegativeContrast() {
    document.body.classList.toggle('negative-contrast');
    synth.cancel();
}

function increaseFontSize() {
    const currentSize = parseFloat(getComputedStyle(document.body).fontSize);
    document.documentElement.style.fontSize = (currentSize * 1.1) + 'px';
    synth.cancel();
}

function decreaseFontSize() {
    const currentSize = parseFloat(getComputedStyle(document.body).fontSize);
    document.documentElement.style.fontSize = (currentSize * 0.9) + 'px';
    synth.cancel();
}

function toggleGrayScale() {
    document.body.classList.toggle('tons-cinza');
    synth.cancel();
}

function toggleLinkSub() {
    document.body.classList.toggle('link-sub');
    synth.cancel();
}

function toggleFontLeg() {
    document.body.classList.toggle('font-leg');
    synth.cancel();
}

const synth = window.speechSynthesis;

let leituraAtivada = false;

function lerTexto(texto) {
    synth.cancel();
    const utterance = new SpeechSynthesisUtterance(texto);
    utterance.lang = 'pt-BR';
    synth.speak(utterance);
}

document.getElementById('btnAtivarLeitura').addEventListener('click', () => {
    document.body.classList.toggle("botao-ativado");
    leituraAtivada = !leituraAtivada;
    synth.cancel();
    const botao = document.getElementById('btnAtivarLeitura');
    botao.innerHTML = `
        <i class="bi bi-soundwave"></i> 
        ${leituraAtivada ? "Desativar Leitura" : "Ativar Leitura"}
    `;
    if (leituraAtivada) {
        lerTexto("A leitura foi ativada. Feche o menu de acessibilidade e selecione um texto para começar.");
    } else {
        lerTexto("A leitura foi desativada.");
    }
});

document.addEventListener('mouseup', () => {
    if (leituraAtivada) {
        const textoSelecionado = window.getSelection().toString().trim();
        if (textoSelecionado) {
            lerTexto(textoSelecionado);
        }
    }
});