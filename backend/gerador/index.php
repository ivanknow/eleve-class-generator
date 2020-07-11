<?php

declare(strict_types=1);

use App\Conversor\PHP\ConversorPHPEleve;
use App\Conversor\PHP\ConversorPHPSearch;
use App\Conversor\PHP\ConversorPHPDAO;

use App\Converter\PHP\ConverterClassPHP;
use App\Converter\html\ConverterHTMLForm;

use App\Domain\ClassRepresentation;
use App\Domain\ClassRepresentationBuilder;

require __DIR__ . '/vendor/autoload.php';


if(isset($_POST) && count($_POST)){
	
/*print_r($_POST);

print_r(json_encode($_POST));*/

$classRep = ClassRepresentationBuilder::buildFromForm($_POST);

print_r(json_encode($classRep));

$newConverterPHP = new ConverterClassPHP($classRep);
$result = $newConverterPHP->process();

$newConverterHTMLForm = new ConverterHTMLForm($classRep);
$result2 = $newConverterHTMLForm->process();

$conversorSearch = new ConversorPHPSearch($_POST);

$resultSearch = $conversorSearch->gerarClasse();


echo "<div class='resultWrapper well'>".$result."</div>";
echo "<div class='resultWrapper well'>".$result2."</div>";

//echo "<div class='resultWrapper well'>".$resultSearch."</div>";

if(isset($_POST['DAOPHP'])){

	$conversorDAO = new ConversorPHPDAO($_POST);
	
	$resultDao = $conversorDAO->gerarClasse();
	
	//echo "<br/> <div class='resultWrapper well'>".$resultDao."</div>";;
}

}
else{

	echo "Acesso Invedido";
}

?>