<?php
namespace App\Conversor\PHP;

class ConversorPHPEleve {
	
	private $retorno = "";
	private $retornoSQL = "";
	private $retornoDAO = "";
	
	
	private $classe;
	private $classePai;
	private $sql;
	private $construtor = true;
    private $construtorArray;
	private $destrutor = true;
	private $toString;
    private $toArray;
	private $equals;
	private $atributosNome = array();
	private $atributosTipo = array();
	private $atributosNulos = array();
	
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
	
	
    public function __construct($array) {
	
		$this->classe = $array['name'];
		$this->classePai = $array['classePai'];
		
			if(isset($array['contrutorPorArray'])){
				$this->construtorArray = true;
			}
			if(isset($array['tostring'])){
				$this->toString =  true;
			}
			
			if(isset($array['equals'])){
				$this->equals = true;
			}
			
		if(isset($array['atributeName'])){
		$this->atributosNome = $array['atributeName'] ;
		}
		if(isset($array['atributeType'])){
		$this->atributosTipo = $array['atributeType'];
		}
		if(isset($array['atributeNull'])){
		$this->atributosNulos = $array['atributeNull'];
		}
			   
    }
	
	public function geraConstrutor(){
	
		$result = "";

		//construtor
		$result .= "\npublic function __construct(";
		//attr
		
		foreach ($this->atributosNome as $key => $value) {

		$result .= "$".$value;
		
			$result .= $this->getAttrType($this->atributosTipo[$key]);

		$result .= ",";
		
		}
		
		//remove ultima virgula
		
		if(count($this->atributosNome)){
		$result = substr_replace($result,'', -1);
		}
		
		$result .= "){\n";
		
		//atribui valores
		
		foreach ($this->atributosNome as $value) {

		$result .= '$this->'.$value." = $".$value.";\n";
		
		}
		
		$result .= "\n}\n";
		
		//destrutor 
		/*TODO*/
		
		
		//contrutor por array

		if($this->construtorArray){
		$result .= "\npublic".' static function construct($array){';
		
		$result .="\n".'$obj'." = new ".$this->classe."();\n";
		
		foreach ($this->atributosNome as $value) {

		$result .= '$obj->set'.ucfirst($value).'( $array[\''.$value."']);\n";
		
		}
		if(count($this->atributosNome)){
		$result = substr_replace($result,'', -1);
		}
		
		$result .="\nreturn ".'$obj'.";\n";
		
		$result .= "\n}\n";
		
		}
		
		
		return $result;
		
	
	}
	
	public function gerarClasse(){
	
	$result = "";
	
	
	$result .= "\nclass ".$this->classe;
	
	if($this->classePai!=""){
		$result .= " extends ".$this->classePai;
	}
	
	$result .= "{\n";
	
	//ATTR
	$result .= $this->geraAttr();
	//Construtor
	$result .= $this->geraConstrutor();
	
	//Get and Set
	$result .= $this->geraGetAndSet();
	
	//m�todos extras
	
	//equals
	if($this->equals){
	$result .= $this->geraEquals();
	}
	
	//toString
	if($this->toString){
	$result .= $this->geraToString();
	}
	
	$result .= "\n}\n";
	
	return $result;
	
	}
	/*TODO*/
	public function gerarSQL(){
	
	$this->retornoSQL += "";
	
	}
	/*TODO*/
	public function gerarClasseDAO(){
	
	$this->retornoDAO += "";
	
	}
	
	public function geraGetAndSet(){
	
	$result = "";
	
		foreach ($this->atributosNome as $key => $value) {

		$result .= "\npublic function get".ucfirst($value)."(){\n";
	
		$result .='return $this->'.$value.";";

		$result .="\n}\n";
	
		$result .= "\npublic function set".ucfirst($value)."($".$value."){\n";
	
		$result .=' $this->'.$value.'=$'.$value.";";
	
		$result .="\n}\n";
		
		if($this->atributosTipo[$key] == "array"){
			//TODO get and set item
		}
		
		
		}

		
		
		return $result; 
	
	}
	
	public function geraAttr(){
	
	$result = "";
	
		foreach ($this->atributosNome as $value) {
			
			$result .= "\nprivate $".$value.";";
		}
		
		return $result; 
	
	}
	
	private function geraEquals(){
	$result = "public function equals(".'$object'."){\n";
	$result .= 'if($object instanceof '.$this->classe ."){\n";
	
		foreach ($this->atributosNome as $value) {
			
			$result .= "\nif(".'$this->'.$value.'!=$object->'.$value.'){';
				$result .= "\nreturn false;\n";
			$result .= "\n}\n";
		}
	
	$result .= "\nreturn true;\n";
	
	$result .= "\n}\n";
	$result .= "else{\nreturn false;\n}\n";
	$result .= "\n}\n";
	
	return $result; 
	}
	
	private function geraToString(){
	$result = "public function toString(){\n\n return \" ";
	
	
		foreach ($this->atributosNome as $value) {
			
			

			$result .= " [$value:\" ".'.$this->'.$value.". \"] ";
		

		}
	$result .= " \" ;";
	$result .= "\n}\n";
	
	return $result; 
	}	
    
}

?>