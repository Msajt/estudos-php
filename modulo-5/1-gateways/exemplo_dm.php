<?php
    require_once './3-data-mapper/Produto.php';
    require_once './3-data-mapper/Venda.php';
    require_once './3-data-mapper/VendaMapper.php';


try{
    //* Iniciando conexão
    $conn = new PDO("mysql: host=127.0.0.1;
                            port=8080;
                            dbname=estoque",
        "root",
        "root"
    );
    //* Definindo a conexão para a classe
    VendaMapper::setConnection($conn);
    //* Definindo retorno de erro
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $p1 = new Produto;
    $p1->id = 1;
    $p1->preco = 12;

    $p2 = new Produto;
    $p2->id = 2;
    $p2->preco = 15;

    $venda = new Venda;
    $venda->addItem(12, $p1);
    $venda->addItem(20, $p2);

    VendaMapper::save($venda);



}catch(Exception $e){
    print $e->getMessage();
}