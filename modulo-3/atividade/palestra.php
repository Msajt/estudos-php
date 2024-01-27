<?php
require_once './classes/Evento.php';

//? Coletando id da palestra
$dados = $_GET;
$id = $dados['id'];

//? Coletando dados referentes aos inscritos e cabeçalho da palestra
$header = Evento::cabecalho($id);
$inscritos = Evento::participantes($id);

$inscritosDisponiveis = '';
foreach ($inscritos as $inscrito) {
    //? Pegando o conteúdo HTML
    //* file_get_contents
    $conteudo = file_get_contents('./html/listaInscritos.html');
    //? Substituindo variáveis que estão em {}
    //* str_replace
    $conteudo = str_replace('{nome}', $inscrito['nome'], $conteudo);
    $conteudo = str_replace('{telefone}', $inscrito['telefone'], $conteudo);
    $conteudo = str_replace('{email}', $inscrito['email'], $conteudo);
    $conteudo = str_replace('{curso}', $inscrito['curso'], $conteudo);

    $inscritosDisponiveis .= $conteudo;
}

//? Colocar conteúdo HTML na página da palestra
$palestraHTML = file_get_contents("./html/inscritos.html");

//? Substituindo conteúdo em {}
$palestraHTML = str_replace('{titulo}', $header['titulo'], $palestraHTML);
$palestraHTML = str_replace('{palestrante}', $header['palestrante'], $palestraHTML);
$palestraHTML = str_replace('{inscritosDisponiveis}', $inscritosDisponiveis, $palestraHTML);

//? Exibindo conteúdo
print $palestraHTML;
