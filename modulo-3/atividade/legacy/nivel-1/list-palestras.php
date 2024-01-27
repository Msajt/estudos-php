<?php
function listPalestras()
{
    //? Conexão com o banco de dados
    $conn = pg_connect("host=localhost,
                    port=5432,
                    dbname=eventos
                    user=postgres
                    password=mynewpassword");

    //? Faz a busca das palestras disponíveis
    $result = pg_query($conn, "SELECT id, titulo FROM palestras");
    $palestras_list = '';
    //? Coloca no array
    if ($result) {
        while ($palestras = pg_fetch_array($result)) {
            //? Transforma o retorno para um html
            $id = $palestras['id'];
            $titulo = $palestras['titulo'];

            $palestras_list .= "<option value='{$id}'>{$titulo}</option>";
        }
    }
    //? Fechando a conexão
    pg_close( $conn );
    return $palestras_list;
}