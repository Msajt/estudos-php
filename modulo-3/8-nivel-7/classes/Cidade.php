<?php
class Cidade
{
    public static function all(){
        //* Criando uma nova conexão a partir do PDO
        $conn = new PDO("pgsql:
                     dbname=livro;
                     user=postgres;
                     password=mynewpassword;
                     host=127.0.0.1");
        //* Forma de tratamento de erros (Exception)
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        //* Método query (fazendo a consulta no banco)
        $result = $conn->query("SELECT * FROM cidade ORDER BY id");
        //* Retornando todos os resultados obtidos
        //! Se a tabela é muito grande, deve ser feita a paginação
        return $result->fetchAll();
    }
}