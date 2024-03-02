//! NAMESPACES
//? É uma separação lógico ao redor de uma classe, interface, função
//? Permitem classes de mesmo nome, em espaços diferentes
//? Cria um isolamento lógico para evitar conflitos de nomes
//? (Componentes) e (Entidades)

<?php
//! Declarando um 'namespace'
// namespace Application;
// class Form
// {

// }

// namespace Components;
// class Form
// {

// }

//? No caso as duas classes são diferentes, uma pertence a Application e a outra Components
new Form; //* Vai relacionar com Components, pois foi o ultimo a ser declarado no arquivo
new \Components\Form; //* Declarando de forma explicita (boa prática)
new \Application\Form;
new \SplFileInfo; //* Dessa forma evita de ligar com o namespace do arquivo

//! Não use mais de um namespace em um arquivo

//! Estrutura dos diretórios
//? Namespace/Subname/Class.php

//? Carregamento automático de classes (autoload)
spl_autoload_register(function($class){
    require_once(str_replace("\\", '/', $class) . '.php');
});