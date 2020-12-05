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
	private $attrs = [];
	
	public function tag($tag,$content,$tagAttrs){
		$returned =  "&lt".$tag;
		foreach ($this->tagAttrs as $key => $tagAttr) {
			$returned .= "".$key."='".$tagAttr."'";
		}
		$returned .= "&gt";
		$returned .= $content;
		$returned .= "&lt/".$tag."&gt";

	}

	public function defineInputs(){
		
	}

	public function process($entity){
		$this->	setup($entity);
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
	
	
    public function __construct() {
		
	}
	
	public function setup($entity) {
		$this->className = $entity->name;				
		if(count($entity->attrs))
		$this->attrs = $entity->attrs;
	}
    
	
	public function generateTableTop(){
	
		$this->tag("table",
		$this->tag("tr",
		$this->tag("td","Test")));
		$result = "&ltform action='#' method='POST'&gt \n";
		$result .= "&ltH1&gt".ucfirst($this->className)."&lt/H1&gt";
		
		return $result;
		
	
	}
	
	
	
	public function generateFields(){
	

		$result="";
		foreach ($this->attrs as $attr) {

		$result .= "\n &ltlabel for='".$attr->name."'&gt ".$attr->name."&lt/label&gt : ";
		$result .= "  &ltinput name='".$attr->name."'/&gt \n";
	
		
		}

		return $result; 
	
	}
	
	public function generateTableBottom(){
	
	$result = "&ltbutton&gt Submit &lt/button&gt";
	$result .= "\n&lt/form&gt";
	return $result; 	
	
	}
	
    
}

?>