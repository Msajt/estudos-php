<html>

<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <link rel="stylesheet" href="./css/style-list.css">
    <title>Listagem de pessoas</title>
</head>

<body>
    <!-- Gerando tabela de dados -->
    <table border=1>
        <!-- Cabeçalho da tabela -->
        <thead>
            <tr>
                <td></td>
                <td></td>
                <td>Id</td>
                <td>Nome</td>
                <td>Endereço</td>
                <td>Bairro</td>
                <td>Telefone</td>
                <td>Email</td>
            </tr>
        </thead>
        <!-- O corpo será gerado pelo programa pelo bd -->
        <tbody>
            <?php
            //! Programa para listagem dos usuários cadastrados
            //? Conexão ao banco de dados
            $conn = pg_connect('host=localhost 
                                port=5432 
                                dbname=livro 
                                user=postgres 
                                password=mynewpassword'
            );

            //* Caso seja a ação de 'delete'
            if (!empty($_GET['action']) && ($_GET['action'] == 'delete')) {
                $id = (int) $_GET['id'];
                pg_query($conn, "DELETE FROM pessoa WHERE id='{$id}'");
            }

            //? Consulta dos dados da tabela 'pessoa'
            $result = pg_query($conn, 'SELECT * FROM pessoa ORDER BY id');

            //? Inserindo dados encontrados em uma variável
            while ($row = pg_fetch_array($result)) {
                $id = $row['id'];
                $nome = $row['nome'];
                $endereco = $row['endereco'];
                $bairro = $row['bairro'];
                $telefone = $row['telefone'];
                $email = $row['email'];
                $id_cidade = $row['id_cidade'];

                //* Inserindo os dados no formato HTML
                print '<tr>';
                //? Chamando a action de editar o usuário
                print "<td> 
                        <a href='pessoa_form.php?action=edit&id={$id}'>
                        <img src='./img/edit.svg' style='width:17px'>
                       </td>";
                //? Chamando a action de excluir o usuário
                print "<td> 
                       <a href='pessoa_list.php?action=delete&id={$id}'>
                       <img src='./img/delete.svg' style='width:17px'>
                      </td>";
                print "<td> {$id} </td>";
                print "<td> {$nome} </td>";
                print "<td> {$endereco} </td>";
                print "<td> {$bairro} </td>";
                print "<td> {$telefone} </td>";
                print "<td> {$email} </td>";
                print '</tr>';
            }
            ?>
        </tbody>
    </table>
    <button onclick="window.location='pessoa_form.php'">
        <img src="./img/insert.svg" style="width:17px">Inserir
    </button>
</body>

</html>