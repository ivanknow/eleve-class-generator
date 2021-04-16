<?php
namespace App\Converter\slim_framework;


use App\Converter\AbstractConverter;


class ConverterSlimRoutes extends AbstractConverter{
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

		$result = "\n\n".' /*include on routes.php*/ ';
		$result .= "\n".'$app->group(\'/'.strtolower($this->payload->name).'\', function (Group $group) {';
		$result .= "\n".'$group->get(\'\', List'.$this->payload->name.'sAction::class);';
		$result .= "\n".'$group->get(\'/{id}\', View'.$this->payload->name.'Action::class);';
		$result .= "\n".'$group->post(\'\', Create'.$this->payload->name.'Action::class);';
		$result .= "\n".'$group->put(\'/{id}\', Update'.$this->payload->name.'Action::class);';
		$result .= "\n".'$group->delete(\'/{id}\', Delete'.$this->payload->name.'Action::class);';
		$result .= "\n".'});'."\n";
		
		return $result;
	}
    
}

?>