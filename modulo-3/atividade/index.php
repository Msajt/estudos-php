<?php
//! Centralizando todas as funcionalidades dos códigos no arquivo 'index.php'
//? Verificando se a classe existe para poder inicializar
spl_autoload_register(function ($class) {
    //* Caso exista a classe nos arquivos
    if(file_exists($class.".php")){
        require $class.".php";
    }
});

//? Determina se uma variável está declarada (classe e método da classe)
$classe = isset($_REQUEST['class']) ? $_REQUEST['class'] : null;
$metodo = isset($_REQUEST['method']) ? $_REQUEST['method'] : null;

//? Caso exista a classe no arquivo escolhido
if(class_exists($classe)){
    //* Exibe na página a classe
    $pagina = new $classe($_REQUEST);

    //* Executa o método
    if(!empty($metodo) and method_exists($classe, $metodo)){
        $pagina->$metodo($_REQUEST);
    }

    $pagina->show();
}