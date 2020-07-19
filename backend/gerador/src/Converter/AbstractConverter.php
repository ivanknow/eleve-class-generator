<?php
namespace App\Converter;

abstract class AbstractConverter {
    abstract public function defineInputs();
    abstract public function setup($payload);
    abstract public function process($payload);
}