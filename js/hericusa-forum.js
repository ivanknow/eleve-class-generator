function verificaLogin(funcHandle){
	var retorno = false;
	$.ajax({
		type:"POST",
		dataType:"json",
		url:"codigo/UserOuvinte.php" ,
		data:"opt=VERIFICA_LOGIN", 
		success: function(response) {
			//alert(response);
			if(response['logged']){
				$('#usuarioNome').text(response.user.nome);
				if(funcHandle!==undefined){
				funcHandle(response);
				}
				retorno =  true;
			}else{
				window.location="formLogin.php";
				returno = false;
			}
		}
	});
	
	return retorno;
}

function delegaEventoLimparInputAnotacao(){
	$("#closeModalAnotacao").click(
			function(){
				
				resetFormAnotacao();
			}
	);
	
}


function resetFormAnotacao(){
	$("#inputIdAnotacao").attr("value","0");
	$("#inputTextAnotacao").val("");
	$("#inputOptAnotacao").attr("value","CRIAR_ANOTACAO");
}
function delegaEventoExcluirAnotacao(){

	$(document).on("click", ".excAnotacao", function(event){

		var item = $(this).attr("id").replace("excAnotacao","");

	
		if(confirm("Tem certeza que quer excluir?")){

			$.ajax({
				type:"POST",
				dataType: "json",
				url:"codigo/UserOuvinte.php" ,
				data:"opt=APAGAR_ANOTACAO&id="+item, 
				success: function(response) {
					if(!response['valor']){
						alert(response['mensagem']);
					}else{
						window.location="anotacao.php";
					}
				}
			});
			
		}

		});
	
}

function delegaEventoEditarAnotacao(){
	
	

	$(document).on("click", ".editAnotacao", function(event){
		
		var item = $(this).attr("id").replace("editAnotacao","");
		//alert(item);

		$.ajax({
			type:"POST",
			dataType: "json",
			url:"codigo/UserOuvinte.php" ,
			data:"opt=RECUPERA_ANOTACAO&id="+item, 
			
			success: function(response) {
				
				if(response.sucesso){
					
					$("#inputIdAnotacao").attr("value",response.anotacao.id);
					$("#inputTextAnotacao").val(response.anotacao.texto);
					$("#inputOptAnotacao").attr("value","ATUALIZAR_ANOTACAO");
					$("#btnAddAnotacao").click();
					
				}else{
					alert(response.mensagem);
				}
			}
		});

		});

	
}

function contaAnotacao(){
	
	$.ajax({
		type:"POST",
		url:"codigo/UserOuvinte.php" ,
		data:"opt=CONTAR_ANOTACAO", 
		success: function(response) {
			$("#mostraContadorAnotacaoSpan").text(response);
		}
	});
	
}

function delegaEventoLogout(){
	
$("#btnLogout").click(function(){
		
		$.ajax({
			type:"POST",
			url:"codigo/UserOuvinte.php" ,
			data:"opt=LOGOUT", 
			success: function(response) {
				window.location="formLogin.php";
			}
		});
		
	});
	
}

function montaTabelaAnotacao(){
	

	$.ajax({
		type:"POST",
		url:"codigo/UserOuvinte.php" ,
		data:"opt=LISTAR_ANOTACAO", 
		dataType: "json",
		success: function(response) {

			//alert(response.length);
			
			var linhas = "";
			for(var i = 0;i<response.length;i++){

				var linha = "<tr>";
					linha += "<td>";
						linha += response[i].texto;
					linha += "</td>";

					linha += "<td>";
					var date = new Date(response[i].data.replace(/-/g,"/"));
					linha += date.toString();
					linha += "</td>";

					linha += "<td>";
					linha += "<input type='button' class='btn excAnotacao' id=\"excAnotacao"+response[i].id+"\" value='Excluir'/>";
					linha += "<input type='button' class='btn editAnotacao'  id=\"editAnotacao"+response[i].id+"\"/ value='Editar'>";
					linha += "</td>";
					
				 linha += "</tr>";

				linhas += linha; 
				
			}

			$('#tbSHowAnotacoes > tbody').html(linhas);
			$("#tabelaMensagens").removeClass("hide");
			insereMensagem("");
			
		}
	});
}

$(function(){
	//verificaLogin();
	delegaEventoLogout();

});



function insereMensagem(mensagem){
	
	$("#responseMessage").html(mensagem);
}

function initAnotacao(){
	$('#modalAnotacao').on('hidden', function () {
		resetFormAnotacao();
	});
	contaAnotacao();
	montaTabelaAnotacao();
	delegaEventoExcluirAnotacao();
	delegaEventoEditarAnotacao();
	delegaEventoLimparInputAnotacao();
}

function initHome(){
	
}

function getUserSession(){
	
}

function submitForm(method, urlpass, formId,divResposta,func) {
	var test = $("#"+formId).valid();

	if(test){
	    $.ajax({
		type:method,
		url: urlpass,
		dataType: "json",
		data:$('#'+formId).serialize(), 
		success: function(response) {
			//alert(JSON.stringify(response));
			if(response.codigo===0){
				 if(func!=undefined){
						func();
			        }
			}
	        $("#"+divResposta).text(response.mensagem);
	        
	       
	    }});
	}
	    return false;
	}

function initMenu(){
	
	
	$("#formMudaSenha button").click(function(){
		

		submitForm("POST","codigo/UserOuvinte.php","formMudaSenha","respostaMudaSenha",function(){location.reload();});
		
	});
}

function mostraUser(obj){
	
	$('body').append("Hi <h1>"+obj.user.nome+"!</h1> How are you?");
	
}