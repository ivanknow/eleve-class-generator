<?php
namespace App\metadata;

use App\Conversor\PHP\ConversorPHPEleve;
use App\Conversor\PHP\ConversorPHPDAO;

class MetadataHandler {

    private $converters = [];

    public function __construct($array) {
        $this->converters [] = 
        array("php"=>
            array("class"=>new ConversorPHPEleve()),
            array("dao"=>new ConversorPHPDAO())
        );
    }
	
    
}

?>