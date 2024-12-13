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
    const increaseFontButton = document.getElementById('increase-font');
    const decreaseFontButton = document.getElementById('decrease-font');
    

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
    const elements = document.querySelectorAll('p, h1, h2, h3, h4, h5, h6, span, a, div');
    
    elements.forEach(element => {
        const currentSize = parseFloat(getComputedStyle(element).fontSize);
        const newSize = currentSize * 1.1; // Aumenta 10%
        element.style.fontSize = `${newSize}px`;
    });

    synth.cancel();
}

function decreaseFontSize() {
    const elements = document.querySelectorAll('p:not(.title-menu), h1, h2, h3, h4, h5, h6, span, a, div');
    
    elements.forEach(element => {
        const currentSize = parseFloat(getComputedStyle(element).fontSize);
        const newSize = currentSize * 0.9; // Diminui 10%
        element.style.fontSize = `${newSize}px`;
    });

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

let leituraAtivada = false;

const synth = window.speechSynthesis;



function lerTexto(texto) {
    synth.cancel();
    const utterance = new SpeechSynthesisUtterance(texto);
    utterance.lang = 'pt-BR';
    synth.speak(utterance);
}

function resetConfig() {
    document.body.classList.remove('font-leg', 'link-sub', 'tons-cinza', 'high-contrast', 'negative-contrast');

    const elements = document.querySelectorAll('p, h1, h2, h3, h4, h5, h6, span, a, div');
    
    elements.forEach(element => {
        const currentSize = parseFloat(getComputedStyle(element).fontSize);
        const newSize = currentSize * 1.1; // Aumenta 10%
        element.style.fontSize = `20px`;
    });
    
    if (leituraAtivada) {
        leituraAtivada = !leituraAtivada;
        synth.cancel();
        const botao = document.getElementById('btnAtivarLeitura');
        botao.innerHTML = `
            <i class="bi bi-soundwave"></i> 
            ${leituraAtivada ? "Desativar Leitura" : "Ativar Leitura"}
        `;
        
            lerTexto("A leitura foi desativada");
    } 
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