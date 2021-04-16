<?php
namespace App\Converter\slim_framework;


use App\Converter\AbstractConverter;
use App\Converter\slim_framework\domain\ConverterDomainClass;


class ConverterSlimDomain extends AbstractConverter{
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

		$result  = "<hr/>\n /*DOMAIN CLASS IMPL*/ \n\n ";
		
		$converterDomainClass = new ConverterDomainClass();
		$result .= $converterDomainClass->process($this->payload);

		$result .= "\n /*not found error*/";
		$result .= "\n /*abstract repo class*/";
		
		
		return $result;
	}
    
}

?>