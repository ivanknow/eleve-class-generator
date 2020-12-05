<?php

declare(strict_types=1);

use App\Conversor\PHP\ConversorPHPEleve;
use App\Conversor\PHP\ConversorPHPSearch;
use App\Conversor\PHP\ConversorDAOPHP;

use App\Converter\PHP\ConverterClassPHP;
use App\Converter\html\ConverterHTMLForm;
use App\Converter\dart\ConverterClassDart;

use App\Domain\ClassRepresentation;
use App\Builder\ClassRepresentationBuilder;

require __DIR__ . '/vendor/autoload.php';



if(isset($_POST) && count($_POST)){
	if(isset($_GET['type'])){
		print_r(json_decode($_POST['fullJson'],true));
		$classRep = ClassRepresentationBuilder::buildFromJson(json_decode($_POST['fullJson'],true));
	}else{
		$classRep = ClassRepresentationBuilder::buildFromForm($_POST);
	}

$results = [];

$newConverterPHP = new ConverterClassPHP();
$results['php'] =  $newConverterPHP->process($classRep);

$newConverterHTMLForm = new ConverterHTMLForm();
$results['html'] = $newConverterHTMLForm->process($classRep);

$newConverterDart = new ConverterClassDart();
$results['dart'] = $newConverterDart->process($classRep);


echo "<div class='resultWrapper well'>";

print_r(json_encode($classRep,JSON_PRETTY_PRINT));

echo "</div>";



echo "<ul class=\"nav nav-tabs\" id=\"resultTab\">";
foreach($results as $index => $result) {
	echo "<li class=\"\" '> <a href=\"#tab-".$index."\" data-toggle=\"tab\">".$index."</a></li>";
	
  }
  echo "</ul>";

echo "<div class=\"tab-content\">";

foreach($results as $index => $result) {
	
	echo "<div class='resultWrapper well tab-pane ' id='tab-".$index."'>";
	echo "<h2>".$index."</h2>";
	echo $result;
	echo "</div>";
  }
echo "</div>";
}
else{

	echo "Acesso Invedido";
}

?>