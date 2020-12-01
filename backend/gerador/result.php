<?php

declare(strict_types=1);

use App\Conversor\PHP\ConversorPHPEleve;
use App\Conversor\PHP\ConversorPHPSearch;
use App\Conversor\PHP\ConversorPHPDAO;

require __DIR__ . '/vendor/autoload.php';


if(isset($_POST) && count($_POST)){
	
print_r($_POST);

$conversor = new ConversorPHPEleve($_POST);

$result = $conversor->gerarClasse();

$conversorSearch = new ConversorPHPSearch($_POST);

$resultSearch = $conversorSearch->gerarClasse();

echo "<div class='resultWrapper well'>".$result."</div>";

echo "<div class='resultWrapper well'>".$resultSearch."</div>";

if(isset($_POST['DAOPHP'])){

	$conversorDAO = new ConversorDAOPHP($_POST);
	
	$resultDao = $conversorDAO->gerarClasse();
	
	echo "<br/> <div class='resultWrapper well'>".$resultDao."</div>";;
}

}
else{

	echo "Acesso Invedido";
}

?>