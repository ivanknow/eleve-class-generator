<?php
namespace App\Conversor;

abstract class AbstractConverter {


    public $payload;
    
    abstract public function proccess($payload);
    
    public function build($array){
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

}