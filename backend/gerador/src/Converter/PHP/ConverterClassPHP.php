<?php
namespace App\Converter\PHP;
use App\Converter\AbstractClassConverter;

class ConverterClassPHP extends AbstractClassConverter{
	
	private $outcome = "";
	
	
	private $className;
	private $parentClass;

    private $arrayContructor;
	private $destrutor = true;
	private $toString;
    private $toArray;
	private $equals;
	private $attrs;

	public function process(){
		return $this->	generateClass();
	}

	public function generateClass(){
	
		$result = "";
		$result .= "\nclass ".$this->className;
		
		if($this->parentClass!=""){
			$result .= " extends ".$this->parentClass;
		}
		
		$result .= "{\n";
		//ATTR
		$result .= $this->generateAttr();
		//Construtor
		$result .= $this->generateConstructor();
		//Get and Set
		$result .= $this->generateGetAndSet();
		//metodos extras
	
		//equals
		if($this->equals){
		$result .= $this->generateEquals();
		}
		//toString
		if($this->toString){
		$result .= $this->generateToString();
		}
		
		if($this->toString){
			$result .= $this->generateJsonSerialize();
		}
		
		
		$result .= "\n}\n";
		
		return $result;
		}
	
	private function getAttrType($type){

		switch ($type){
			case "int":
				return " = 0";
				break;
			case "string":
			case "blob":
				return "= \"\" ";
				break;
			case "number":
				return "= 0.0";
				break;
			case "date":
				return " = \"0000-00-00 00:00:00\"";
				break;
			case "object":
				return '= null';
				break;
			case "Array":
				return '= array()';
				break;
				
		}
	}
	
	
    public function __construct($classRep) {
	
		$this->className = $classRep->name;
		$this->parentClass = $classRep->parentClass;
		
			if(isset($classRep->settings['arrayContructor'])){
				$this->arrayContructor = true;
			}
			if(isset($classRep->settings['toString'])){
				$this->toString =  true;
			}
			
			if(isset($classRep->settings['equals'])){
				$this->equals = true;
			}
			
		if(count($classRep->attrs))
		$this->attrs = $classRep->attrs;
	}
			   
    
	
	public function generateConstructor(){
	
		$result = "";

		//construtor
		$result .= "\npublic function __construct(";
		//attr
		
		foreach ($this->attrs as $key => $attr) {

		$result .= "$".$attr->name;
		
			$result .= $this->getAttrType($attr->type);

		$result .= ",";
		
		}
		
		//remove ultima virgula
		
		if(count($this->attrs)){
		$result = substr_replace($result,'', -1);
		}
		
		$result .= "){\n";
		
		//atribui valores
		
		foreach ($this->attrs as $attr) {

		$result .= '$this->'.$attr->name." = $".$attr->name.";\n";
		
		}
		
		$result .= "\n}\n";
		
		//destrutor 
		/*TODO*/
		
		
		//contrutor por array

		if($this->construtorArray){
		$result .= "\npublic".' static function construct($array){';
		
		$result .="\n".'$obj'." = new ".$this->className."();\n";
		
		foreach ($this->attrs as $attr) {

		$result .= '$obj->set'.ucfirst($attr->name).'( $array[\''.$attr->name."']);\n";
		
		}
		if(count($this->attrs)){
		$result = substr_replace($result,'', -1);
		}
		
		$result .="\nreturn ".'$obj'.";\n";
		
		$result .= "\n}\n";
		
		}
		
		
		return $result;
		
	
	}
	
	
	
	public function generateGetAndSet(){
	
	$result = "";
	
		foreach ($this->attrs as $attr) {

		$result .= "\npublic function get".ucfirst($attr->name)."(){\n";
	
		$result .='return $this->'.$attr->name.";";

		$result .="\n}\n";
	
		$result .= "\npublic function set".ucfirst($attr->name)."($".$attr->name."){\n";
	
		$result .=' $this->'.$attr->name.'=$'.$attr->name.";";
	
		$result .="\n}\n";
		
		
		}

		return $result; 
	
	}
	
	public function generateAttr(){
	
	$result = "";
	
		foreach ($this->attrs as $attr) {
			
			$result .= "\nprivate $".$attr->name.";";
		}
		
		return $result; 
	
	}
	
	public function generateEquals(){
	$result = "public function equals(".'$object'."){\n";
	$result .= 'if($object instanceof '.$this->className ."){\n";
	
		foreach ($this->attrs as $attr) {
			
			$result .= "\nif(".'$this->'.$attr->name.'!=$object->'.$attr->name.'){';
				$result .= "\nreturn false;\n";
			$result .= "\n}\n";
		}
	
	$result .= "\nreturn true;\n";
	
	$result .= "\n}\n";
	$result .= "else{\nreturn false;\n}\n";
	$result .= "\n}\n";
	
	return $result; 
	}
	
	public function generateToString(){
	$result = "public function toString(){\n\n return \" ";
	
	
		foreach ($this->attrs as $attr) {
			
			

			$result .= " [$attr->name:\" ".'.$this->'.$attr->name.". \"] ";
		

		}
	$result .= " \" ;";
	$result .= "\n}\n";
	
	return $result; 
	}	

	public function generateJsonSerialize(){
		$result = "public function jsonSerialize(){\n\n return [ \n";
	
	
			foreach ($this->attrs as $attr) {
				
				
	
				$result .= " '$attr->name' =>  ".'$this->'.$attr->name.",\n";
			
	
			}
			if(count($this->attrs)){
				$result = substr_replace($result,'', -1);
				$result = substr_replace($result,'', -1);
			}

		$result .= " ] ;";
		$result .= "\n}\n";
		
		return $result; 
	}
    
}

?>