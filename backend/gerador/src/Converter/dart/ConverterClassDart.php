<?php
namespace App\Converter\dart;
use App\Converter\AbstractClassConverter;

class ConverterClassDart extends AbstractClassConverter{
	
	private $outcome = "";
	
	
	private $className;
	private $parentClass;

    private $arrayContructor;
	private $destrutor = true;
	private $toString;
    private $toArray;
	private $equals;
	private $attrs = [];

	public function defineInputs(){

	}

	public function setup($classRep){
		
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
	public function process($payload){
		$this->setup($payload);
		return $this->generateClass();
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
	
	
	
    public function __construct() {
	
	}
			   
    
	
	public function generateConstructor(){
	
		$result = "";

		//construtor
		$result .= "\n".$this->className."(";
		//attr
		
		foreach ($this->attrs as $key => $attr) {

		$result .= "this._".$attr->name;

		$result .= ",";
		
		}
		
		//remove ultima virgula
		
		if(count($this->attrs)){
		$result = substr_replace($result,'', -1);
		}
		
		$result .= ");\n";
		
		return $result;
		
	
	}
	
	
	
	public function generateGetAndSet(){
	
	$result = "";
	
		foreach ($this->attrs as $attr) {

		$result .= "\n".$attr->type." get ".$attr->name." _".$attr->name.";\n";
	
		$result .= "\nset ".$attr->name."(".$attr->type." new".ucfirst($attr->name)."){\n";
	
		$result .=' this._'.$attr->name." = new".ucfirst($attr->name).";";
	
		$result .="\n}\n";
		
		}

		return $result; 
	
	}
	
	public function generateAttr(){
	
	$result = "";
	
		foreach ($this->attrs as $attr) {
			
			$result .= "\n".$attr->type." _".$attr->name.";";
		}
		
		return $result; 
	
	}
	
	public function generateEquals(){
	$result = "@override\n";
	$result .= "bool equals(Object? e1, Object? e2) => e1 == e2;\n";
	
	return $result; 
	}
	
	public function generateToString(){
	$result = "String toString(){\n\n return \" ";
	
	
		foreach ($this->attrs as $attr) {

			$result .= " [$attr->name:\" ".'.this._'.$attr->name.". \"] ";
		}

	$result .= " \" ;";
	$result .= "\n}\n";
	
	return $result; 
	}	

	public function generateJsonSerialize(){

	
		$result = "\n\nMap<String, dynamic> toMap() { \n";
		$result .= "var map = Map<String, dynamic>(); \n";
		
	
			foreach ($this->attrs as $attr) {
				$result .= "  map['$attr->name'] =  ".'_'.$attr->name.";\n";
			}
			if(count($this->attrs)){
				$result = substr_replace($result,'', -1);
				
			}

		$result .= "\n return map;";
		$result .= "\n}\n";

		$result .= "\n\nTodo.fromObject(dynamic map) { \n";
			foreach ($this->attrs as $attr) {
				$result .= "  _'$attr->name' =  ".'map['.$attr->name."];\n";
			}
			if(count($this->attrs)){
				$result = substr_replace($result,'', -1);
				
			}
		$result .= "\n}\n";
		return $result; 
	}
    
}

?>