<?php
require_once './1-table-data-gateway/ProdutoGateway.php';
require_once './1-table-data-gateway/Produto.php';

try {
    //* Iniciando conexão
    $conn = new PDO("mysql: host=127.0.0.1;
                            port=8080;
                            dbname=estoque",
        "root",
        "root"
    );
    //* Definindo retorno de erro
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    //* Definindo a conexão para a classe
    Produto::setConnection($conn);

    //* Listando produtos
    // $produtos = Produto::all();
    // foreach($produtos as $produto){
    //     print $produto->descricao;
    // }

    $produto = new Produto;
    $produto->descricao = 'Vinho Branco';
    $produto->estoque = 10;
    $produto->preco_custo = 12;
    $produto->preco_venda = 18;
    $produto->codigo_barras = '123123123';
    $produto->data_cadastro = date('Y-m-d');
    $produto->origem = 'N';
    $produto->save();

    $outro = Produto::find(1);
    print "Descricao: {$outro->descricao}<br>";
    print "Margem de lucro: {$outro->getMargemLucro()}% <br>";
    $outro->registraCompra(14,5);
    $outro->save();
} catch (Exception $e) {
    print $e->getMessage();
}