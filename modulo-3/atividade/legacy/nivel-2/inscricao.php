<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./styles/inscricao.css">
    <title>Document</title>
</head>

<body>
    <h4>Inscrição da palestra</h4>

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
            print "ID Palestra " . $id_palestra;
            //* Inserindo dados no banco
            $result = pg_query($conn, $sql);
            if ($result)
                print "Inscrição realizada com sucesso.";
            else
                print preg_last_error($conn);
    
            pg_close($conn);
        }
    }
    ?>

    <!-- 
        //? Ao invés de trocar para outro arquivo, basta inserir uma 'action'
    -->
    <form action="inscricao.php?action=save" method="POST" enctype="multipart/form-data">
        <!-- 
            //* Verificar a entrada usando a tag 'value'
        -->
        <label>Nome</label>
        <input type="text" name='nome' value="">
        <label>Email</label>
        <input type="text" name='email' value="">
        <label>Curso</label>
        <input type="text" name='curso' value="">
        <label>Telefone</label>
        <input type="text" name='telefone' value="">
        <label>Palestra</label>
        <select name="id_palestra">
            <!-- 
                //?Código php para listagem de palestras 
            -->
            <?php
            require_once('./list-palestras.php');
            print listPalestras();
            ?>
        </select>
        <input type="submit">
    </form>
</body>

</html>