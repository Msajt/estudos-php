<?php

spl_autoload_register([new LibraryLoader, 'loadClass']);
spl_autoload_register([new ApplicationLoader, 'loadClass']);

class LibraryLoader
{
    public static function loadClass($class)
    {
        if(file_exists("Lib/{$class}.php")){
            require_once "Lib/{$class}.php";
            return true;
        }
    }
}

class ApplicationLoader
{
    public static function loadClass($class)
    {
        if(file_exists("App/{$class}.php")){
            require_once "App/{$class}.php";
            return true;
        }
    }
}

var_dump(new Pessoa); //? Vai primeiro executar a primeira classe, depois a proxima