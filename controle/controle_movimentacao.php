<?php
error_reporting ( E_ALL );
ini_set ( "display_errors", true );

include_once 'config.php';
include '../dao/MovimentacaoDAO.class.php';
include '../dao/ClienteDAO.class.php';
class ControleMovimentacao extends Config {
	public function __construct() {
		parent::__construct ();

		$this->acao ();
	}
	public function acao() {
		switch (isset ( $_POST ["acao"] ) ? $_POST ["acao"] : false) {
			case 'inserir' :
				$this->inserir ();
				break;
			case 'consulta' :
				$this->consulta ();
				break;
			case "saldo" :
				$this->saldo ();
				break;
		}
	}
	public function inserir() {
		$movDAO = new MovimentacaoDAO ();
		$cliDOA = new ClienteDAO ();

		// Recebe os dados da tela por ajax
		$id = isset ( $_POST ["id"] ) ? $_POST ["id"] : false;
		$mov = isset ( $_POST ["mov"] ) ? $_POST ["mov"] : false;
		$tipoMov = isset ( $_POST ["tipoMov"] ) ? $_POST ["tipoMov"] : false;
		$numDoc = isset ( $_POST ["numDoc"] ) ? $_POST ["numDoc"] : false;
		$xvalor = isset ( $_POST ["xvalor"] ) ? $_POST ["xvalor"] : false;

// 		Recupera os valores do cliente
		$result = $movDAO->getUltimoMovimento ( $id );
		$cliente = $cliDOA->getCliente ( $id );

		// ferefica se tem algum saldo se nao tiver insere o saldo do salario com o do credito extra
		if (! $result) {
			$cliente = $cliDOA->getCliente ( $id );
			
			// Redira o "." das variaveis para poder calcular
			$cliendeSala = $this->splits ( $cliente ['cli_salario']);
			$clieCredExtra = $this->splits ( $cliente ['cli_credextra']);
			
			// calcula o salario com o credito extra
			$cliSaldo = ( float )$cliendeSala + ( float )$clieCredExtra;
			// insere o valor na tabela
			$movDAO->setInsert ( $id, 3, 000, $cliSaldo, $cliSaldo );
		}
		$somaDepRet = $movDAO->getSomaMovimento ( $id );
		// 		Recupera o valor do debito e credito redira o "." e o "R$"
		$debido = $this->splits ( $somaDepRet ['debido'] );
		$credito = $this->splits ( $somaDepRet ['credito'] );
		// Redira o "." das variaveis para poder calcular
		
		$xvalor = $this->splits ( $xvalor );

		$valCredExtra = $this->splits ( $cliente ['cli_credextra'] );
// 		Calcula os valora do debito com o credito extra
		$somaDebito = ( float ) $valCredExtra + ( float ) $debido;
		$total = ( float )$debido - ( float )$credito;

		if ($mov == 1) {
// 			apos validar se vor debito ele soma os valor com o valor de entrada
			$novoSaldo = ( float )$xvalor + ( float )$debido;
		} else {
// 			valida se tem saldo para redirata 
			if ($xvalor > $somaDebito || $xvalor >$total) {
				$arrReturn = [ 
						"resposta" => false,
						"mensagem" => "Saldo Insuficiente, ultrapassou o credito expecial"
				];
				echo json_encode ( $arrReturn );
				exit ();
			} else {
				
// 				se tem valor para redirata ele subtrai com o valor de entrada
				$novoSaldo = ( float )$debido - ( float )$xvalor;

			}
		}
		
		// inseri os dados no banco e armazena a resposta para mostra depois
		if ($movDAO->setInsert ( $id, $tipoMov, $numDoc, $xvalor, $novoSaldo )) {
			$arrReturn = [ 
					"resposta" => true,
					"mensagem" => "Movimento cadastrado sucesso"
			];
		} else {
			$arrReturn = [ 
					"resposta" => false,
					"mensagem" => "Erro ao cadastra."
			];
		}

	// mostra mensagem na tela ao finalizar
	echo json_encode ( $arrReturn );
	exit ();
}
	public function consulta() {
		$movDAO = new MovimentacaoDAO ();

		// Recebe os dados da tela por ajax
		$id = isset ( $_POST ["id"] ) ? $_POST ["id"] : false;
		$xdataIni = isset ( $_POST ["xdataIni"] ) ? $_POST ["xdataIni"] : false;
		$xdataFim = isset ( $_POST ["xdataFim"] ) ? $_POST ["xdataFim"] : false;

		// Recebe todas as data por aquele periodo selecionado
		$result = $movDAO->getMovimentoData ( $id, $xdataIni, $xdataFim );
		if ($result) {
			$arrReturn = $result;
		} else {
			$arrReturn = [ 
					"resposta" => false,
					"mensagem" => "Erro, Nao foi encontrado nenhum resultado."
			];
		}
		// mostra mensagem na tela ao finalizar
		echo json_encode ( $arrReturn );
		exit ();
	}
	public function saldo() {
		$movDAO = new MovimentacaoDAO ();
		$idpeclis = isset ( $_POST ["id"] ) ? $_POST ["id"] : false;
		$resSaldo = $movDAO->getClientesSaldo ( $idpeclis );
		if ($resSaldo) {
			$arrReturn = [ 
					"resposta" => false,
					"mensagem" => "Seu saldo é de : " . $resSaldo ["saldo"]
			];
		} else {
			$arrReturn = [ 
					"resposta" => false,
					"mensagem" => "Erro ao consultar o saldo"
			];
		}
		echo json_encode ( $arrReturn );
		exit ();
	}
	public function splits($param) {
// 		Recebe o valor e redira o . e o R$
		$validar = $param;
		$soma = str_replace ( '.', '', $validar );
		$soma = str_replace ( 'R$', '', $soma );
// 		redorna o valor limpo
		return $soma;
	}
}

new ControleMovimentacao ();