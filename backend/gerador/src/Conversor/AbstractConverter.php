<?php
namespace App\Conversor;

abstract class AbstractConverter {


    public $payload;
    
    abstract public function proccess($payload);
    

}