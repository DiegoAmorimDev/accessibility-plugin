<?php
/**
 * Plugin Name: UEPA acessível
 * Description: Transformando a UEPA em um espaço inclusivo para todos!.
 * Version: 1.0 BETA
 * Author: <a href="https://dspd.uepa.br" target="_blank">DSPD - UEPA</a>
 */

// Evita o acesso direto ao arquivo
if (!defined('ABSPATH')) {
    exit;
}

// Função para incluir os arquivos CSS e JS
function plugin_acessibilidade_scripts() {
    // Inclui CSS
    wp_enqueue_style('plugin-acessibilidade-style', plugins_url('css/estilo.css', __FILE__));

    // Inclui JS
    wp_enqueue_script('plugin-acessibilidade-script', plugins_url('js/script.js', __FILE__), array('jquery'), null, true);
}
add_action('wp_enqueue_scripts', 'plugin_acessibilidade_scripts');

function plugin_acessibilidade_carregar_bootstrap() {
    // CSS do Bootstrap
    wp_enqueue_style('bootstrap-css', 'https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css');

    // Opcional: Se precisar de todo o framework Bootstrap (não apenas os ícones)
    wp_enqueue_style('bootstrap-framework-css', 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css');
    wp_enqueue_script('bootstrap-js', 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js', array('jquery'), null, true);
}
add_action('wp_enqueue_scripts', 'plugin_acessibilidade_carregar_bootstrap');


// Função para exibir o plugin em todas as páginas
function exibir_plugin_acessibilidade() {
    ?>
    <button id="btn-acessibilidade" class="btn-acessibilidade">
        <div class="btnAccess" id="btnAccess">
            <div class="messageBoxAccess" id="messageBoxAccess">
                <p>Olá, eu sou o menu da uepa acessível. <br> Eu tenho muitos recursos assistivos, caso precise de mim, estarei aqui!</p>
            </div>
            <i class="bi bi-universal-access-circle"></i>
            <i class="bi bi-box-arrow-left" id="button-exit"></i>
        </div>
    </button>

    <div class="block">
        <div id="menu-acessibilidade" class="menu-acessibilidade" style="display: none;">
            <div class="flex">
                <p>Uepa Acessível</p>
            </div>
            <div class="bloco-funcoes">
                <div class="funcoes-box">
                    <button onclick="toggleHighContrast()"> <i class="bi bi-circle-half"></i> Alto Contraste</button>
                </div>
                <div class="funcoes-box">
                    <button onclick="toggleNegativeContrast()"> <i class="bi bi-eye-fill"></i> Contraste Negativo</button>
                </div>
            </div>

            <div class="bloco-funcoes">
                <div class="funcoes-box">
                    <button onclick="increaseFontSize()"> <i class="bi bi-zoom-in"></i> Aumentar Fonte </button>
                </div>
                <div class="funcoes-box">
                    <button onclick="decreaseFontSize()"> <i class="bi bi-zoom-out"></i> Diminuir Fonte</button>
                </div>
            </div>

            <div class="bloco-funcoes">
                <div class="funcoes-box">
                    <button id="toggleGrayButton" onclick="toggleGrayScale()"> <i id="GrayScale" class="bi bi-upc"></i> Escala de cinza</button>
                </div>
                <div class="funcoes-box">
                    <button onclick="toggleLinkSub()"> <i class="bi bi-link"></i> Links Sublinhados</button>
                </div>
            </div>

            <div class="bloco-funcoes">
                <div class="funcoes-box">
                    <button onclick="toggleFontLeg()"> <i class="bi bi-file-font"></i> Fonte Legível</button>
                </div>
                <div class="funcoes-box">
                    <button id="btnAtivarLeitura"> <i class="bi bi-soundwave"></i> Leia a página</button>
                </div>
            </div>
            <div class="messageBoxFinal" id="messageBoxFinal">
                <p>Desenvolvido por <a href="https://dspd.uepa.br/" target="_blank">DSPD - UEPA</a></p>
            </div>
        </div>
    </div>
    <?php
}
add_action('wp_footer', 'exibir_plugin_acessibilidade');

