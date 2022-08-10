<?php

/**
 * view.php
 * Página 'Perfil' carregada pelo link '/?p=view'.
 **/

// Inicializa a variáveis:
$page_title = 'Perfil';
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

// Obtém o primeiro e último nome do usuário:
$parts = explode(' ', $user['name']);
$user['viewname'] = $parts[0] . ' ' . $parts[count($parts) - 1];

// Calcula data de nascimento:
$user['age'] = get_age($user['birth']);

// Processa status do susuário:
if ($user['status'] == 'active') {
    $user_status = '<span class="active">ATIVO</span> [<a href="/?p=status&u=' . $id . '&a=0">Desativar</a>]';
} else {
    $user_status = '<span class="inactive">INATIVO</span> [<a href="/?p=status&u=' . $id . '&a=1">Ativar</a>]';
}

// Processa tipo de usuário:
switch ($user['type']) {
    case 'author':
        $user_type = "Autor";
        break;
    case 'moderator':
        $user_type = "Moderador";
        break;
    case 'admin':
        $user_type = "Administrador";
        break;
    default:
        $user_type = "Usuário";
}

// Sanitiza e formata campo 'bio':
$user_bio = nl2br(htmlspecialchars($user['bio']));

$page_content = <<<HTML

<div class="user-box">

    <div class="user-image"><img src="{$user['avatar']}" alt="{$user['name']}"></div>
    <div class="user-data">
        <h3>{$user['viewname']}</h3>
        <p>{$user_bio}</p>
        <ul>
            <li><strong>Nome:</strong> {$user['name']}</li>
            <li><strong>E-mail:</strong> {$user['email']} [<a href="mailto:{$user['email']}" target="_blank" title="Enviar e-mail para {$user['name']}">&rarr;&#9993;</a>]</li>
            <li><strong>Nascimento:</strong> {$user['birth_br']} - {$user['age']} anos</li>
        </ul>
        <hr>
        <ul>
            <li><strong>ID:</strong> {$user['id']}</li>
            <li><strong>Data:</strong> {$user['date_br']}</li>
            <li><strong>Tipo de usuário:</strong> {$user_type}</li>
            <li><strong>Status:</strong> {$user_status}</li>
        </ul>
    </div>
    <div class="user-tools">
        <a href="/?p=edit&u={$id}">Editar</a>
        <a href="/?p=delete&u={$id}">Apagar</a>
    </div>

</div>

HTML;
