<?php
namespace App\Converter\slim_framework;


use App\Converter\AbstractConverter;


class ConverterSlimDBInjection extends AbstractConverter{
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

		$result  = "\n /* include on repositories.php */ \n";
		$result .= "\n ".$this->payload->name.'Repository::class => \DI\autowire(SQLite'.$this->payload->name.'Repository::class),'."\n";
		
		return $result;
	}
    
}

?>