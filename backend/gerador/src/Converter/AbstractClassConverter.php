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

    public function getAttrType($type){

		switch ($type){
			case "int":
				return " = 0";
				break;
			case "String":
			case "blob":
				return "= \"\" ";
				break;
			case "double":
				return "= 0.0";
				break;
			case "date":
				return " = \"0000-00-00 00:00:00\"";
				break;
			case "Object":
				return '= null';
				break;
			case "Array":
				return '= array()';
				break;
				
		}
	}

}