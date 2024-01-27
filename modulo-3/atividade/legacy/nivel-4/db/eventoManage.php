<?php
function inscricaoPalestra($dados)
{
    //? Conexão ao banco de dados
    //* $conn = pg_connect(host, port, dbname, user, password)
    $conn = pg_connect("host=localhost
                        port=5432
                        dbname=eventos
                        user=postgres
                        password=mynewpassword");

    //? Fazendo a requisição SQL
    $sql = "INSERT INTO inscricoes(id_palestra, nome, telefone, email, curso) 
            VALUES (
                '{$dados['id_palestra']}',
                '{$dados['nome']}',
                '{$dados['telefone']}',
                '{$dados['email']}',
                '{$dados['curso']}'
            )";

    //? Inserindo dados no banco
    $result = pg_query($conn, $sql);

    //! Fechando conexão
    pg_close($conn);

    //? Retornando booleano do resultado
    return $result;
}

function listaPalestras()
{
    //? Conexão com banco de dados
    //* pg_connect(host, port, dbname, user, password)
    $conn = pg_connect("host=localhost
                        port=5432
                        dbname=eventos
                        user=postgres
                        password=mynewpassword");

    //? Consulta da lista de palestras disponíveis
    //* pg_query('comando')
    $result = pg_query($conn, "SELECT * FROM palestras ORDER BY id");

    //? Coletando todas as palestras em um array
    $palestraDisponiveis = pg_fetch_all($result);

    //! Fechando conexão
    pg_close($conn);

    //? Retornando palestras disponíveis
    return $palestraDisponiveis;
}

function listaParticipantes($id)
{
    //? Conexão com banco de dados
    //* pg_connect(host, port, dbname, user, password)
    $conn = pg_connect("host=localhost
                        port=5432
                        dbname=eventos
                        user=postgres
                        password=mynewpassword");

    //? Fazendo a consulta dos participantes da palestra 'x'
    $result = pg_query($conn, "SELECT * FROM inscricoes WHERE id_palestra='{$id}'");

    //? Agrupando todos os participantes
    $participantesInscritos = pg_fetch_all($result);

    //! Fechando conexão
    pg_close($conn);

    //? Retornando participantes inscritos na palestra 'x'
    return $participantesInscritos;
}

function cabecalhoPalestra($id)
{
    //? Conexão com banco de dados
    //* pg_connect(host, port, dbname, user, password)
    $conn = pg_connect("host=localhost
                        port=5432
                        dbname=eventos
                        user=postgres
                        password=mynewpassword");

    //? Consultando dados referentes a palestra escolhida
    $headerResult = pg_query($conn, "SELECT titulo, palestrante FROM palestras WHERE id='{$id}'");

    //? Agrupando dados encontrados
    $header = pg_fetch_array($headerResult);

    //! Fechando conexão
    pg_close($conn);

    return $header;
}