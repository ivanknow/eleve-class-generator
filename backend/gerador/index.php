<?php

declare(strict_types=1);

use App\Conversor\PHP\ConversorPHPEleve;
use App\Conversor\PHP\ConversorPHPSearch;
use App\Conversor\PHP\ConversorPHPDAO;

use App\Converter\PHP\ConverterClassPHP;
use App\Converter\html\ConverterHTMLForm;

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

$conversorSearch = new ConversorPHPSearch($_POST);
$results["php-search"] = $conversorSearch->gerarClasse();

echo "<div class='resultWrapper well'>";
print_r(json_encode($classRep));
echo "</div>";


/*echo "<div class='resultWrapper well'>".$result."</div>";
echo "<div class='resultWrapper well'>".$result2."</div>";*/

//echo "<div class='resultWrapper well'>".$resultSearch."</div>";

foreach($results as $index => $result) {
	"<div class='resultWrapper well'>".$result."</div>";
  }
}
else{

	echo "Acesso Invedido";
}

?>