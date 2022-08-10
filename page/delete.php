<?php

/**
 * delete.php
 * Página 'Apagar' carregada pelo link '/?p=delete'.
 **/

// Inicializa variáveis:
$page_title = 'Apagar usuário';
$page_content = '<h2>Apagar perfil</h2>';
$id = 0;

// Obtém o id da URL:
if (isset($_GET['u'])) $id = intval($_GET['u']);

// Se o id é inválido, redireciona para ERRO 404:
if ($id == 0) header('Location: /?p=e404');

// Obtém os dados do usuário do banco de dados:
$sql = "SELECT id, name FROM users WHERE id = '{$id}' AND status != 'deleted'";
// debug($sql);
$res = $conn->query($sql);

// Se não obteve os dados, mostra erro 404:
if ($res->num_rows != 1) header('Location: /?p=e404');

// Obtém os dados do usuário para $user[]:
$user = $res->fetch_assoc();

// Se o formulário foi submetido, confirmando a exclusão...
if ($_SERVER["REQUEST_METHOD"] == "POST") :

    // Query para "apagar" usuário:
    $sql = "UPDATE users SET status = 'deleted' WHERE id = '{$id}'";
    $conn->query($sql);

    // Gera mensagem de feedback:
    $page_content .= <<<HTML

    <div class="form-delete">
        <p>Usuário apagado com sucesso!</p>
        <p class="user-tools"><a href="/">Listar usuários</a></p>
    </div>

HTML;

// Se o formulário NÃO foi submetido ainda...
else :

    // Gera mensagem para confirmação da ação:
    $page_content .= <<<HTML

<form method="post" action="{$_SERVER['REQUEST_URI']}" class="form-delete">

    <p>Tem certeza que deseja apagar o perfil de "{$user['name']}"?</p>
    <blockquote><em>Esta ação não pode ser desfeita!</em></blockquote>
    <div class="buttons">
        <button type="button" onclick="location.href='/'">Não, voltar para a listagem</button>
        <button type="submit">Sim, pode apagar!</button>        
    </div>

</form>

HTML;

endif;
