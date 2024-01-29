<?php
class Evento
{
    //? Separando a conexão com o banco de dados com os demais métodos
    //* Como a variável é estática, ela mantém seu valor
    private static $conn;
    //! Método de conexão ao banco de dados (singleton)
    public static function initDatabase()
    {
        //? Verificando se a variável está vazia
        if (self::$conn == null) {
            //? Pegando os dados do arquivo .ini
            $ini = parse_ini_file('./config/evento.ini');
            $host = $ini['host'];
            $name = $ini['name'];
            $user = $ini['user'];
            $password = $ini['pass'];

            //? Iniciando a conexão, utilizando PDO
            //* new PDO("pgsql: dbname=; user=; password; host=;")
            self::$conn = new PDO("pgsql: 
                                    dbname={$name};
                                    user={$user};
                                    password={$password};
                                    host={$host};");
            //? Forma de exibição do tratamento de erros
            self::$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
        return self::$conn;
    }

    //! Método de exibir a lista de palestras nas opções de inscrição
    public static function optionPalestras()
    {
        //? Iniciando a conexão, utilizando PDO
        $conn = self::initDatabase();
        //? Fazendo a consulta no banco de dados (listar as palestras disponíveis na parte da inscrição)
        //* new PDO(...)->query("sql input")
        $palestras = $conn->query("SELECT id, titulo FROM palestras");
        //? Retornando todos os dados obtidos
        //* new PDO(...)->fetch
        return $palestras->fetchAll();
    }

    //! Método de exibição de palestras
    public static function palestras()
    {
        //? Iniciando a conexão, utilizando PDO
        $conn = self::initDatabase();
        //? Fazendo a consulta no banco de dados (listando dados das palestras)
        $palestras = $conn->query("SELECT * FROM palestras ORDER BY id");
        //? Retornando todos os dados obtidos
        return $palestras->fetchAll();
    }

    //! Método de inscrever participante
    public static function inscricao($dados)
    {
        //? Iniciando a conexão, utilizando PDO
        $conn = self::initDatabase();
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

    //! Método de listagem dos participantes
    public static function participantes($id)
    {
        //? Iniciando a conexão, utilizando PDO
        $conn = self::initDatabase();
        //? Fazendo a consulta dos participantes inscritos na palestra 'x'
        $participantes = $conn->query("SELECT * FROM inscricoes WHERE id_palestra='{$id}'");
        //? Retornando os participantes inscritos
        return $participantes->fetchAll();
    }

    //! Método para o cabeçalho da página da palestra
    public static function cabecalho($id)
    {
        //? Iniciando a conexão, utilizando PDO
        $conn = self::initDatabase();
        //? Fazendo a consulta dos dados da palestra para fazer o cabeçalho da página
        $cabecalho = $conn->query("SELECT titulo, palestrante FROM palestras WHERE id='{$id}'");
        //? Retornando os dados para o cabeçalho
        return $cabecalho->fetch();
    }
}