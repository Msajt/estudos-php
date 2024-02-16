<?php
//! Biblioteca > SimpleXML <
//? Carregando arquivo xml
$xml = simplexml_load_file('exemplo.xml');

//* Exibindo o conteúdo
echo '<pre>';
var_dump($xml);
print '<br>';
//* Acessando conteudos diretamente
print "Nome: {$xml->nome}<br>";
print "Idioma: {$xml->idioma}<br>";
print "Capital: {$xml->capital}<br>";
print "Moeda: {$xml->moeda}<br>";
print "Prefixo: {$xml->prefixo}<br><br>";
//* Percorrendo de forma dinamica
foreach($xml->children() as $elemento => $valor){
    print "{$elemento}: $valor <br>";
}

