<?php
//? Coleta os valores coletados pelo método POST
$dados = $_POST;
var_dump($dados);

//? Conexão com o banco de dados
$conn = pg_connect("host=localhost,
                    port=5432,
                    dbname=eventos
                    user=postgres
                    password=mynewpassword");

//? Cria o query do SQL
$sql = "INSERT INTO inscricoes(id_palestra, nome, telefone, email, curso) 
        VALUES (
            '{$dados['id_palestra']}',
            '{$dados['nome']}',
            '{$dados['telefone']}',
            '{$dados['email']}',
            '{$dados['curso']}'
        )";

//? Insere os dados na tabela 'inscricoes'
$result = pg_query($conn, $sql);

if($result) print "Inscricao realizada com sucesso";
else print preg_last_error($conn);

//? Fechando conexão
pg_close($conn);