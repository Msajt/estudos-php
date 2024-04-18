<?php

class LoggerTXT extends Logger
{
    public function write($msg){
        $text = date('Y-m-d H:i:s'). ':' . $msg;
        $handler = fopen($this->filename, 'a');
        fwrite($handler, $text);
        fclose($handler);
    }
}