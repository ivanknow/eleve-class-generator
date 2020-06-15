<?php
namespace App\Conversor;

abstract class AbstractClassConverter extends AbstractConverter{


    public $payload;
    
    abstract public function generateAttr($payload);
    abstract public function generateConstructor($payload);
    abstract public function generateGetSet($payload);
    abstract public function generateEquals($payload);
    abstract public function generateToString($payload);
    abstract public function generateMethod($payload);
    abstract public function generateClass($payload);

    public function proccess($payload){
    $result = "";
    $result +=generateAttr($payload);
    $result +=generateConstructor($payload);
    $result +=generateGetSet($payload);
    $result +=generateEquals($payload);
    $result +=generateToString($payload);
    $result +=generateMethod($payload);
    $result +=generateClass($payload);
    return $result;
    }

}