<?php
require_once('./db/pessoa_db.php');

$pessoa = [];
$pessoa['id'] = '';
$pessoa['nome'] = '';
$pessoa['endereco'] = '';
$pessoa['bairro'] = '';
$pessoa['telefone'] = '';
$pessoa['email'] = '';
$pessoa['id_cidade'] = '';

//! Edição ou nova pessoa da tabela
//~ Verificando se o REQUEST (qualquer chamada HTTP) da url foi enviada corretamente
if (!empty($_REQUEST['action'])) {
    //? Verificando se a action foi para edição
    if ($_REQUEST['action'] == 'edit') {
        if (!empty($_GET['id'])) {
            //? Buscando pessoa no banco de dados
            $id = (int) $_GET['id'];
            $pessoa = get_pessoa($id);
        }
    } else if ($_REQUEST["action"] == "save") {
        //? Coletando dados do POST
        $id = $_POST['id'];
        $pessoa = $_POST;

        if (empty($_POST['id'])) {
            //? Inserindo pessoa
            $pessoa['id'] = get_next_pessoa();
            $result = insert_pessoa($pessoa);
        } else {
            //? Atualizando pessoa
            $result = update_pessoa($pessoa);
        }

        print($result) ? 'Registro salvo com sucesso' : 'Problemas ao salvar';
    }
}

require_once 'lista_combo_cidades.php';
$cidades = lista_combo_cidades($pessoa['id_cidade']);

//? Acessando as variáveis marcadas no arquivo html
//* Substituindo as marcações pelos valores da variável
$form = file_get_contents('./html/form.html');
$form = str_replace('{id}', $pessoa['id'], $form);
$form = str_replace('{nome}', $pessoa['nome'], $form);
$form = str_replace('{endereco}', $pessoa['endereco'], $form);
$form = str_replace('{bairro}', $pessoa['bairro'], $form);
$form = str_replace('{telefone}', $pessoa['telefone'], $form);
$form = str_replace('{email}', $pessoa['email'], $form);
$form = str_replace('{id_cidade}', $pessoa['id_cidade'], $form);
$form = str_replace('{cidades}', $cidades, $form);

print $form;