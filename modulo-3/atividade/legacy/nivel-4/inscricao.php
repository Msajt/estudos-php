<?php
require_once './db/eventoManage.php';

//? Inicializando variaveis
$nome = '';
$email = '';
$curso = '';
$telefone = '';

//~ Verificando se o REQUEST (qualquer chamada HTTP) da url foi enviada corretamente
if (!empty($_REQUEST['action'])) {
    if ($_REQUEST['action'] = 'save') {
        //* Coletando os dados enviados
        $dadosInscricao = $_POST;

        //* Realizando a inscrição do usuário
        $inscricaoRealizada = inscricaoPalestra($dadosInscricao);

        //* Retorno na página
        ($dadosInscricao) ? print 'Inscrição realizada' : 'Houve um erro';
    }
}

require_once 'list-palestras.php';
$palestras = listPalestras();

//? Acessando os arquivos HTML
//* file_get_contents
$htmlInscricao = file_get_contents('./html/inscricao.html');
//? Substituindo os valores em {}
//* str_replace
$htmlInscricao = str_replace('{nome}', $nome, $htmlInscricao);
$htmlInscricao = str_replace('{email}', $email, $htmlInscricao);
$htmlInscricao = str_replace('{curso}', $curso, $htmlInscricao);
$htmlInscricao = str_replace('{telefone}', $telefone, $htmlInscricao);
$htmlInscricao = str_replace('{palestras}', $palestras, $htmlInscricao);

//? Exibir o HTML
print $htmlInscricao;