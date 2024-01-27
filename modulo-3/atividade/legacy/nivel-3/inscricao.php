<?php
//? Inicializando variaveis
$nome = '';
$email = '';
$curso = '';
$telefone = '';

//~ Verificando se o REQUEST (qualquer chamada HTTP) da url foi enviada corretamente
if (!empty($_REQUEST['action'])) {
    //? Conexão ao banco de dados
    //* $conn = pg_connect(host, port, dbname, user, password)
    $conn = pg_connect("host=localhost
                            port=5432
                            dbname=eventos
                            user=postgres
                            password=mynewpassword");
    //? Verificar se o request da action enviada tá correta
    if ($_REQUEST['action'] = 'save') {
        //* Coletando os dados enviados
        $nome = $_POST['nome'];
        $email = $_POST['email'];
        $curso = $_POST['curso'];
        $telefone = $_POST['telefone'];
        $id_palestra = $_POST['id_palestra'];

        //* Fazendo a requisição SQL
        $sql = "INSERT INTO inscricoes(id_palestra, nome, telefone, email, curso) 
                        VALUES (
                            '{$id_palestra}',
                            '{$nome}',
                            '{$telefone}',
                            '{$email}',
                            '{$curso}'
                        )";

        //* Inserindo dados no banco
        $result = pg_query($conn, $sql);
        if ($result)
            print "Inscrição realizada com sucesso.";
        else
            print preg_last_error($conn);

        pg_close($conn);
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