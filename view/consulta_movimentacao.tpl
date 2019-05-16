<div class="container">
	<div>
		<div class="text-left">
			<label for="nome" id="saldo"></label> 
		</div>
		<div class="text-center">
			<button type="button" class="btn btn-primary btn-xs"
				data-toggle="modal" data-target="#extradoModal"
				value="Novo Movimento">extrado por Periodo</button>
		</div>
		<div class="text-right">
			<button type="button" class="btn btn-primary btn-xs"
				data-toggle="modal" data-target="#novoMoviModal"
				value="Novo Movimento">Novo Movimento</button>
		</div>
	</div>
	<div>
		<table class="table table-bordered" boder="2">
			<tr>
				<th>Horario</th>
				<th>Cliente</th>
				<th>N. Documento</th>
				<th>Transação</th>
				<th>Valor</th>
				<th>Saldo</th>
			</tr>
			{foreach $movimentacao as $value}
			<tr align="center">
				<td>{$value.movi_horario|date_format:"%d/%m/%Y %H-%m"}</td>
				<td>{$value.cli_nome}</td>
				<td>{$value.movi_nundoc}</td>
				<td>{$value.movimentos}</td>
				<td>{$value.movi_valor}</td>
				<td>{$value.saldo}</td>
			</tr>
			{/foreach}
		</table>
	</div>
	<!-- Modal -->
	<div class="modal fade" id="novoMoviModal" tabindex="-1" role="dialog"
		aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="novoMoviModalLabel">Movimentação</h5>
					<button type="button" class="close" data-dismiss="modal"
						aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<div class="row">
						<div class="form-group col-md-6">
							<label for="Movimentaçao">Movimentação</label> <select
								class="form-control" id="xmovimento">
								<option value="">Selecione uma opção</option>
								<option value="1">Deposito</option>
								<option value="2">Retirada</option>
							</select>
						</div>
						<div class="form-group col-md-6">
							<label for="tipoMovimentaçao">Tipo Movimentação</label> <select
								class="form-control" id="xtipoMovimento">
								<option value="">Selecione uma opção</option>
								<option value="1">Dinheiro</option>
								<option value="2">Cheque D</option>
								<option value="3">Transferência D</option>
								<option value="4">Caixa</option>
								<option value="5">Cheque R</option>
								<option value="6">Transferência R</option>
								<option value="7">Pagamento de conta</option>
							</select>
						</div>
						<div class="form-group col-md-6">
							<label for="numDocumento">Numero do Documento</label> <input
								required type="number" id="xnumDocumento" class="form-control"
								value=" ">
						</div>
						<div class="form-group col-md-6">
							<label for="valor">Valor</label> <input required type=number
								id="xvalor" class="form-control" value=" ">
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary"
						data-dismiss="modal">Fechar</button>
					<button type="button" class="btn btn-primary pegarMovimento">Cadastrar</button>
				</div>
			</div>
		</div>
	</div>
	<div class="modal fade" id="extradoModal" tabindex="-1" role="dialog"
		aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
					<button type="button" class="close" data-dismiss="modal"
						aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<div class="row">
						<div class="form-group col-md-6">
							<label for="dataIni">Data de Inicio</label> <input required
								type="date" id="xdataini" class="form-control" value=" ">
						</div>
						<div class="form-group col-md-6">
							<label for="dataFim">Data Fim</label> <input required type="date"
								id="xdatafim" class="form-control" value=" ">
						</div>
						<table class="table">
							<thead>
								<tr>
									<th scope="col">Horario</th>
									<th scope="col">Cliente</th>
									<th scope="col">N. Documento</th>
									<th scope="col">Transação</th>
									<th scope="col">Valor</th>
									<th scope="col">Saldo</th>
								</tr>
							</thead>
							<tbody id="tbody-movimento">
							</tbody>
						</table>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary"
						data-dismiss="modal">Fechar</button>
					<button type="button" idpes="{$value.pes_id}"
						class="btn btn-primary pegarData">Consulta</button>
				</div>
			</div>
		</div>
	</div>
</div>





