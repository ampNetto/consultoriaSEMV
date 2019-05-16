$(function() {
	var cliid;
	// Recebe toda a URL
	var urlatual = window.location.href;
	// Transforma em array a URL passando o separador ?
	var sepgets = urlatual.split('?');
	// Atribui a variavel todos os GET's da url atual
	var elementos = sepgets[1];
	// Separa os GET
	if (elementos) {
		// pegar elemento para mostrar na tela
		var getelemento = elementos.split('&');
		// Percorrer todos os GET's
		for (var j = 0; j < getelemento.length; j++) {
			// Separar os GET's e seus valores
			var valor = getelemento[j].split('=');
			if (valor[0] == 'cli_id') {
				cliid = valor[1];
				saldo(cliid)
			}
		}
	}

	$('#xmovimento').blur(function() {
		var nomeOption = $('#xmovimento').find(':selected').text();
		$('#xtipoMovimento').val('');
		if (nomeOption === 'Retirada') {
			// Redirata
			$('#xtipoMovimento').find('[value="1"] ').hide();
			$('#xtipoMovimento').find('[value="2"]').hide();
			$('#xtipoMovimento').find('[value="3"]').hide();
			$('#xtipoMovimento').find('[value="4"]').show();
			$('#xtipoMovimento').find('[value="5"]').show();
			$('#xtipoMovimento').find('[value="6"]').show();
			$('#xtipoMovimento').find('[value="7"]').show();
		} else {
			// Deposito
			$('#xtipoMovimento').find('[value="1"] ').show();
			$('#xtipoMovimento').find('[value="2"]').show();
			$('#xtipoMovimento').find('[value="3"]').show();
			$('#xtipoMovimento').find('[value="4"]').hide();
			$('#xtipoMovimento').find('[value="5"]').hide();
			$('#xtipoMovimento').find('[value="6"]').hide();
			$('#xtipoMovimento').find('[value="7"]').hide();
		}

	});
	// Inserir dados par movimento
	$('.pegarMovimento').click(function() {
		var mov = $('#xmovimento').val();
		var tipoMov = $('#xtipoMovimento').val();
		var numDoc = $('#xnumDocumento').val();
		var xvalor = $('#xvalor').val();
		if (mov == '' || tipoMov == '' || numDoc == '' || xvalor == '') {
			alert('Preencha todos os campos');
			return false;
		} else {
			$.ajax({
				url : 'controle_movimentacao.php',
				type : 'POST',
				data : {
					acao : 'inserir',
					id : cliid,
					mov : mov,
					tipoMov : tipoMov,
					numDoc : numDoc,
					xvalor : xvalor
				},
				success : function(date) {
					console.log(date);
					obj = JSON.parse(date);
					alert(obj.mensagem);
					window.location.reload()
				},
				error : function(jqXHR, textStatus, errorThrown) {
					console.log(errorThrown + ' <==> ' + textStatus);
				}
			});
		}
	});

	// Consulta por periodo
	$('.pegarData').click(
			function() {

				var xdataIni = $('#xdataini').val();
				var xdataFim = $('#xdatafim').val();
				if (xdataIni == '' || xdataFim == '') {
					alert('Preencha todos os campos');
					return false;
				} else {

					$.ajax({
						url : 'controle_movimentacao.php',
						type : 'POST',
						data : {
							acao : 'consulta',
							id : cliid,
							xdataIni : xdataIni,
							xdataFim : xdataFim
						},
						success : function(msg) {
							obj = JSON.parse(msg);
							if (obj.mensagem) {
								alert(obj.mensagem);
							} else {
								$.each(obj, function(key, value) {
									$('#tbody-movimento').append(
											'<tr>' + '<td>'
													+ value.movi_horario
													+ '</td>' + '<td>'
													+ value.cli_nome + '</td>'
													+ '<td>'
													+ value.movi_nundoc
													+ '</td>' + '<td>'
													+ value.movimentos
													+ '</td>' + '<td>'
													+ value.movi_valor
													+ '</td>' + '<td>'
													+ value.saldo + '</td>'
													+ '</tr>');
								});
							}
						},
						error : function(jqXHR, textStatus, errorThrown) {
							console.log(errorThrown + ' <==> ' + textStatus);
						}
					});
				}
			});
	
});
function saldo(cliid) {

	$.ajax({
		url : "controle_movimentacao.php",
		type : 'POST',
		data : {
			acao : "saldo",
			id : cliid
		},
		success : function(resul) {
			obj = JSON.parse(resul);
			$("#saldo").before().text(obj.mensagem);

		},
		error : function(jqXHR, textStatus, errorThrown) {
			console.log(errorThrown + " <==> " + textStatus);
		}
	});
};

