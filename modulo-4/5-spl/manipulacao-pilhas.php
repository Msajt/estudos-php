<?php
$ingredientes = new SplStack; //* Criando uma pilha

$ingredientes->push('Peixe');
$ingredientes->push('Sal');
$ingredientes->push('Limão');

foreach($ingredientes as $item) print $item . '<br>'; //* Retorna valores do ultimo ao primeiro item

print $ingredientes->count();
echo '<br>';
print $ingredientes->pop(); //* Remove o ultimo elemento