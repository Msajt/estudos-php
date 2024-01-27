<!--
    //! Lista contendo as palestras disponíveis para inscrição 
-->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./styles/palestra.css">
    <title>Palestras</title>
</head>

<body>
    <table border=1>
        <!-- Cabeçalho da tabela -->
        <thead>
            <?php
            $conn = pg_connect("host=localhost,
                                port=5432,
                                dbname=eventos
                                user=postgres
                                password=mynewpassword");

            $dados = $_GET;
            $id = $dados['id'];

            $result = pg_query($conn, "SELECT titulo, palestrante FROM palestras WHERE id='{$id}'");
            $row = pg_fetch_array($result);

            //? Título da tabela
            print "<tr>
                        <th colspan='4'> {$row['titulo']} ({$row['palestrante']}) </th>
                   </tr>";
            ?>

            <!-- Elementos da lista de palestras -->
            <tr>
                <td>Nome</td>
                <td>Telefone</td>
                <td>Email</td>
                <td>Curso</td>
            </tr>
        </thead>
        <tbody>
            <!-- Palestras -->
            <?php
            $result = pg_query($conn, "SELECT * FROM inscricoes WHERE id_palestra='{$id}'");

            while ($inscricoes = pg_fetch_array($result)) {
                $nome = $inscricoes['nome'];
                $telefone = $inscricoes['telefone'];
                $email = $inscricoes['email'];
                $curso = $inscricoes['curso'];

                //? Visualização dos inscritos na palestra
                print "<tr>
                           <td>{$nome}</td>
                           <td>{$telefone}</td>
                           <td>{$email}</td>
                           <td>{$curso}</td>
                        </tr>";

                pg_close($conn);
            }
            ?>
        </tbody>
    </table>
</body>

</html>