
var HericusaToolsHorarioHandler = {
		diasSemana : {0:'hora/dia',1:'segunda',2:'terça',3:'quarta',4:'quinta',5:'sexta',6:'sábado',7:'domingo'},
		
		
		
};

//var dias = {0:'segunda',1:'terça',2:'quarta',3:'quinta',4:'sesta',5:'sábado',6:'domingo'};
var dias = {0:'hora/dia',1:'segunda',2:'terça',3:'quarta',4:'quinta',5:'sexta',6:'sábado',7:'domingo'};
var horas = new Array();

var horaInicial = 8;
var horaFinal = 11;

var eventClicaCelulaTabela = function(){

	var classe = $(this).attr('class');

	//caso esteja disponivel marca como indisponivel
	if(classe==='disponivel'){

		$(this).removeClass('disponivel');
		$(this).attr('class','indisponivel').text('Indisponível');
		
	}
	//caso esteja indisponivel marca como disponivel
	if(classe==='indisponivel'){

		$(this).removeClass('indisponivel');
		$(this).attr('class','disponivel').text('Disponível');
	
	}

	//caso seja uma celula que diz a hora habilita todas as horas
	if(classe === 'headerHora'){

		var rowIndex = $(this)
	    .closest('tr').index();

	    var row = $(this)
	    .closest('tr').attr('class');

	    $("."+row+" .indisponivel").attr('class','disponivel').text('Disponível');
	    
		
	}
	
};

eventClicaCelulaHeaderTabela = function(){

	var rowIndex = $(this).index()+1;

	if(rowIndex>1){
	
	$(".tabelaHorario tr > td:nth-child("+rowIndex+")").attr('class','disponivel').text('Disponível');

	}
	
}; 

for( i = horaInicial ; i < horaFinal ; i++){
	horas[horas.length] = i;
}


$(".tabelaHorario").append("<tr class='lheader'> </tr>");

for (x in dias){
	$(".lheader").append("<th class='headerDia'>"+dias[x]+"</th>");
}



for (x in horas){

	horasLiteral = horas[x];
	
	$(".tabelaHorario").append("<tr class='l"+x+"'></tr>");
	
	$(".l"+x).append("<td class='headerHora'>"+horas[x]+" horas </td>");

	for (y in dias){
		if(y>0){
			
		$(".l"+x).append("<td class='disponivel' id='d"+y+"h"+horasLiteral+"'>Disponível</td>");

		}

	}
		
}





$(function(){

//evento de click em uma th da tabela .tabelaHorario
	$('.tabelaHorario th').click(eventClicaCelulaHeaderTabela);

//evento de click em uma td da tabela .tabelaHorario
	$('.tabelaHorario td').click(eventClicaCelulaTabela);

	$("#btnSubmitTableHoras").click(function(){

		$("#result").text("");

		var resultado = [];
		
		$( ".disponivel" ).each(function( index ) {
			  resultado[resultado.length] =  $(this).attr("id");
		});

		var dadosString = resultado.join(",");

		
		$('#resultForm').text(dadosString);

		$.ajax({
			type:"POST",
			url: "horarioServer.php",
			data: "horarios="+dadosString, 
			success: function(response) {
				$("#outcome").html(response);
			}
		});
		
	});
		
});

