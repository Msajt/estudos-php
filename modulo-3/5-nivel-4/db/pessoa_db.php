<?php
//! CRUD dos dados de 'pessoa'
//? GET pessoa
function get_pessoa($id)
{
    //* Abrindo conexão
    $conn = pg_connect('host=localhost 
                        port=5432 
                        dbname=livro 
                        user=postgres 
                        password=mynewpassword');
    //* Buscando usuário
    $result = pg_query($conn, "SELECT * FROM pessoa WHERE id = '{$id}'");
    $pessoa = pg_fetch_array($result); //~ array de pessoa
    pg_close($conn);

    //* Retornando resultado
    return $pessoa;
}
//? DELETE pessoa
function exclui_pessoa($id)
{
    //* Abrindo conexão
    $conn = pg_connect('host=localhost 
                        port=5432 
                        dbname=livro 
                        user=postgres 
                        password=mynewpassword');
    //* Buscando usuário e deletando
    $result = pg_query($conn, "DELETE FROM pessoa WHERE id = '{$id}'");
    pg_close($conn);

    //* Retornando resultado
    return $result;
}
//? INSERT pessoa
function insert_pessoa($pessoa)
{
    //* Abrindo conexão
    $conn = pg_connect('host=localhost 
                        port=5432 
                        dbname=livro 
                        user=postgres 
                        password=mynewpassword');
    //* Inserindo chamada SQL
    $sql = "INSERT INTO pessoa (id, nome, endereco, bairro, telefone, email, id_cidade)
    VALUES ('{$pessoa['id']}', 
            '{$pessoa['nome']}', 
            '{$pessoa['endereco']}', 
            '{$pessoa['bairro']}', 
            '{$pessoa['telefone']}',
            '{$pessoa['email']}',
            '{$pessoa['id_cidade']}')";
    //* Passando dados para a tabela
    $result = pg_query($conn, $sql);
    pg_close($conn);

    return $result;
}
//? UPDATE pessoa
function update_pessoa($pessoa)
{
    //* Abrindo conexão
    $conn = pg_connect('host=localhost 
                        port=5432 
                        dbname=livro 
                        user=postgres 
                        password=mynewpassword');
    //* Inserindo chamada SQL
    $sql = "UPDATE pessoa SET nome =      '{$pessoa['nome']}',
                              endereco =  '{$pessoa['endereco']}',
                              bairro =    '{$pessoa['bairro']}',
                              telefone =  '{$pessoa['telefone']}',
                              email =     '{$pessoa['email']}',
                              id_cidade = '{$pessoa['id_cidade']}'
                          WHERE id='{$pessoa['id']}'";
    //* Atualizando dados da tabela
    $result = pg_query($conn, $sql);
    pg_close($conn);

    return $result;
}

function lista_pessoas(){
    //* Abrindo conexão
    $conn = pg_connect('host=localhost 
                        port=5432 
                        dbname=livro 
                        user=postgres 
                        password=mynewpassword');
    //* Buscando todos os usuário
    $result = pg_query($conn, "SELECT * FROM pessoa ORDER BY id");
    $list = pg_fetch_all($result); //~ array de pessoa
    pg_close($conn);

    //* Retornando resultado
    return $list;
}

function get_next_pessoa()
{
    //* Abrindo conexão
    $conn = pg_connect('host=localhost 
                        port=5432 
                        dbname=livro 
                        user=postgres 
                        password=mynewpassword');
    //* Buscando ultimo valor da id
    $result = pg_query($conn, "SELECT max(id) as next FROM pessoa");
    $pessoa = pg_fetch_array($result);
    $next = (int) $pessoa["next"]+1;
    pg_close($conn);

    //* Retornando resultado
    return $next;
}
