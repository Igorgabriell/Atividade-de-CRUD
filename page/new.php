<?php

/**
 * new.php
 * Página 'Cadastro' carregada pelo link '/?p=new'.
 **/

// Inicializa variáveis:
$page_title = 'Cadastro';
$page_content = "<h2>Cadastro de novo usuário</h2>";

// Inicializa o formulário:
$user_form = array(
    'action' => $_SERVER['REQUEST_URI'],
    'name' => '',
    'email' => '',
    'avatar' => '',
    'birth' => '',
    'bio' => '',
    'type' => '',
    'password' => true
);

// inclui o formulário:
require('page/_form.php');

// Se o formulário foi submetido...
if ($_SERVER["REQUEST_METHOD"] == "POST") :

    // Monta query de inserção:
    $sql = <<<SQL

INSERT INTO users (name, email, password, avatar, birth, bio, type)
VALUES (
    '{$_POST['name']}',
    '{$_POST['email']}',
    SHA1('{$_POST['password']}'),
    '{$_POST['avatar']}',
    '{$_POST['birth']}',
    '{$_POST['bio']}',
    '{$_POST['type']}'
);

SQL;

    // Executa query de inserção:
    $conn->query($sql);

    // Gera feedback:
    $page_content .= <<<HTML

<p>Novo usuário cadastrado com sucesso!</p>
<p class="center">
    <a href="/?p=signup">Cadastrar novo</a> &nbsp;|&nbsp;
    <a href="/">Listar usuários</a>
</p>

HTML;

else :

    $page_content .= <<<HTML

<p>Preencha todos os campos com atenção.</p>
{$form}


HTML;

endif;
