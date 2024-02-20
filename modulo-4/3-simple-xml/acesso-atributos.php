<?php
//! Acessando atributo de uma tag
$xml = simplexml_load_file('exemplo4.xml');

//? Acessando os atributos
foreach($xml->estados->estado as $estado){
    print "Nome: {$estado['nome']}, Capital: {$estado['capital']}<br>";
}

echo '<br>';

//? Percorrendo de forma dinâmica
foreach($xml->estados->estado as $estado){
    foreach($estado->attributes() as $key => $value){
        print "{$key}: {$value} ";
    }
    echo '<br>';
}