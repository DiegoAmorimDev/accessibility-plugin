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
    
    $version_css = filemtime(plugin_dir_path(__FILE__) . 'css/estilo.css');
    $version_js = filemtime(plugin_dir_path(__FILE__) . 'js/script.js');

  
    wp_enqueue_style('plugin-acessibilidade-style', plugins_url('css/estilo.css', __FILE__), array(), $version_css);

   
    wp_enqueue_script('plugin-acessibilidade-script', plugins_url('js/script.js', __FILE__), array('jquery'), $version_js, true);
}
add_action('wp_enqueue_scripts', 'plugin_acessibilidade_scripts');


function plugin_acessibilidade_carregar_bootstrap() {
    
    wp_enqueue_style('bootstrap-css', 'https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css');

    
    wp_enqueue_style('bootstrap-framework-css', 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css');
    wp_enqueue_script('bootstrap-js', 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js', array('jquery'), null, true);
}
add_action('wp_enqueue_scripts', 'plugin_acessibilidade_carregar_bootstrap');


// Remover a linha que adiciona o botão no rodapé
// add_action('wp_footer', 'exibir_plugin_acessibilidade');

// Usar wp_body_open para adicionar o botão corretamente em todas as páginas
// Remover a linha que adiciona o botão no rodapé
// add_action('wp_footer', 'exibir_plugin_acessibilidade');

// Usar wp_body_open para adicionar o botão corretamente em todas as páginas
function exibir_plugin_acessibilidade_no_body() {
    ?>
    
        <div class="btnAccess" id="btnAccess">
            <div class="botao-menu" id="botao-menu">
            <button id="btn-acessibilidade" class="btn-acessibilidade"> <i class="bi bi-universal-access-circle"></i> </button>
            </div>
            <div class="botao-sair">
               <button id="button-left"> <i class="bi bi-box-arrow-left" id="button-exit"></i> </button> 
            </div>
        </div>
    

    <div class="block">
        <div id="menu-acessibilidade" class="menu-acessibilidade" style="display: none;">
            <div class="flex">
                <p class="title-menu">UEPA Acessível</p>
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
add_action('wp_body_open', 'exibir_plugin_acessibilidade_no_body');


