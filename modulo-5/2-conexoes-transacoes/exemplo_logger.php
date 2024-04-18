<?php
require_once './api/ProdutoTransactionLog.php';
require_once './api/Connection.php';
require_once './api/Transaction.php';
require_once './api/Logger.php';
require_once './api/LoggerTXT.php';

try {
    Transaction::open('estoque');
    Transaction::setLogger(new LoggerTXT('teste.txt'));

    $produto = new ProdutoTransactionLog;
    $produto->descricao = 'Chocolate ao  leite'; 
    $produto->estoque = 70;
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