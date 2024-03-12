<?php
//! Carregar automaticamente as classes de um projeto
//? Formas alternativas

spl_autoload_register(function($class){
    if(file_exists("{$class}.php")){
        require_once "{$class}.php";
        return true;
    }
});

//? Ao definir a função de autoload de uma classe posso dar require_once apenas nesse arquivo
//? encarregado de procurar pelas funções do arquivo
var_dump(new Pessoa);
// new Produto;
// new Cliente;