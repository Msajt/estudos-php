<?php
//! Alterando valores do documento
$xml = simplexml_load_file('exemplo2.xml');

//? Alterando valor
$xml->moeda = "Novo Real (NR$)";
$xml->geografia->clima = 'Temperado';
//? Adicionando novo valor (tag, valor)
$xml->addChild('presidente', 'Chapolin Colorado');
//? Salvando arquivo com os novos valores (apenas na execução, não muda o arquivo ainda)
echo $xml->asXML();
//? Salvando o arquivo
file_put_contents('exemplo2.xml', $xml->asXML());