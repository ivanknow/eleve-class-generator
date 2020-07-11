<?php
namespace App\Domain;

class ClassRepresentation {
	
	public $id;
	public $name;
	public $parentClass = "";
	public $attrs = [];
	public $settings = [];
	
	public function __construct(?int $id, string $name, string $parentClass, $attrs = [],$settings = []){
		$this->id = $id;
		$this->name = $name;
		$this->parentClass = $parentClass;
		$this->attrs = $attrs;
		$this->settings = $settings;
	}

	public function jsonSerialize(){
		return [
			'id'=>	$this->id,
			'name' =>$this->name ,
			'parentClass'=> $this->parentClass,
			'attrs'=>$this->attrs,
			'settings'=>$this->settings,
		];
	}
}