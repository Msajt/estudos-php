<?php
class Pessoa
{
    //? Busca pessoa
    public static function find($id)
    {
        //* Criando uma nova conexão a partir do PDO
        $conn = new PDO("pgsql:
                     dbname=livro;
                     user=postgres;
                     password=mynewpassword;
                     host=127.0.0.1");
        //* Forma de tratamento de erros (Exception)
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        //* Método query (fazendo a consulta no banco)
        $result = $conn->query("SELECT * FROM pessoa WHERE id='{$id}'");
        //* Retornando o resultado obtido
        return $result->fetch();
    }
    //? Deleta pessoa
    public static function delete($id)
    {
        //* Criando uma nova conexão a partir do PDO
        $conn = new PDO("pgsql:
                     dbname=livro;
                     user=postgres;
                     password=mynewpassword;
                     host=127.0.0.1");
        //* Forma de tratamento de erros (Exception)
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        //* Método query (fazendo a consulta no banco)
        $result = $conn->query("DELETE FROM pessoa WHERE id='{$id}'");
        //* Retornando o resultado obtido
        return $result;
    }
    //? Retorna todos da lista
    public static function all()
    {
        //* Criando uma nova conexão a partir do PDO
        $conn = new PDO("pgsql:
                     dbname=livro;
                     user=postgres;
                     password=mynewpassword;
                     host=127.0.0.1");
        //* Forma de tratamento de erros (Exception)
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        //* Método query (fazendo a consulta no banco)
        $result = $conn->query("SELECT * FROM pessoa ORDER BY id");
        //* Retornando todos os resultados obtidos
        //! Se a tabela é muito grande, deve ser feita a paginação
        return $result->fetchAll();
    }
    //? Insere ou atualiza uma pessoa
    public static function save($pessoa)
    {
        //* Criando uma nova conexão a partir do PDO
        $conn = new PDO("pgsql:
                     dbname=livro;
                     user=postgres;
                     password=mynewpassword;
                     host=127.0.0.1");
        //* Forma de tratamento de erros (Exception)
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        if (empty($pessoa['id'])) {
            //* Pegando o valor do próximo id
            $result = $conn->query("SELECT max(id) as next FROM pessoa");
            $row = $result->fetch(); // Retorna a primeira linha
            $pessoa['id'] = (int) $row['next'] + 1;
            //* Chamada SQL
            $sql = "INSERT INTO pessoa (id, 
                                        nome, 
                                        endereco, 
                                        bairro, 
                                        telefone, 
                                        email, 
                                        id_cidade)
                                VALUES ('{$pessoa['id']}', 
                                        '{$pessoa['nome']}', 
                                        '{$pessoa['endereco']}', 
                                        '{$pessoa['bairro']}', 
                                        '{$pessoa['telefone']}',
                                        '{$pessoa['email']}',
                                        '{$pessoa['id_cidade']}')";
        } else {
            //* Chamada SQL
            $sql = "UPDATE pessoa SET nome =      '{$pessoa['nome']}',
                                      endereco =  '{$pessoa['endereco']}',
                                      bairro =    '{$pessoa['bairro']}',
                                      telefone =  '{$pessoa['telefone']}',
                                      email =     '{$pessoa['email']}',
                                      id_cidade = '{$pessoa['id_cidade']}'
                    WHERE id='{$pessoa['id']}'";
        }
        //* Consulta SQL na base de dados
        return $conn->query($sql);
    }
}