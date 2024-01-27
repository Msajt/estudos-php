<html>

<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <title>Edição de pessoa</title>
    <link rel="stylesheet" href="./css/style.css">
</head>

<body>
    <?php
    //! Edição de pessoa da tabela
    //~ Verificando se a variável da url foi enviada corretamente
    if (!empty($_GET['id'])) {
        //? Iniciando conexão
        $conn = pg_connect('host=localhost port=5432 dbname=livro user=postgres password=mynewpassword');
        $id = (int) $_GET['id'];

        //? Buscando pessoa no banco de dados
        $result = pg_query($conn, "SELECT * FROM pessoa WHERE id='{$id}'");
        $row = pg_fetch_assoc($result); //* Transforma em array
    
        $id = $row["id"];
        $nome = $row["nome"];
        $endereco = $row["endereco"];
        $bairro = $row["bairro"];
        $telefone = $row["telefone"];
        $email = $row["email"];
        $id_cidade = $row["id_cidade"];
    }

    ?>
    <form enctype="multipart/form-data" method="POST" action="pessoa_save_update.php">
        <label>Código</label>
        <input name="id" readonly="1" type='text' style="width:30%" value="<?=$id?>">
        <label>Nome</label>
        <input name="nome" type='text' style="width:50%" value="<?=$nome?>">
        <label>Endereço</label>
        <input name="endereco" type='text' style="width:50%" value="<?=$endereco?>">
        <label>Bairro</label>
        <input name="bairro" type='text' style="width:30%" value="<?=$bairro?>">
        <label>Telefone</label>
        <input name="telefone" type='text' style="width:30%" value="<?=$telefone?>"> 
        <label>Email</label>
        <input name="email" type='text' style="width:30%" value="<?=$email?>">
        <label>Cidade</label>
        <!-- <input name="id" readonly="1" type='text' style="width:30%"> -->
        <select name="id_cidade" style="width:25%">
            <?php
            require_once 'lista_combo_cidades.php';
            print lista_combo_cidades($id_cidade);
            ?>
        </select>
        <input type="submit">
    </form>
</body>

</html>