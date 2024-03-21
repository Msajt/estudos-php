<?php
require_once './2-active-record/Produto.php';

try {
    //* Iniciando conexão
    $conn = new PDO("mysql: host=127.0.0.1;
                            port=8080;
                            dbname=estoque",
        "root",
        "root"
    );
    //* Definindo a conexão para a classe
    Produto::setConnection($conn);
    //* Definindo retorno de erro
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    //? Consulta e apagando
    // foreach(Produto::all() as $produto){
    //     $produto->delete();
    // }

    //? Novo produto
    $produto = new Produto;
        $produto->descricao = 'Vinho';
        $produto->estoque = 10;
        $produto->preco_custo = 12;
        $produto->preco_venda = 18;
        $produto->codigo_barras = '123123123';
        $produto->data_cadastro = date('Y-m-d');
        $produto->origem = 'N';
    $produto->save();

    //? Buscando produto
    $outro = Produto::find(1);
    print "Descricao: {$outro->descricao} <br>";
    print "Lucro: {$outro->getMargemLucro()} <br>";
    $outro->registraCompra(14, 5);
    $outro->save();
} catch (Exception $e) {
    print $e->getMessage();
}