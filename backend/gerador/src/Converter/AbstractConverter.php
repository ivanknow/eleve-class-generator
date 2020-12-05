<?php
namespace App\Converter;

abstract class AbstractConverter {
    abstract public function defineInputs();
    abstract public function setup($payload);
    abstract public function process($payload);

    public function tag($tag,$content,$tagAttrs=[]){
		$returned =  "&lt".$tag;
		foreach ($tagAttrs as $key => $tagAttr) {
			$returned .= "".$key."='".$tagAttr."'";
		}
		$returned .= "&gt\n";
		$returned .= $content."\n";
		$returned .= "&lt/".$tag."&gt\n";
        return $returned;
	}
}