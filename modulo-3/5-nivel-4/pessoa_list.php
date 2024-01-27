<?php
//! Programa para listagem dos usuários cadastrados
//? Conexão ao banco de dados
require_once('./db/pessoa_db.php');

//* Caso seja a ação de 'delete'
if (!empty($_GET['action']) && ($_GET['action'] == 'delete')) {
    $id = (int) $_GET['id'];
    exclui_pessoa($id);
}

//? Consulta dos dados da tabela 'pessoa'
$pessoas = lista_pessoas();

//? Inserindo dados encontrados em uma variável
$items = '';
if ($pessoas) {
    foreach ($pessoas as $pessoa) {
        $item = file_get_contents('./html/items.html');
        $item = str_replace('{id}', $pessoa['id'], $item);
        $item = str_replace('{nome}', $pessoa['nome'], $item);
        $item = str_replace('{endereco}', $pessoa['endereco'], $item);
        $item = str_replace('{bairro}', $pessoa['bairro'], $item);
        $item = str_replace('{telefone}', $pessoa['telefone'], $item);
        $item = str_replace('{email}', $pessoa['email'], $item);

        $items .= $item;
    }
}

$list = file_get_contents('./html/list.html');
$list = str_replace('{items}', $items, $list);

print $list;