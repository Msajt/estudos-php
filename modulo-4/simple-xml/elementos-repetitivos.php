<?php
//! Acessando elementos repetitivos
$xml = simplexml_load_file('exemplo3.xml');

//? Acessando por posiçao do item
print $xml->estados->nome[0] . '<br>';
//? Por repetição
foreach($xml->estados->nome as $estado){
    print "Estado: {$estado}<br>";
}