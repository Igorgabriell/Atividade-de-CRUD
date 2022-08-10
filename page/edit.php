<?php

/**
 * edit.php
 * Página 'Editar' carregada pelo link '/?p=edit'.
 **/

// Inicializa a variáveis:
$page_title = 'Editar perfil';
$page_content = "<h2>Editar usuário</h2>";
$id = 0;

// Obtém o id da URL:
if (isset($_GET['u'])) $id = intval($_GET['u']);

// Se o id é inválido, redireciona para ERRO 404:
if ($id == 0) header('Location: /?p=e404');

// Obtém os dados do usuário do banco de dados:
$sql = <<<SQL

SELECT 
    *,
    DATE_FORMAT(date, '%d/%m/%Y às %H:%i:%s') AS date_br,
    DATE_FORMAT(birth, '%d/%m/%Y') AS birth_br
FROM users 
WHERE 
    id = '{$id}' 
    AND status != 'deleted'

SQL;

// debug($sql);
$res = $conn->query($sql);

// Se não obteve os dados, mostra erro 404:
if ($res->num_rows != 1) header('Location: /?p=e404');

// Obtém os dados do usuário para $user[]:
$user = $res->fetch_assoc();

// debug($user, true, false);

// Inicializa o formulário:
$user_form = array(
    'action' => $_SERVER['REQUEST_URI'],
    'name' => $user['name'],
    'email' => $user['email'],
    'avatar' => $user['avatar'],
    'birth' => $user['birth'],
    'bio' => $user['bio'],
    'type' => $user['type'],
    'password' => false // Oculta o campo de senha na edição.
);

// inclui o formulário:
require('page/_form.php');

// Se o formulário foi submetido...
if ($_SERVER["REQUEST_METHOD"] == "POST") :

    // Monta query de atualização:
    $sql = <<<SQL

UPDATE users SET
    name = '{$_POST['name']}',
    email = '{$_POST['email']}',
    avatar = '{$_POST['avatar']}',
    birth = '{$_POST['birth']}',
    bio = '{$_POST['bio']}',
    type = '{$_POST['type']}'
WHERE id = '{$id}'
    AND status != 'deleted';

SQL;

    // debug($sql);

    // Executa query de atualização:
    $conn->query($sql);

    // Gera feedback:
    $page_content .= <<<HTML

<p>Dados do usuário salvos com sucesso!</p>
<p class="center">
    <a href="/?p=view&u={$id}">Ver perfil</a> &nbsp;|&nbsp;
    <a href="/">Listar usuários</a>
</p>

HTML;

else :

    $page_content .= <<<HTML

<p>Preencha todos os campos com atenção.</p>
{$form}


HTML;

endif;
