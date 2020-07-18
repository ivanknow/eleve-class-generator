<?php
namespace App\Builder;

use App\Domain\ClassRepresentation;
use App\Domain\Attr;

class ClassRepresentationBuilder {

    public static function buildFromJson($json){

        /*
        TODO
        {
    "id": 0,
    "name": "Person",
    "parentClass": "AbstractObject",
    "attrs": [
        {
            "id": 0,
            "name": "id",
            "type": "int",
            "nulable": "false"
        },
        {
            "id": 0,
            "name": "name",
            "type": "string",
            "nulable": "true"
        },
        {
            "id": 0,
            "name": "birthDay",
            "type": "date",
            "nulable": "true"
        }
    ],
    "settings": {
        "tostring": "true",
        "contrutorPorArray": "true",
        "equals": "true",
        "DAOPHP": "true",
        "tabela": "tb_person"
    }
}
        */
    }

    public static function buildFromForm($array){

    $attrs = [];
    if($array['atributeName'])    
    foreach($array['atributeName'] as $index => $attrName ){
        $attrObj = new Attr(0,$attrName,$array['atributeType'][$index],$array['atributeNull'][$index]);
        $attrs[] = $attrObj;
    }
    
    $settings = []; 
    $settings ['toString'] = $array['tostring'];
    $settings['arrayConstructor'] =  $array['contrutorPorArray'];
    $settings ['equals'] = $array ['equals'];
    $settings['DAO'] = $array['DAOPHP'];
    $settings['table'] = $array['tabela'];

    $classRep = new ClassRepresentation(0,$array['name'],$array['classePai'], $attrs, $settings);
    
    return $classRep;
    }
}