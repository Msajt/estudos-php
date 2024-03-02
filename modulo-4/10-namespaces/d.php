<?php
require_once 'application.php';
require_once 'components.php';

use Application\Form as X; //* Posso dar outro nome para a classe
use Application\Field as Field; //* Default
use Components\Form as Y; //* Cuidado ao usar duas classes de mesmo nome em namespaces diferentes

//new \Application\Form;
new X;
new Field;
new Y;