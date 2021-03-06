<?php
namespace App\Builder;

use App\Domain\ClassRepresentation;
use App\Domain\Attr;

class ClassRepresentationBuilder {

    public static function buildFromJson($json_object){


        $attrs = [];
        if($json_object['attrs'])    
        foreach($json_object['attrs'] as $index => $attr ){
            $attrObj = new Attr($attr['id'],$attr['name'],$attr['type'],$attr['nullable']);
            $attrs[] = $attrObj;
        }
        
        $settings = $json_object["settings"];
    
        $classRep = new ClassRepresentation(0,$json_object['name'],$json_object['parentClass'], $attrs, $settings);
        
        return $classRep;
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
    if(isset($array['atributeName']))    
    foreach($array['atributeName'] as $index => $attrName ){
        $attrObj = new Attr(0,$attrName,$array['atributeType'][$index],$array['atributeNull'][$index]);
        $attrs[] = $attrObj;
    }
    
    $settings = []; 
    $settings ['toString'] = isset($array['tostring'])?$array['tostring']:false;
    $settings['arrayConstructor'] =  isset($array['contrutorByArray'])?$array['contrutorByArray']:false;
    $settings ['equals'] = isset($array ['equals'])?$array ['equals']:false;
    $settings['DAO'] = isset($array['DAOPHP'])?$array['DAOPHP']:"";
    $settings['table'] = isset($array['tabela'])?$array['tabela']:"";

    $classRep = new ClassRepresentation(0,$array['name'],$array['classePai'], $attrs, $settings);
    
    return $classRep;
    }
}