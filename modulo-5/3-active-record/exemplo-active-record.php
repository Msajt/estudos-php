<?php
require_once 'api/Transaction.php';
require_once './api/LoggerTXT.php';
require_once 'api/Connection.php';
require_once 'Record.php';
require_once 'Produto.php';

try {
    Transaction::open('estoque');
    Transaction::setLogger(new LoggerTXT('tmp/logo_novo.txt'));

    $p1 = new Produto;
    $p1->descricao = "Cerveja";
    $p1->estoque = 50;
    $p1->preco_custo = 8;
    $p1->preco_venda = 12;
    $p1->codigo_barras = '123123123';
    $p1->origem = 'N';
    $p1->store();

    Transaction::close();
} catch (Exception $e) {
    $e->getMessage();
}