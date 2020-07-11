<?php
namespace App\Converter;
use App\Converter\AbstractConverter;

abstract class AbstractClassConverter extends AbstractConverter{

    
    abstract public function generateAttr();
    abstract public function generateConstructor();
    abstract public function generateGetAndSet();
    abstract public function generateEquals();
    abstract public function generateToString();
    abstract public function generateClass();
    abstract public function generateJsonSerialize();

}