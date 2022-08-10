<?php

// Carrega setup inicial do aplicativo:
require('config/_config.php');

// Se tem o link da página na URL, por exemplo → /?p=pagename...
if (isset($_GET['p']))

    // Filtra o link e armazena em $page:
    $page = htmlspecialchars(trim(strtolower($_GET['p'])));

// Se não...
else

    // Aponta $page para a página inicial:
    $page = 'home';

// Se a página que está tentando acessar não existe...
if (!file_exists('page/' . $page . '.php'))

    // Mostra página de erro 404:
    $page = 'e404';

// Executa a página solicitada:
require('page/' . $page . '.php');

/**
 * Gera link das folhas de estilo e arquivo com JavaScript da página:
 * 
 * Observações:
 * 
 *      • Cada página pode ter sua própria folha de estilos, assim, ao carregar
 *        a página "page/contatos.php", a folha de estilos "css/contatos.css" 
 *        também será carregada, mas somente se ela existir.
 * 
 *      • Cada página pode ter seus próprios JavaScripts, assim, ao carregar a 
 *        página "page/contatos.php", o JavaScript "js/contatos.js" também será
 *        carregado, mas somente se ele existir.
 **/

// Se o CSS desta página existe...
if (file_exists('css/' . $page . '.css'))

    // Formata a tag CSS da página:
    $page_css = '<link rel="stylesheet" href="css/' . $page . '.css">';

// Se não...
else

    // Não carrega CSS da página:
    $page_css = '';

// Se o JavaScript desta página existe...
if (file_exists('js/' . $page . '.js'))

    // Formata tag Script da página:
    $page_js = '<script src="js/' . $page . '.js"></script>';

// Se não...
else

    // Não carrega JavaScript da página:
    $page_js = '';

// Formata tag <title>...</title>:
if ($page_title != '') $page_title .= ' ~ CRUD Usuário';
else $page_title = 'CRUD Usuário';

// Carrega template HTML do aplicativo:
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">

    <?php
    // Carrega o CSS desta página, caso exista.
    echo $page_css;
    ?>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css">
    <link rel="icon" href="./&#128509;">
    <title><?php echo $page_title ?></title>
</head>

<body>

    <div class="wrap">

        <header>
            <h1>
                <a href="/">	&#128509;</a>
                Express Tech
            </h1>
        </header>

        <nav>
            <a href="/">Listagem</a>
            <a href="/?p=new">Cadastro</a>
        </nav>

        <main>
            <?php
            // Exibe o conteúdo da página que deve ser armazenado em $page_content:
            echo $page_content;
            ?>
        </main>

        <footer>&copy; 2022 Igor Gabriel</footer>

    </div>

    <script src="js/script.js"></script>

    <?php
    // Carrega o JavaScript desta página caso exista. 
    echo $page_js;
    ?>

</body>

</html>