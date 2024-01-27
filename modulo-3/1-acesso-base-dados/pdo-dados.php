<?php
//! Utilizando a biblioteca PDO para uso do banco de dados
//? Declara um objeto da classe PDO
try {
    //* Fazendo a conexão
    //^ Utilizando Postgres
    $conn = new PDO("pgsql: dbname=livro;
                            user=postgres;
                            password=;
                            host=localhost");
    //^Utilizando MySQL
    $conn = new PDO("mysql: host=127.0.0.1;
                            port=3306;
                            dbname=livro",
        'root',
        'mysql'
    );
    //^ Como é tratado o erro
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    //* Executando um comando de execução para inserir novo dado
    $conn->exec("INSERT INTO famosos (codigo, nome) VALUES (1, 'Érico Verissimo'");

    //* Executando um comando para listar os dados
    $result = $conn->query("SELECT codigo, nome FROM famosos");
    if ($result) {
        //^ Listando como array
        foreach ($result as $row) {
            print $row['codigo'] . '-' . $row['nome'] . '<br>';
        }
        //^ Listando como objeto
        while ($row = $result->fetch(PDO::FETCH_OBJ)) { // fetchObject
            print $row->codigo . '-' . $row->nome . '<br>';
        }
    }

    //* Fechando a conexão
    $conn = null;

    //! Em caso de erro, ele envia uma Exception
} catch (PDOException $e) {
    echo "" . $e->getMessage();
}