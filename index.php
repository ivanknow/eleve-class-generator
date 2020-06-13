<!DOCTYPE html>
<html>
<head>
<title>HERICUSA Tools - Gerador</title>

<link href="img/iconesite.JPG" type="image/x-icon" rel="shortcut icon">

<!-- Inclusao de libs js -->
<script type="text/javascript" src="js/jquery-1.9.0.min.js"></script>
<script type="text/javascript" src="js/bootstrap.min.js"></script>
<script type="text/javascript" src="js/jquery.validate.js"></script>
<script type="text/javascript" src="js/hericusa-forum.js"></script>
<!-- inclusao do css -->
<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css" />

<script type="text/javascript">
var attrCount = 1;

addAttr = function(){

	$('#selectContent select').attr('name','atributeType['+attrCount+']');
	
	$('#selectNulo select').attr('name','atributeNull['+attrCount+']');
	
	var selectContent = $('#selectContent').html();
	
	var selectNulo = $('#selectNulo').html();

	var atributos =  "<div class='attr' id='attr"
	+attrCount
	+"'>"
	+"atributo:<input type='text' name='atributeName["+attrCount+"]' />"
	+"tipo:"+selectContent
	+"Nulo:"+selectNulo
	+"<button class='remove btn' id='remove"
	+attrCount+"'>remover</button>"
	+"</div>";
	$("#atributos").append(atributos);
	attrCount++;
	
}

removeItem = function(){
	
	var x = $(this).attr('id');
	x = x.replace("remove","");
	$('#attr'+x).remove();
	
	
}
sendData = function(){
	
	$.ajax({
		
		url:'backend/gerador/',
		type:'POST',
		data:$('#dataForm').serialize(),
		success:function(result){
		
			$('#resposta').html(result);
		}
	});
	
	
};
$(function(){


	
	var attrCount = 1;
	
	$("#submit").click(sendData);
	$("#addAtribute").click(addAttr);

	$(document).on("click", ".remove",removeItem);
	
	
});
</script>

</head>
<body>

<div id="form" class="well">

<form action="#" name="dataForm" id="dataForm" method="post" onsubmit="return false">

	<div class="well">
	 
	 <legend>Opcoes de Metodos</legend>
	 

	<label>toString: <input type="checkbox" name="tostring" value="true"/></label>
	<label>equals: <input type="checkbox" name="equals" value="true"/></label>
	<label>construtor por array: <input type="checkbox" name="contrutorPorArray" value="true"/></label>
	</div>
	<div class="well">
		
		<legend>Persistencia</legend>
	
	<label>DAO: <input type="checkbox" name="DAOPHP" value="true"/> </label>
	<label>Nome da tabela:<input type="text" name="tabela" value=""/> </label>
	 </div>
	<label>Classe Pai:</label> <input type="text" name="classePai" value="ObjetoPersistente"/>
	<label>Nome da Classe:</label> <input type="text" name="name"/>
	<div id="atributos">
	
	</div>
	<div><button id="addAtribute" class="btn">Adicionar Atributo</button></div>
	<div class="well center"><button id="submit" class="btn btn-large btn-primary">Gerar</button></div>
</form>

</div>

<pre>
<div id="resposta">

</div>
</pre>
<div id="selectContent" class="hide">
<select >
<option value="int">Integer</option>
<option value="string">String</option>
<option value="number">Number</option>
<option value="date">Date</option>
<option value="blob">Blob</option>
<option value="object">Object</option>
<option value="Array">Array</option>
</select>

</div>

<div id="selectNulo" class="hide">
<select>
<option selected="selected" value="true">SIM</option>
<option value="false">NAO</option>
</select>

</div>

</body>
</html>