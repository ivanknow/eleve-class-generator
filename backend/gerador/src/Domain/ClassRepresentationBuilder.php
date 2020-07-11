<?php
namespace App\Domain;

use App\Domain\ClassRepresentation;
use App\Domain\Attr;

class ClassRepresentationBuilder {
    public static function buildFromForm($array){

    $attrs = [];

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