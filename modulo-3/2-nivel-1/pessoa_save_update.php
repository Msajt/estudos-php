<?php
$dados = $_POST;

if ($dados['id']) {
    $conn = pg_connect('host=localhost port=5432 dbname=livro user=postgres password=mynewpassword');

    $sql = "UPDATE pessoa SET nome='{$dados['nome']}',
                              endereco='{$dados['endereco']}',
                              bairro='{$dados['bairro']}',
                              telefone='{$dados['telefone']}',
                              email='{$dados['email']}',
                              id_cidade='{$dados['id_cidade']}'
                          WHERE id = '{$dados['id']}'";
    // print '<pre>';
    // print_r($dados);
    // print $sql;
    $result = pg_query($conn, $sql);
    if ($result)
        print "Registro atualizado";
    else
        print preg_last_error($conn);

    pg_close($conn);
}