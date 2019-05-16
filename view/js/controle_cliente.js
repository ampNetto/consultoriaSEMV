$(function(){
	$('#cliTelefone').mask('(##)####-####');
	validaIdade()
});

function validaIdade(){
	
	if($('#cliDataNasc').val()){
		var Data = $('#cliDataNasc').val();
		var recData = Data.split("-");
		idade(recData[2], recData[1] - 1, recData[0])
	}
	$("#cliDataNasc").blur(function(event){
		var strData = $('#cliDataNasc').val();
		var partesData = strData.split("-");
		var data = new Date(partesData[0], partesData[1] - 1, partesData[2]);
		if(data > new Date()){
			alert("A data de nascimento é maior que a atual");
			$("#cliDataNasc").val('');
			$("#cliDataNascIdade").before().text("Sua idade é: ??");
		}else{
			idade(partesData[2], partesData[1] - 1, partesData[0])
		}
	});
}
function idade(dia, mes, ano) {
	var idade = new Date().getFullYear() - ano;
	$("#cliDataNascIdade").before().text("Sua idade é: "+idade+" anos");
}