$(function(){
	
	//botao para ecluir jqueri com ajax
	$(".btn-excluir").click(function() {
		var cli_id = $(this).attr("idcli");
		$.ajax({
			url : "consulta_cliente.php",
			type : 'POST',
			data : {
				acao : "validar",
				id : cli_id
			},
			success : function(resul) {
				console.log(resul);
				if(resul === 'true'){
					alert('Cliente ja possui uma movimentação, não pode ser excluito')
				}else{
					$.ajax({
						url : "consulta_cliente.php",
						type : 'POST',
						data : {
							acao : "deletar",
							id : cli_id
						},
						success : function(date) {
				
							obj = JSON.parse(date);
							alert(obj.mensagem);
							if (obj.resposta === true) {
								$("[idcli='" + cli_id + "']").parent()
								.parent().hide();
								
							}
							
						},
						error : function(jqXHR, textStatus, errorThrown) {
							console.log(errorThrown + " <==> "
									+ textStatus);
						}
					});
				}
			},
			error : function(jqXHR, textStatus, errorThrown) {
				console.log(errorThrown + " <==> "
						+ textStatus);
			}
		});
	});
});

