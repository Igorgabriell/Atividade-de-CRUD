<?php

/**
 * new.php
 * Página 'Cadastro' carregada pelo link '/?p=status'.
 * 
 * Observações:
 * 
 *      Esta página não tem conteúdo visível. Ela apenas altera o status atual
 *      do usuário e retorna para o perfil deste.
 **/

// Inicializa a variáveis:
$id = 0;

// Obtém o id da URL:
if (isset($_GET['u'])) $id = intval($_GET['u']);

// Se o id é inválido, redireciona para ERRO 404:
if ($id == 0) header('Location: /?p=e404');

// Obtém a ação da URL e, em caso de falha, força o status para ativo:
if (isset($_GET['a'])) $status = intval($_GET['a']);
if ($status != 0) $a = 'active';
else $status = 'inactive';

// Obtém os dados do usuário do banco de dados:
$sql = "SELECT id FROM users WHERE id = '{$id}' AND status != 'deleted'";
// debug($sql);
$res = $conn->query($sql);

// Se não obteve os dados, mostra erro 404:
if ($res->num_rows != 1) header('Location: /?p=e404');

// Atualiza status:
$sql = "UPDATE users SET status = '{$status}' WHERE id = '{$id}' AND status != 'deleted'";
// debug($sql);
$conn->query($sql);

// Retorna para o perfil do usuário:
header ("Location: /?p=view&u={$id}");
