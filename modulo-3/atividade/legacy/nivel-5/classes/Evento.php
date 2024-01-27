<?php
class Evento
{
    public static function optionPalestras()
    {
        //? Iniciando a conexão, utilizando PDO
        //* new PDO("pgsql: dbname=; user=; password; host=;")
        $conn = new PDO("pgsql: 
                        dbname=eventos;
                        user=postgres;
                        password=mynewpassword;
                        host=127.0.0.1;");
        //? Forma de exibição do tratamento de erros
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        //? Fazendo a consulta no banco de dados (listar as palestras disponíveis na parte da inscrição)
        //* new PDO(...)->query("sql input")
        $palestras = $conn->query("SELECT id, titulo FROM palestras");
        //? Retornando todos os dados obtidos
        //* new PDO(...)->fetch
        return $palestras->fetchAll();
    }

    public static function palestras()
    {
        //? Iniciando a conexão, utilizando PDO
        //* new PDO("pgsql: dbname=; user=; password; host=;")
        $conn = new PDO("pgsql: 
                        dbname=eventos;
                        user=postgres;
                        password=mynewpassword;
                        host=127.0.0.1;");
        //? Forma de exibição do tratamento de erros
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        //? Fazendo a consulta no banco de dados (listando dados das palestras)
        $palestras = $conn->query("SELECT * FROM palestras ORDER BY id");
        //? Retornando todos os dados obtidos
        return $palestras->fetchAll();
    }

    public static function inscricao($dados)
    {
        //? Iniciando a conexão, utilizando PDO
        //* new PDO("pgsql: dbname=; user=; password; host=;")
        $conn = new PDO("pgsql: 
                        dbname=eventos;
                        user=postgres;
                        password=mynewpassword;
                        host=127.0.0.1;");
        //? Forma de exibição do tratamento de erros
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        //? Fazendo a requisição SQL para a inscrição do usuário
        $sql = "INSERT INTO inscricoes(id_palestra, nome, telefone, email, curso) 
                VALUES (
                    '{$dados['id_palestra']}',
                    '{$dados['nome']}',
                    '{$dados['telefone']}',
                    '{$dados['email']}',
                    '{$dados['curso']}'
                )";
        //? Adicionando nova inscrição no banco de dados
        return $conn->query($sql);
    }

    public static function participantes($id)
    {
        //? Iniciando a conexão, utilizando PDO
        //* new PDO("pgsql: dbname=; user=; password; host=;")
        $conn = new PDO("pgsql: 
                        dbname=eventos;
                        user=postgres;
                        password=mynewpassword;
                        host=127.0.0.1;");
        //? Forma de exibição do tratamento de erros
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        //? Fazendo a consulta dos participantes inscritos na palestra 'x'
        $participantes = $conn->query("SELECT * FROM inscricoes WHERE id_palestra='{$id}'");
        //? Retornando os participantes inscritos
        return $participantes->fetchAll();
    }

    public static function cabecalho($id)
    {
        //? Iniciando a conexão, utilizando PDO
        //* new PDO("pgsql: dbname=; user=; password; host=;")
        $conn = new PDO("pgsql: 
                        dbname=eventos;
                        user=postgres;
                        password=mynewpassword;
                        host=127.0.0.1;");
        //? Forma de exibição do tratamento de erros
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        //? Fazendo a consulta dos dados da palestra para fazer o cabeçalho da página
        $cabecalho = $conn->query("SELECT titulo, palestrante FROM palestras WHERE id='{$id}'");
        //? Retornando os dados para o cabeçalho
        return $cabecalho->fetch();
    }
}