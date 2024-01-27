<?php
require_once './db/eventoManage.php';

//? Listando as palestras disponíveis
$palestras = listaPalestras();

$palestrasDisponiveis = '';
foreach ($palestras as $palestra) {
    //? Acessando os arquivos HTML
    //* file_get_contents
    $conteudo = file_get_contents('./html/listaPalestras.html');
    //? Substituindo os valores em {}
    //* str_replace
    $conteudo = str_replace('{id}', $palestra['id'], $conteudo);
    $conteudo = str_replace('{titulo}', $palestra['titulo'], $conteudo);
    $conteudo = str_replace('{palestrante}', $palestra['palestrante'], $conteudo);
    $conteudo = str_replace('{horario}', $palestra['horario'], $conteudo);

    //? Alimentando o conteúdo das tabelas
    $palestrasDisponiveis .= $conteudo;
}

//? Definindo o template HTML
//* file_get_contents
$htmlPalestras = file_get_contents("./html/palestras.html");

//? Substituindo os valores em {}
//* str_replace
$htmlPalestras = str_replace("{palestrasDisponiveis}", $palestrasDisponiveis, $htmlPalestras);

//? Exibir o HTML
print $htmlPalestras;
