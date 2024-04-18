<?php
require_once '../1-gateways/2-active-record/Produto.php';
require_once './api/Connection.php';

try {
    $conn = Connection::open('estoque');
    Produto::setConnection($conn);

    $produto = new Produto;
    $produto->descricao = 'Café';
    $produto->estoque = 100;
    $produto->preco_custo = 4;
    $produto->preco_venda = 7;
    $produto->codigo_barras = '123123123';
    $produto->data_cadastro = date('Y-m-d');
    $produto->origem = 'N';
    $produto->save();

} catch (Exception $e) {
    print $e->getMessage();
}