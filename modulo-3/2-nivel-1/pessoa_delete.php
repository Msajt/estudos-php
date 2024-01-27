<?php
$dados = $_GET;

if ($dados['id']) {
    $conn = pg_connect('host=localhost port=5432 dbname=livro user=postgres password=mynewpassword');

    $id = (int) $dados['id'];

    $sql = "DELETE FROM pessoa WHERE id='{$id}'";
    // print '<pre>';
    // print_r($dados);
    // print $sql;
    $result = pg_query($conn, $sql);
    if ($result)
        print "Registro deletado";
    else
        print preg_last_error($conn);

    pg_close($conn);
}