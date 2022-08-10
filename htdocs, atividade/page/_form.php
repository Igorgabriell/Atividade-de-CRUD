<?php

/**
 * _form.php
 * Formulário do usuário:
 * 
 * IMPORTANTE!
 *      Este formulário é apenas experimental, um modelo que não tem seus dados
 *      validados ou sanitizados. Nunca use este formulário, da forma que está,
 *      em produção, ou seja, em um site real, hospedado na Internet.
 * 
 * Observações:
 *      • Este formulário serve tanto para cadastrar novos usuários e editar um
 *        usuário já existente.
 *      • A variável $user_form[], deve ser pré-definida antes de incluir este 
 *        script no código da página, para evitar erros. 
 *       • As chaves e valores de $user_form[] são:
 *          
 *          'action' → Destino do formulário → Exemplo: "/?p={$page}"
 *          'name' → 'value=' do campo 'name'
 *          'email' → 'value=' do campo 'email'
 *          'avatar' → 'value=' do campo 'avatar'
 *          'birth' → 'value=' do campo 'birth'
 *          'bio' → 'value=' do campo 'bio'
 *          'type' → 'value=' do campo 'type'
 *          'password' → se false, oculta o campo da senha
 * 
 **/

// Dados somente para teste unitário (comente após os testes):
/*
$user_form = array(
    'action' => htmlspecialchars($_SERVER['REQUEST_URI']),
    'name' => 'Joca Silva',
    'email' => 'joca@silva.com',
    'avatar' => 'https://randomuser.me/api/portraits/men/40.jpg',
    'birth' => '2000-10-08',
    'bio' => 'Programador, organizador, pintor e ordenhador.',
    'type' => 'user',
    'password' => true
);
*/

/**
 * Monta lista de opções de 'name="type"', selecionando a opção correta 
 * conforme o valor de $user_form['type']:
 **/

// Cria array com as opções possíveis, conforme campo 'type' do banco de dados:
$options = array(
    'user'      => 'Usuário',
    'author'    => 'Autor',
    'moderator' => 'Moderador',
    'admin'     => 'Administrador'
);

// Inicializa a variável com a lista de opções:
$type_options = "\n";

// Loop entre as opções possíveis:
foreach ($options as $key => $value) :

    // Se a opção atual for a selecionada...
    if ($key == trim(strtolower($user_form['type'])))

        // Adiciona a opção com o atributo 'selected':
        $type_options .= "<option value=\"{$key}\" selected>{$value}</option>\n";

    // Se não...
    else

        // Adiciona a opção sem o atributo 'selected':
        $type_options .= "<option value=\"{$key}\">{$value}</option>\n";

endforeach;

// Inicializa o campo de senha:
$form_password = '';

// Se solicitou o campo da senha ($user_form['password'] = true)...
if ($user_form['password']) :

    // Formada o campo da senha:
    $form_password = <<<HTML

<div class="separator"></div>

<p>
    <label for="password">Senha temporária:</label>
    <span class="password">
        <input type="password" name="password" id="password" value="">
        <button type="button" id="toglePass"><i class="fa-solid fa-eye fa-fw"></i></button>
    </span>
</p>

HTML;

endif;

// Template do formulário:
$form = <<<HTML

<form action="{$user_form['action']}" method="post" class="user-form">

    <p>
        <label for="name">Nome:</label>
        <input type="text" name="name" id="name" value="{$user_form['name']}">
    </p>

    <p>
        <label for="email">E-mail:</label>
        <input type="email" name="email" id="email" value="{$user_form['email']}">
    </p>

    <p>
        <label for="avatar">URL do Avatar:</label>
        <input type="url" name="avatar" id="avatar" value="{$user_form['avatar']}">
    </p>

    <p>
        <label for="birth">Data de Nascimento:</label>
        <input type="date" name="birth" id="birth" value="{$user_form['birth']}">
    </p>

    <p>
        <label for="bio">Resumo:</label>
        <textarea name="bio" id="bio">{$user_form['bio']}</textarea>
    </p>

    {$form_password}

    <div class="separator"></div>

    <p>
        <label for="type">Tipo:</label>
        <select name="type" id="type">
            {$type_options}
        </select>
    </p>

    <div class="separator"></div>

    <p>
        <button type="submit">Salvar</button>
    </p>

</form>

HTML;

// Teste (comente após os testes):
// print_r($form);
