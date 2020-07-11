<?php
namespace App\Conversor\PHP;

class ConversorPHPDAO {
	
	private $retorno = "";
	
	private $classe;
	private $classePai;
	private $sql;
	private $construtor = true;
	private $destrutor = true;
	private $atributos = array();
	private $metodos = array(
			"mapear","validarTipo","validarTipoPesquisa",
			"criarObjeto");
	
	private $tabela;
	
    public function __construct($array) {
	
		$this->classe = $array['name'];
		$this->tabela = $array['tabela'];
			   
    }
	
	public function geraConstrutor(){
	
		$result = "";

		//construtor
		$result .= "\npublic function __construct(";
		
		$result .= "){\n";
		
			//$result .= "\n".' $this->conn '." = new CONEXAO();\n";
		
		
		$result .= "\n".' $this->setConn( '."new ConnectionMySQLPDO());\n";
		$result .= "\n".'$this->setTableName("'.$this->tabela.'");'."\n";
		
		$result .= "\n}\n";
		
		return $result;

	}
	
	
	public function gerarClasse(){
	
	$result = "";
	
	
	$result .= "\nclass ".$this->classe."DAO extends AbstractDAO";
	
	
	$result .= "{\n";
	
	//ATTR
	$result .= $this->geraAttr();
	//Construtor
	$result .= $this->geraConstrutor();
	//Get and Set
	$result .= $this->geraGetAndSet();
	//metodos extras
	$result .= $this->geraMetodos();
	
	
	$result .= "\n}\n";
	
	return $result;
	
	}

	
	public function geraGetAndSet(){
	
	$result = "";

	foreach ($this->atributos as $value) {

		$result .= "\npublic function get".ucfirst($value)."(){\n";
	
		$result .="return $this->".$value.";";

		$result .="\n}\n";
	
		$result .= "\npublic function set".ucfirst($value)."($".$value."){\n";
	
		$result .=' $this->'.$value.'=$'.$value.";";
	
		$result .="\n}\n";
		
		}

		return $result; 
	
	}
	
	public function geraAttr(){
	
	$result = "";
	
	foreach ($this->atributos as $value) {
			
		switch ($value){
			case "tableName":
				$result .= "\nprivate $".$value." = '".$this->tabela."';";
			break;
			
			
			default:
				$result .= "\nprivate $".$value.";";
			
		}
			
	
	}
	$result .= "\n\n";
	return $result;

    
}

	public function geraMetodos(){

	$result = "";

	foreach ($this->metodos as $value) {

		if($value == "criarObjeto"){
			$result .= "\npublic function ".$value.'($array){'."\n";
		}else{
			$result .= "\npublic function ".$value.'($obj){'."\n";
		}
		
		switch ($value) {
			case "validarTipo":
				$result .=	'return $obj instanceof '.$this->classe.";\n";
			break;
			case "validarTipoPesquisa":
				$result .=	'return $obj instanceof '.$this->classe."Pesquisa;\n";
			break;
			case "criarObjeto":
				$result .=	'return '.$this->classe.'::construct($array)'.";\n";
			break;
			case "mapear":
				$result .=	'$array = $obj->toArray();'."\n";
				$result .=	'return $array'.";\n";
			break;
			default:
				$result .="\n //TODO \n";
			break;
					
		}


		$result .="\n}\n";
	}

	return $result;

}

}

?>