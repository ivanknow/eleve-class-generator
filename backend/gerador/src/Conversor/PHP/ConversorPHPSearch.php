<?php
namespace App\Conversor\PHP;

class ConversorPHPSearch {
	
	private $retorno = "";
	
	private $classe;
	private $construtor = true;

	private $atributosNome = array();
	
    public function __construct($array) {
	
		$this->classe = $array['name'];
					
		if(isset($array['atributeName'])){
		$this->atributosNome = $array['atributeName'] ;
		}
			   
    }
	
	public function geraConstrutor(){
	
		$result = "";

		$result .= "\npublic function __construct(";
		
		$result .= "){\n";
		
		$result .= "\n}\n";
		
		return $result;
		
	
	}
	
	public function gerarClasse(){
	
	$result = "";
	
	
	$result .= "\nclass ".$this->classe."Pesquisa";
	
		$result .= " extends ObjetoSerializavel";
	
	$result .= "{\n";
	
	//ATTR
	$result .= $this->geraAttr();
	//Construtor
	$result .= $this->geraConstrutor();
	
	$result .= "\n}";
	return $result;
	}	
	public function geraAttr(){
	
	$result = "";
	
		foreach ($this->atributosNome as $value) {
			
			$result .= "\npublic $".$value.";";
			$result .= "\npublic $".$value."Min;";
			$result .= "\npublic $".$value."Max;";
		}
		
		return $result; 
	
	}

}

?>