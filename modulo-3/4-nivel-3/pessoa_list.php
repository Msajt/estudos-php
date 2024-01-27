<?php
//! Programa para listagem dos usuários cadastrados
//? Conexão ao banco de dados
$conn = pg_connect('host=localhost 
                                port=5432 
                                dbname=livro 
                                user=postgres 
                                password=mynewpassword'
);

//* Caso seja a ação de 'delete'
if (!empty($_GET['action']) && ($_GET['action'] == 'delete')) {
    $id = (int) $_GET['id'];
    pg_query($conn, "DELETE FROM pessoa WHERE id='{$id}'");
}

//? Consulta dos dados da tabela 'pessoa'
$result = pg_query($conn, 'SELECT * FROM pessoa ORDER BY id');

$items = '';
//? Inserindo dados encontrados em uma variável
while ($row = pg_fetch_array($result)) {
    $item = file_get_contents('./html/items.html');
    $item = str_replace('{id}', $row['id'], $item);
    $item = str_replace('{nome}', $row['nome'], $item);
    $item = str_replace('{endereco}', $row['endereco'], $item);
    $item = str_replace('{bairro}', $row['bairro'], $item);
    $item = str_replace('{telefone}', $row['telefone'], $item);
    $item = str_replace('{email}', $row['email'], $item);

    $items .= $item;
}

$list = file_get_contents('./html/list.html');
$list = str_replace('{items}', $items, $list);

print $list;
?>