<?php

/**
 * _config.php
 * 
 * Configuração inicial do aplicativo e funções de uso global.
 */

// Setup inicial do aplicativo:
header('Content-Type: text/html; charset=utf-8');   // Tudo em UTF-8.
date_default_timezone_set('America/Sao_Paulo');     // Ajusta fuso horário.

// Inicializa variáveis importantes:
$page_title = '&#128509;';   // Título das páginas → <title>...</title>
$page_content = '&#128509;'; // Inicializa a página sem conteúdo.

/********************************
 * Conexão com MySQL "do XAMPP" *
 ********************************/

// Tentando... 
try {
    // ... se conectar ao banco de dados...
    if (!$conn = new mysqli('localhost', 'root', '', 'application'))

        // Ocorreu uma falha:
        throw new Exception('Falha de conexão');

    // Tratando a falha...
} catch (Exception $e) {

    // Exibe mensagem de erro e encerra o aplicativo:        
    die('Oooops! Falha na conexão com o banco de dados.<br>A falha obtida foi: ' . $e->getMessage());
}

// Setup inicial do MySQL:
$conn->query("SET NAMES utf8");
$conn->query('SET character_set_connection=utf8');
$conn->query('SET character_set_client=utf8');
$conn->query('SET character_set_results=utf8');
$conn->query('SET GLOBAL lc_time_names = pt_BR');
$conn->query('SET lc_time_names = pt_BR');

/*************************
 * Funções de uso geral. *
 *************************/

// Calcula idade:
function get_age($birthdate)
{
    // inicializa variável com a idade:
    $age = 0;

    // Formata a data corretamente, se necessário:
    $birth_date = date('Y-m-d', strtotime($birthdate));

    // Obtém as partes da data:
    list($byear, $bmonth, $bday) = explode('-', $birth_date);

    // Calcula a idade pelo ano:
    $age = date("Y") - $byear;

    // Ajusta a idade pelo mês:
    if (date("m") < $bmonth) $age -= 1;

    // Ajusta a idade pelo dia:
    elseif ((date("m") == $bmonth) && (date("d") <= $bday)) $age -= 1;

    // Retorna a idade:
    return $age;
}

// Facilita o debug (Isso não é usado em produção):
function debug($element, $pre = true, $stop = true)
{
    if ($pre) echo '<pre>';
    print_r($element);
    if ($pre) echo '</pre>';
    if ($stop) exit;
}
