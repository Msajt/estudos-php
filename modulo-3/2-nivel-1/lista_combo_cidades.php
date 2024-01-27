<?php
//! Listando cidades para o formulário
function lista_combo_cidades($id_cidade='NULL')
{
    //? Conectando ao banco de dados
    $conn = pg_connect('host=localhost port=5432 dbname=livro user=postgres password=mynewpassword');

    //? Verificando resultado e inserindo valores para saída
    $result = pg_query($conn, 'SELECT id, nome FROM cidade');

    //? Caso houver itens na tabela, elas são adicionadas na variável html que retornará o trecho na tag <option>
    if ($result) {
        while ($row = pg_fetch_array($result)) {
            $id = $row['id'];
            $nome = $row['nome'];
            $check = ($id == $id_cidade) ? 'selected=1' : '';
            $output .= "<option {$check} value='{$id}'>{$nome}</option>";
        }
    }

    //? Fechando conexão e retornando variável
    pg_close($conn);
    return $output;
}
?>