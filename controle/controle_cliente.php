<?php
error_reporting ( E_ALL );
ini_set ( "display_errors", true );

include_once 'config.php';
include '../dao/ClienteDAO.class.php';

class ControleCliente extends Config {
	
	public function __construct() {
		parent::__construct ();

		$this->acao ();
		$this->inicio ();
	}
	public function acao() {
		switch (isset ( $_POST ["acao"] ) ? $_POST ["acao"] : false) {
			case 'cadastrar' :
				$this->inserir ();
				break;
			case 'editar' :

				$this->atualizar ();
				break;
		}
	}
	public function inicio() {
		if (isset ( $_POST ['acao'] )) {
			$cliDOA = new ClienteDAO();
// 			recupera o clientes
			$result = $cliDOA->getCliente ( $_POST ['id'] );
// 			mostrar o resultado no smarty
			$this->smarty->assign ( 'cliente', $result );
			$this->smarty->assign ( 'controle', "editar" );
		} else {
			$this->smarty->assign ( 'controle', "cadastrar" );
		}
			$this->template ( "controle_cliente" );
	}
	public function inserir() {
		
		$cliDOA = new ClienteDAO();
// 		pega todo a array do POST para fazer o tradamendo
		$arrTratado = $this->arrayTratado ( $_POST ["arrCli"] );

// 		informa na tela se tem algum campo em branco
		if ($_SESSION ['aviso']) {
			header ( "Location: controle_cliente.php" );
			exit ();
		}
// 		depois do tradamendo inseri na tabela e depois mostra o aviso
		if (!$cliDOA->setInsert ( $arrTratado)) {
			$_SESSION ['aviso'] = ['Pessoa nao cadastrado',	2];
			header ( "Location: controle_cliente.php" );
			exit ();
		}
		$_SESSION ['aviso'] = ['cadastrado com sucesso',0];
		header ( "Location: consulta_cliente.php" );
		exit ();
	}
	public function atualizar() {

// 		pega todo a array do POST para fazer o tradamendo
		$arrTratado = $this->arrayTratado ( $_POST ["arrCli"] );
// 		informa na tela se tem algum campo em branco
		if ($_SESSION ['aviso']) {
			header ( "Location: controle_Cliente.php" );
			exit ();
		}
		$cliDOA = new ClienteDAO();
// 		depois do tradamendo atualiza a tabela e depois mostra o aviso
		if (! $cliDOA->setUpdate( $arrTratado, "cli_id", $_POST ['id'] )) {
			$_SESSION ['aviso'] = ['Nao atualizada',2];
			header ( "Location: controle_cliente.php" );
			exit ();
		}
		$_SESSION ['aviso'] = ['Atualizado com sucesso',0];
		header ( "Location: consulta_cliente.php" );
		exit ();
	}
}

new ControleCliente ();
