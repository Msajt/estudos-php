<?php
require_once './api/ProdutoTransaction.php';
require_once './api/Connection.php';
require_once './api/Transaction.php';

try {
    Transaction::open('estoque');

    $produto = new ProdutoTransaction;
    $produto->descricao = 'Chocolate amargo';
    $produto->estoque = 80;
    $produto->preco_custo = 4;
    $produto->preco_venda = 7;
    $produto->codigo_barras = '567567567';
    $produto->data_cadastro = date('Y-m-d');
    $produto->origem = 'N';
    $produto->save();

    Transaction::close();
} catch (Exception $e) {
    Transaction::rollback();
    print $e->getMessage();
}