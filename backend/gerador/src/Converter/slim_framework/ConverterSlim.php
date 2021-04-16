<?php
namespace App\Converter\slim_framework;


use App\Converter\AbstractConverter;
use App\Converter\slim_framework\ConverterSlimRoutes;
use App\Converter\slim_framework\ConverterSlimRepo;
use App\Converter\slim_framework\ConverterSlimDomain;
use App\Converter\slim_framework\ConverterSlimDBInjection;


class ConverterSlim extends AbstractConverter{
 	private $payload;
	public function defineInputs(){
		
	}

	public function setup($classRep){
		$this->payload = $classRep;
	}

	public function process($entity){
		$this->	setup($entity);
		return $this->generate();
	}

	public function generate(){

		$result = ' /*SLIM*/ ';
		$converterSlimRoutes = new ConverterSlimRoutes();
		$result .= $converterSlimRoutes->process($this->payload);
		$converterSlimRepo = new ConverterSlimRepo();
		$result .= $converterSlimRepo->process($this->payload);
		$converterSlimDomain = new ConverterSlimDomain();
		$result .= $converterSlimDomain->process($this->payload);
		$converterSlimDBInjection = new ConverterSlimDBInjection();
		$result .= $converterSlimDBInjection->process($this->payload);
		
		
		return $result;
	}
    
}

?>