<?php
$conn = pg_connect("host=localhost,
                                port=5432,
                                dbname=eventos
                                user=postgres
                                password=mynewpassword");

$dados = $_GET;
$id = $dados['id'];

$headerResult = pg_query($conn, "SELECT titulo, palestrante FROM palestras WHERE id='{$id}'");
$header = pg_fetch_array($headerResult);

$result = pg_query($conn, "SELECT * FROM inscricoes WHERE id_palestra='{$id}'");

$inscritosDisponiveis = '';
while ($inscricoes = pg_fetch_array($result)) {
    //? Pegando o conteúdo HTML
    //* file_get_contents
    $listaInscritos = file_get_contents('./html/listaInscritos.html');
    //? Substituindo variáveis que estão em {}
    //* str_replace
    $listaInscritos = str_replace('{nome}', $inscricoes['nome'], $listaInscritos);
    $listaInscritos = str_replace('{telefone}', $inscricoes['telefone'], $listaInscritos);
    $listaInscritos = str_replace('{email}', $inscricoes['email'], $listaInscritos);
    $listaInscritos = str_replace('{curso}', $inscricoes['curso'], $listaInscritos);

    $inscritosDisponiveis .= $listaInscritos;
}

pg_close($conn); //! Fechando conexão

//? Colocar conteúdo HTML na página da palestra
$palestraHTML = file_get_contents("./html/inscritos.html");
//? Substituindo conteúdo
$palestraHTML = str_replace('{titulo}', $header['titulo'], $palestraHTML);
$palestraHTML = str_replace('{palestrante}', $header['palestrante'], $palestraHTML);
$palestraHTML = str_replace('{inscritosDisponiveis}', $inscritosDisponiveis, $palestraHTML);

print $palestraHTML;
