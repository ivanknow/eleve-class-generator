<?php
namespace App\Conversor;

abstract class AbstractConverter {


    public $payload;
    
    abstract public function generateAttr($payload);
    abstract public function generateConstructor($payload);
    abstract public function generateGetSet($payload);
    abstract public function generateEquals($payload);
    abstract public function generateToString($payload);
    abstract public function generateMethod($payload);
    abstract public function generateClass($payload);

}