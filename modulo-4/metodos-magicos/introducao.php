<?php
//! =-=-= MÉTODOS MÁGICOS =-=-= !//

//? Método construtor -> __construct(...params)
//? Método destrutor  -> __destruct() | unset - para variáveis internas
//*     Também há um __unset genérico
//? Getter            -> __get($propriedade)  
//*     (método genérico para acessar uma variável privada)
//? Setter            -> __set($prop, $valor) 
//*     (método genérico para mudar o valor de uma variável privada)
//? Caso eu instancie uma propriedade que não exista e tenha um método __set, ele é criado,
//? caso contrário, ele cria uma variável pública
//? isset             -> Verifica se a propriedade tem um atributo inserido
//*     Também há um método genérico para ele: __isset($prop) return $this->prop

//? Recurso de inserir variáveis de uma classe dentro de um array indexado pelo nome da propriedade
//*     Utilizando os métodos genéricos de set, get, isset e unset

//? MÉTODO toString (__toString())
//*     Será acionado sempre que houver um comando de print, echo, etc...
//*     json_encode -> Pega o objeto e passa no formato JSON

//? Clonagem de objetos
//*     Caso eu faça um objeto igual o outro, ele só faz um apontamento pro objeto original por referência
//*     Usando a função 'clone', esse problema será sanado
//*     Para editar os valores do objeto clonado, posso usar o método mágico '__clone()' na classe
//^     produto, nota fiscal, pessoa, etc...

//? Interceptação de chamadas de métodos (call)
//*     No caso de acessar um método que não exista na classe __call($method, $values)
//*     Posso usar de métodos que já existam e executá-los de outra maneira 'call_user_func'
