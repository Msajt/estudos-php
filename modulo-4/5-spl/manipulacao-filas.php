<?php
$ingredientes = new SplQueue(); //* Criando uma fila

//? Adicionando uma fila
$ingredientes->enqueue('Peixe');
$ingredientes->enqueue('Sal');
$ingredientes->enqueue('Limão');

foreach($ingredientes as $item){
    print $item;
}
echo '<br>';
print $ingredientes->count(); //* Numero de itens
echo '<br>';
print $ingredientes->dequeue(); //* Tira o primeiro item
echo '<br>';