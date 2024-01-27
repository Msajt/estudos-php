<?php
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
    $conn = pg_connect('host=localhost port=5432 dbname=livro user=postgres password=mynewpassword');
    //? Verificando se a action foi para edição
    if ($_REQUEST['action'] == 'edit') {
        if (!empty($_GET['id'])) {
            //? Iniciando conexão
            $id = (int) $_GET['id'];

            //? Buscando pessoa no banco de dados
            $result = pg_query($conn, "SELECT * FROM pessoa WHERE id='{$id}'");
            $pessoa = pg_fetch_assoc($result); //* Transforma em array
        }
    } else if ($_REQUEST["action"] == "save") {
        //print_r($_POST);
        $id = $_POST['id'];
        $pessoa = $_POST;

        if (empty($_POST['id'])) {
            $result = pg_query($conn, "SELECT max(id) as next FROM pessoa");
            $row = pg_fetch_assoc($result);
            $next = (int) $row["next"] + 1;
            $sql = "INSERT INTO pessoa (id, nome, endereco, bairro, telefone, email, id_cidade)
                            VALUES ('{$next}', 
                                    '{$pessoa['nome']}', 
                                    '{$pessoa['endereco']}', 
                                    '{$pessoa['bairro']}', 
                                    '{$pessoa['telefone']}',
                                    '{$pessoa['email']}',
                                    '{$pessoa['id_cidade']}')";
            $result = pg_query($conn, $sql);
        } else {
            $sql = "UPDATE pessoa SET     nome =      '{$pessoa['nome']}',
                                          endereco =  '{$pessoa['endereco']}',
                                          bairro =    '{$pessoa['bairro']}',
                                          telefone =  '{$pessoa['telefone']}',
                                          email =     '{$pessoa['email']}',
                                          id_cidade = '{$pessoa['id_cidade']}'
                                      WHERE id='{$id}'";
            $result = pg_query($conn, $sql);
        }

        print($result) ? 'Registro salvo com sucesso' : pg_last_error($conn);
        pg_close($conn);
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
?>