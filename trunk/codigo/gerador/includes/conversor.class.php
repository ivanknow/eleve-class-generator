<?php


class Conversor {
	
	private $retorno = "";
	private $retornoSQL = "";
	private $retornoDAO = "";
	
    private $linguagem;
	
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
	
	
    public function __construct($array) {
	
		$this->linguagem = $array['linguagem'];
		$this->classe = $array['name'];
		$this->classePai = $array['classePai'];
		
			if(isset($array['contrutorPorArray'])){
				$this->construtorArray = true;
			}
			if(isset($array['tostring'])){
				$this->toString =  true;
			}
			if(isset($array['toarray'])){
				$this->toArray = true;
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
	
	public function gerarClasse(){
	
		switch(strtoupper($this->linguagem)){
			case "PHP":
			
				return $this->gerarClassePHP();
				
			default:
				
				return '';
			
		}
	
	}
	
	public function geraConstrutor(){
	
		switch(strtoupper($this->linguagem)){
			case "PHP":
			return $this->geraConstrutorPHP();
			
		}
	
	}
	

	public function geraConstrutorPHP(){
	
		$result = "";

		//construtor
		$result .= "\npublic function __construct(";
		//attr
		
		foreach ($this->atributosNome as $value) {

		$result .= "$".$value.",";
		
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
		
		$result .="\nreturn new ".$this->classe."(";
		
		foreach ($this->atributosNome as $value) {

		$result .= ' $array[\''.$value."'],";
		
		}
		if(count($this->atributosNome)){
		$result = substr_replace($result,'', -1);
		}
		
		
		
		$result .=");\n";
		
		$result .= "\n}\n";
		
		}
		
		
		return $result;
		
	
	}
	
	public function gerarClasseDAO(){
	
		switch(strtoupper($this->linguagem)){
			case "PHP":
				return 	$this->gerarClasseDAOPHP();
			default:
				return "";
		}
	
	}
	
	/*TODO*/
	private function gerarClassePHP(){
	
	//$this->retorno += "";
	
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
	
	//métodos extras
	
	//equals
	
	//toString
	
	//toArray
	
	$result .= "\n}\n";
	
	return $result;
	
	}
	/*TODO*/
	public function gerarSQL(){
	
	$this->retornoSQL += "";
	
	}
	/*TODO*/
	private function gerarClasseDAOPHP(){
	
	$this->retornoDAO += "";
	
	}
	
	
	public function geraGetAndSet(){
	switch(strtoupper($this->linguagem)){
			case "PHP":
				return	$this->geraGetAndSetPHP();
			
			default:
				return "";
		}
	}
	
	public function geraAttr(){
	switch(strtoupper($this->linguagem)){
			case "PHP":
				return	$this->geraAttrPHP();
			default:
				return "";
		}
	}
	
	private function geraGetAndSetPHP(){
	
	$result = "";
	
		foreach ($this->atributosNome as $value) {

		$result .= "\npublic function get".ucfirst($value)."(){\n";
	
		$result .='return $this->'.$value.";";

		$result .="\n}\n";
	
		$result .= "\npublic function set".ucfirst($value)."($".$value."){\n";
	
		$result .=' $this->'.$value.'=$'.$value.";";
	
		$result .="\n}\n";
		
		}

		
		
		return $result; 
	
	}
	
	private function geraAttrPHP(){
	
	$result = "";
	
		foreach ($this->atributosNome as $value) {
			
			$result .= "\nprivate $".$value.";";
		}
		
		return $result; 
	
	}
	
	
	

    
}

?>