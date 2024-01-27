<?php
//! Usaremos Postgres, MySQL
//´ Criando uma tabela
//?    CREATE TABLE table_name(name type, ...);

//? Conexão em Postgres
//* Conectando ao banco de dados
$conn = pg_connect("host=localhost port=5432 dbname=livro user=postgres password=");

//! Cada parte deve ser separada em arquivos diferentes
//^ Está aqui a título de exemplo

//* Inserção de dados
pg_query($conn, "INSERT INTO famosos (codigo, nome) VALUES (1, 'Érico Veríssimo')");
pg_query($conn, "INSERT INTO famosos (codigo, nome) VALUES (2, 'Érico Veríssimo')");
pg_query($conn, "INSERT INTO famosos (codigo, nome) VALUES (3, 'Érico Veríssimo')");
pg_query($conn, "INSERT INTO famosos (codigo, nome) VALUES (4, 'Érico Veríssimo')");
pg_query($conn, "INSERT INTO famosos (codigo, nome) VALUES (5, 'Érico Veríssimo')");
pg_query($conn, "INSERT INTO famosos (codigo, nome) VALUES (6, 'Érico Veríssimo')");
pg_query($conn, "INSERT INTO famosos (codigo, nome) VALUES (7, 'Érico Veríssimo')");

//* Listando dados adicionados
$query = 'SELECT codigo, nome FROM famosos';
$result = pg_query($conn, $query);

if ($result) {
    $row = pg_fetch_assoc($result); // Exibe um registro (uma linha)
}

print_r($row);

//* Fechando a conexão
pg_close($conn);

//? Conexão em MySQL
//* Conectando ao banco de dados
$conn = mysqli_connect('127.0.0.1', 'root', 'mysql', 'livro');

//* Inserção de dados
mysqli_query($conn, "INSERT INTO famosos (codigo, nome) VALUES (1, 'Érico Veríssimo')");

//* Listando dados adicionados
$query = "SELECT codigo, nome FROM famosos";
$result = mysqli_query($conn, $query);

if ($result) {
    $row = mysqli_fetch_assoc($result);
    while($row = mysqli_fetch_assoc($result)){
        echo $row['codigo'] . '-' . $row['nome'].'<br>';
    }
}

//* Fechando a conexão
mysqli_close($conn);

//! A partir da biblioteca PDO, podemos utilizar isso que
//! fizemos utilizando orientação a objetos, independente
//! do banco de dados utilizado