<div class="container">
	<div>
		<div class="text-right">
			<a aling href="../controle/controle_cliente.php">
				<button type="submit" class="btn btn-primary btn-sm"
					value="Cadastrar Cliente">Cadastrar Cliente</button>
			</a> <br>
		</div>
	</div>
	<div>
		<table class="table table-bordered" boder="2">
			<tr>
				<th>ID</th>
				<th>NOME</th>
				<th>Endereço</th>
				<th>Telefone</th>
				<th>E-mail</th>
				<th>Data de Nascimento</th>
				<th>Idade</th>
				<th>Profissão</th>
				<th>Numero Dependentes</th>
				<th>Salario</th>
				<th>Limite de Crédito</th>
				<th>Ação</th>
			</tr>
			{foreach $cliente as $value}
			<tr align="center">
				<td>{$value.cli_id}</td>
				<td>{$value.cli_nome}</td>
				<td>{$value.cli_endereco}</td>
				<td>{$value.cli_telefone}</td>
				<td>{$value.cli_email}</td>
				<td>{$value.cli_datanasc|date_format:"%d/%m/%Y"}</td>
				<td>{$value.idade}</td>
				<td>{$value.cli_profissao}</td>
				<td>{$value.cli_numdepen}</td>
				<td>{$value.cli_salario}</td>
				<td>{$value.cli_credextra}</td>
				<td>
					<form action="../controle/controle_cliente.php" method="POST">
						<input type="hidden" name="id" value="{$value.cli_id}"> <input
							type="hidden" name="acao" value="{$controle}">
						<button class="btn btn-warning btn-xs">EDITAR</button>
					</form> <input type="hidden" name="acao" value="{$controle}">
					<button idcli="{$value.cli_id}"
						class="btn btn-excluir btn-danger btn-xs">EXCLUIR</button> <br>
					<br> <a aling
					href="../controle/consulta_movimentacao.php?cli_id={$value.cli_id}">
						<button type="button" class="btn btn-primary btn-xs">
							Consulta Movimentação</button>
					</a> 
				</tr>
			{/foreach}
		</table>
	</div>

</div>





