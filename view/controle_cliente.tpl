<div class="col-md-12 col-md-offset-0 text-left">
	<div class="row row-mt-15em">
		<div class="col-md-4 col-md-push-1 animate-box"
			data-animate-effect="fadeInRight">
			<div class="form-wrap">
				<div class="tab">
					<div class="tab-content">
						<div class="tab-content-inner active" data-content="signup">
							<form action="../controle/controle_cliente.php" method="POST">
								<div class="row form-group">
									<div class="col-md-12">
										<label for="nome">Nome</label> <input required type="text"
											class="form-control" name="arrCli[cli-nome-Nome]"
											value="{$cliente.cli_nome|default:''}" id="cliNome">
									</div>
								</div>
								<div class="row form-group">
									<div class="col-md-12">
										<label for="endereco">Endereço</label> <input required type="text"
											class="form-control" name="arrCli[cli-endereco-Endereco]"
											value="{$cliente.cli_endereco|default:''}" id="cliEndereco">
									</div>
								</div>
								<div class="row form-group">
									<div class="col-md-12">
										<label for="telefone">Telefone</label> <input required type="text"
											class="form-control" name="arrCli[cli-telefone-Telefone]" maxlength="13"
											value="{$cliente.cli_telefone|default:''}" id="cliTelefone">
											<span>Somende Numeros</span>
									</div>
								</div>
								<div class="row form-group">
									<div class="col-md-12">
										<label for="email">e-mail</label> <input required type="email"
											class="form-control" name="arrCli[cli-email-Email]"
											value="{$cliente.cli_email|default:''}" id="cliEmail">
									</div>
								</div>
								
								<div class="row form-group">
									<div class="col-md-12">
										<label for="dataNas">Data de Nascimento</label>
										<br>
										<label id="cliDataNascIdade">Sua idade é: </label> <input
											required type="date" class="form-control" id="cliDataNasc"
											name="arrCli[cli-datanasc-Datanas]"
											value="{$cliente.cli_datanasc|default:''}" />
									</div>
								</div>
								<div class="row form-group">
									<div class="col-md-12">
										<label for="profissao">Profissão</label> <input required type="text"
											class="form-control" name="arrCli[cli-profissao-Profissao]"
											value="{$cliente.cli_profissao|default:''}" id="cliProfissao">
									</div>
								</div>
								<div class="row form-group">
									<div class="col-md-12">
										<label for="salario">Salário mesal</label> <input required type="number"
											class="form-control" name="arrCli[cli-salario-Salario]"
											value="{$cliente.cli_salario|default:''}" id="cliSalario">
									</div>
								</div>
								<div class="row form-group">
									<div class="col-md-12">
										<label for="numDependentes">Numero de Dependentes</label> <input required type="number"
											class="form-control" name="arrCli[cli-numdepen-NumPen]"
											value="{$cliente.cli_numdepen|default:''}" id="cliNumDepen">
									</div>
								</div>
								<div class="row form-group">
									<div class="col-md-12">
										<label for="valorCredito">Valor do Limite de Crédito</label> <input required type="number"
											class="form-control" name="arrCli[cli-credextra-CredExtra]"
											value="{$cliente.cli_credextra|default:''}" id="cliCredExtra">
									</div>
								</div>

								<div class="row form-group">
									<div class="col-md-12">
										<input id="enviar" type="submit" class="btn btn-primary" value="Enviar">
									</div>
								</div>
								<input type="hidden" name="id"
									value="{$cliente.cli_id|default:''}"> <input
									type="hidden" name="acao" value="{$controle}">
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>


