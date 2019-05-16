	<div class="modal fade" id="#extradoModal" tabindex="-1"
		role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
								type="date" id="xdataini" class="form-control"
								value=" ">
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
							<tbody id="tbody-{$value.pes_id}">

								{foreach $viagens item=via} {if $value.pes_id == $via.pes_id }
								<tr>
									<td>{$via.pla_des}</td>
									<td>{$via.pla_dataini|date_format:"%d/%m/%Y"}</td>
									<td>{$via.pla_datafim|date_format:"%d/%m/%Y"}</td>
								</tr>
								{/if} {/foreach}

							</tbody>
						</table>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary"
						data-dismiss="modal">Fechar</button>
					<button type="button" idpes="{$value.pes_id}"
						class="btn btn-primary pegar">Cadastrar</button>
				</div>
			</div>
		</div>
	</div>