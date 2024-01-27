<?php
// require_once './db/eventoManage.php';
require_once './classes/Evento.php';

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
        $inscricaoRealizada = Evento::inscricao($dadosInscricao);

        //* Retorno na página
        ($inscricaoRealizada) ? print 'Inscrição realizada' : 'Houve um erro';
    }
}

//? Nova forma de acesso a lista de palestras disponíveis
$palestras = '';
foreach(Evento::optionPalestras() as $palestra){
    $id = $palestra['id'];
    $titulo = $palestra['titulo'];

    $palestras .= "<option value='{$id}'>{$titulo}</option>";
}

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