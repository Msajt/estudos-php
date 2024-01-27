<?php
//! Recebendo os dados do formulário pelo método POST
$dados = $_POST;

//? Conexão do banco de dados
$conn = pg_connect('host=localhost port=5432 dbname=livro user=postgres password=mynewpassword');
//? Não estou usando AUTO INCREMENT do id, então é feito manualmente
$result = pg_query($conn, 'SELECT max(id) as next FROM pessoa');
//? Armazenando o resultado do id atual
$row = pg_fetch_assoc($result);
//? Incrementando o valor do próximo id
$next = (int) $row['next'] + 1;

//* Chamada para inserção dos dados do cadastro
$sql = "INSERT INTO pessoa(id, nome, endereco, bairro, telefone, email, id_cidade)
        VALUES ('{$next}',
                '{$dados['nome']}',
                '{$dados['endereco']}',
                '{$dados['bairro']}',
                '{$dados['telefone']}',
                '{$dados['email']}',
                '{$dados['id_cidade']}'
                )";

//? Inserindo query na tabela 'pessoa'
$result = pg_query($conn, $sql);

//? Verificando sucesso ou erro
if ($result)
    print "Registro inserido";
else
    print preg_last_error($conn);

//? Fechando conexão
pg_close($conn);