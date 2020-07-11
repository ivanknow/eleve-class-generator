<?php
namespace App\Converter\html;
use App\Converter\AbstractConverter;

class ConverterHTMLForm extends AbstractConverter{
	
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
		return $this->	generate();
	}

	public function generate(){
	
		$result = "";
		
		$result .= $this->generateFormTop();
		//Construtor
		$result .= $this->generateFields();
		//Get and Set
		$result .= $this->generateFormBottom();
		
		
		$result .= "\n\n";
		
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
	
	
    public function __construct($entity) {
	
		$this->className = $entity->name;				
		if(count($entity->attrs))
		$this->attrs = $entity->attrs;
	}
			   
    
	
	public function generateFormTop(){
	
		$result = "&ltform action='#' method='POST'&gt \n";
		$result .= "&ltH1&gt".ucfirst($this->className)."&lt/H1&gt";
		
		return $result;
		
	
	}
	
	
	
	public function generateFields(){
	

	
		foreach ($this->attrs as $attr) {

		$result .= "\n ".$attr->name." : &ltinput name='".$attr->name."'/&gt \n";
	
		
		}

		return $result; 
	
	}
	
	public function generateFormBottom(){
	
	$result = "&ltbutton&gt Submit &lt/button&gt";
	$result .= "&lt/form&gt";
	return $result; 	
	
	}
	
    
}

?>