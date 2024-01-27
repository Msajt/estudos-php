<!--
    //! Lista contendo as palestras disponíveis para inscrição 
-->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./styles/palestras.css">
    <title>Palestras</title>
</head>

<body>
    <table border=1>
        <!-- Cabeçalho da tabela -->
        <thead>
            <!-- Título da tabela -->
            <tr>
                <th colspan="4"> PALESTRAS DISPONÍVEIS </th>
            </tr>
            <!-- Elementos da lista de palestras -->
            <tr>
                <td></td>
                <td><b>Palestra</td>
                <td><b>Palestrante</td>
                <td><b>Horário</td>

            </tr>
        </thead>
        <tbody>
            <!-- Palestras -->
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
            while ($palestras = pg_fetch_array($result)) {
                $id = $palestras['id'];
                $titulo = $palestras['titulo'];
                $palestrante = $palestras['palestrante'];
                $horario = $palestras['horario'];

                //? Visualização dos eventos disponíveis
                print "<tr>
                           <td>
                            <a href='palestra.php?id={$id}'>
                            <img src='./images/details.svg' style='width:20px'>
                           </td>
                           <td>{$titulo}</td>
                           <td>{$palestrante}</td>
                           <td>{$horario}</td>
                        </tr>";
            }

            pg_close($conn);
            ?>
        </tbody>
    </table>
    <a href='./inscricao.php'>Inscreva-se</a>
</body>

</html>