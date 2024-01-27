<html>

<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <title>Cadastro de pessoa</title>
    <link rel="stylesheet" href="./css/style.css">
</head>

<body>
    <form enctype="multipart/form-data" method="POST" action="pessoa_save_insert.php">
        <label>Código</label>
        <input name="id" readonly="1" type='text' style="width:30%">
        <label>Nome</label>
        <input name="nome" type='text' style="width:50%">
        <label>Endereço</label>
        <input name="endereco" type='text' style="width:50%">
        <label>Bairro</label>
        <input name="bairro" type='text' style="width:30%">
        <label>Telefone</label>
        <input name="telefone" type='text' style="width:30%">
        <label>Email</label>
        <input name="email" type='text' style="width:30%">
        <label>Cidade</label>
        <!-- <input name="id" readonly="1" type='text' style="width:30%"> -->
        <select name="id_cidade" style="width:25%">
            <?php
                require_once 'lista_combo_cidades.php';
                print lista_combo_cidades();
            ?>
        </select>
        <input type="submit">
    </form>
</body>

</html>