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
    <form action="save-inscricao.php" method="POST" enctype="multipart/form-data">
        <label>Nome</label>
        <input type="text" name='nome'>
        <label>Email</label>
        <input type="text" name='email'>
        <label>Curso</label>
        <input type="text" name='curso'>
        <label>Telefone</label>
        <input type="text" name='telefone'>
        <label>Palestra</label>
        <select name="id_palestra">
            <!-- Código php para listagem de palestras -->
            <?php
                require_once('./list-palestras.php');
                print listPalestras();
            ?>
        </select>
        <input type="submit">
    </form>
</body>
</html>