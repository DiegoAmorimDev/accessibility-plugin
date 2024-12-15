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

function plugin_acessibilidade_scripts() {
    // Versão dinâmica baseada na última modificação do arquivo (para evitar cache)
    $version_css = filemtime(plugin_dir_path(__FILE__) . 'css/estilo.css');
    $version_js = filemtime(plugin_dir_path(__FILE__) . 'js/script.js');

    // Inclui CSS com query string
    wp_enqueue_style('plugin-acessibilidade-style', plugins_url('css/estilo.css', __FILE__), array(), $version_css);

    // Inclui JS com query string
    wp_enqueue_script('plugin-acessibilidade-script', plugins_url('js/script.js', __FILE__), array('jquery'), $version_js, true);
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
            <div class="botao-menu" id="botao-menu">
                <i class="bi bi-universal-access-circle"></i>
            </div>
            <div class="botao-sair">
                <i class="bi bi-box-arrow-left" id="button-exit"></i>
            </div>
        </div>
    </button>

    <div class="block">
        <div id="menu-acessibilidade" class="menu-acessibilidade" style="display: none;">
            <div class="flex">
                    <p class="title-menu">Uepa Acessível</p>
            </div>
            <div class="bloco-opcoes">
                <div class="bloco-funcoes">
                    <div class="funcoes-box" id="funcoes-box">
                        <button onclick="toggleHighContrast()"> <i class="bi bi-circle-half"></i> Alto Contraste</button>
                    </div>
                    <div class="funcoes-box">
                        <button onclick="toggleNegativeContrast()" id="negative-contrast"> <i class="bi bi-eye-fill"></i> Contraste Negativo</button>
                    </div>
                </div>
                <div class="bloco-funcoes">
                    <div class="funcoes-box">
                        <button onclick="increaseFontSize()" id="increase-font"> <i class="bi bi-zoom-in"></i> Aumentar Fonte </button>
                    </div>
                    <div class="funcoes-box">
                        <button onclick="decreaseFontSize()" id="decrease-font"> <i class="bi bi-zoom-out"></i> Diminuir Fonte</button>
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
            </div>

            <div class="flex">
                <button class="redefinir-button" onclick="resetConfig()"><i class="bi bi-arrow-clockwise"></i>REDEFINIR CONFIGURAÇÕES</button>
            </div>

            <div class="report-messages">
            <a href="https://mail.google.com/mail/?view=cm&fs=1&to=suporte@uepa.br&su=Relatar%20um%20Problema&body=Descreva%20seu%20problema%20aqui,%20nossa%20equipe%20fará%20o%20possível%20para%20lhe%20ajudar." target="_blank">Reportar um problema</a>
            </div>

            <div class="flex">
                <a href="https://dspd.uepa.br/" target="_blank"><img id="LOGO-DSPD" src="wp-content/plugins/uepa-acessivel-wp - Copia/img/DSPD-LOGO.png" alt="LOGO-DSPD"></a>
            </div>

        
        </div>
    </div>
    <?php
}
add_action('wp_footer', 'exibir_plugin_acessibilidade');

