<?php
require_once './1-table-data-gateway/ProdutoGateway.php';

try {
    //* Iniciando conexão
    $conn = new PDO("mysql: host=127.0.0.1;
                            port=8080;
                            dbname=estoque",
        "root",
        "root"
    );
    //* Definindo a conexão para a classe
    ProdutoGateway::setConnection($conn);
    //* Definindo retorno de erro
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    //? Conteudo para o banco de dados
    //* Insert
    // $data = new stdClass;
    // $data->descricao = "vinho";
    // $data->estoque = 8;
    // $data->preco_custo = 12;
    // $data->preco_venda = 18;
    // $data->codigo_barras = '123123123';
    // $data->data_cadastro = date('Y-m-d');
    // $data->origem = 'N';

    //? Salvando conteudo com gateway
    $gw = new ProdutoGateway;

    //* Buscando objeto e mudando valores (Update)
    // $produto = $gw->find(1);
    // $produto->estoque += 2;
    // $gw->save($produto);

    //* Salvando o conteudo (Insert)
    //$gw->save($data);

    //* Retornando todos os objetos criado (Get)
    foreach($gw->all('estoque>=10') as $produto){
        print $produto->descricao."<br>";
    }
} catch (Exception $e) {
    print $e->getMessage();
}