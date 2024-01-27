<?php
//? Conexão com banco de dados
//* pg_connect(host, port, dbname, user, password)
$conn = pg_connect("host=localhost,
                                    port=5432,
                                    dbname=eventos
                                    user=postgres
                                    password=mynewpassword");

//? Consulta da lista de palestras disponíveis
//* pg_query('comando')
$result = pg_query($conn, "SELECT * FROM palestras ORDER BY id");
//? Transformando busca em um array
//* pg_fetch_array (chave-valor) | pg_fetch_row (valor)
$palestrasDisponiveis = '';
while ($palestras = pg_fetch_array($result)) {
    //? Acessando os arquivos HTML
    //* file_get_contents
    $listaPalestras = file_get_contents('./html/listaPalestras.html');
    //? Substituindo os valores em {}
    //* str_replace
    $listaPalestras = str_replace('{id}', $palestras['id'], $listaPalestras);
    $listaPalestras = str_replace('{titulo}', $palestras['titulo'], $listaPalestras);
    $listaPalestras = str_replace('{palestrante}', $palestras['palestrante'], $listaPalestras);
    $listaPalestras = str_replace('{horario}', $palestras['horario'], $listaPalestras);

    //? Visualização dos eventos disponíveis
    $palestrasDisponiveis .= $listaPalestras;
}

pg_close($conn); //! Fechando conexão

//? Definindo o template HTML
//* file_get_contents
$htmlPalestras = file_get_contents("./html/palestras.html");
//? Substituindo os valores em {}
//* str_replace
$htmlPalestras = str_replace("{palestrasDisponiveis}", $palestrasDisponiveis, $htmlPalestras);
//? Exibir o HTML
print $htmlPalestras;
