<?php
namespace App\Converter\slim_framework;


use App\Converter\AbstractConverter;


class ConverterSlimRepo extends AbstractConverter{
 	private $payload;
	public function defineInputs(){
		
	}

	public function setup($classRep){
		$this->payload = $classRep;
	}

	public function process($entity){
		$this->	setup($entity);
		return $this->	generate();
	}

	public function generate(){

		$result  = "\n /*REPO CLASS*/ ";
		$result  .= "\n /*REPO IMPL CLASS*/ ";
		
		return $result;
	}
    
}

?>