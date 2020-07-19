<?php
namespace App\Domain;
use JsonSerializable;

class Attr implements JsonSerializable{
	
	public $id;
	public $name = "";
	public $type = "";
	public $nullable = true;

	public function __construct(?int $id, string $name, string $type, $nullable){
		$this->id = $id;
		$this->name = $name;
		$this->type = $type;
		$this->nullable = $nullable;
	}

	public function jsonSerialize(){
		return [
			'id'=>	$this->id,
			'name' =>$this->name ,
			'type'=> $this->type,
			'nullable'=>$this->nullable 
		];
	}

}