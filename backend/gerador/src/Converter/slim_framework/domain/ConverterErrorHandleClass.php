<?php
namespace App\Converter\slim_framework\domain;


use App\Converter\AbstractConverter;


class ConverterErrorHandleClass extends AbstractConverter{
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

		$result  = "\n\n declare(strict_types=1);";
		
		$result .= "\n\n namespace App\Domain\\".$this->payload->name. ";";

		$result .= "\n\n use App\Domain\DomainException\DomainRecordNotFoundException;";

		$result .= "\n\nclass ".$this->payload->name."NotFoundException extends DomainRecordNotFoundException";
		
		$result .= "\n{";
			$result .=	'public $message = \'The '.$this->payload->name.' you requested does not exist.\';';
		$result .= "\n}";

		return $result;
	}
    
}

?>