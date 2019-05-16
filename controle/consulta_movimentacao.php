<?php
error_reporting ( E_ALL );
ini_set ( "display_errors", true );

include_once 'config.php';
include '../dao/MovimentacaoDAO.class.php';

class ConsultaMovimentacao extends Config {
	public function __construct() {
		parent::__construct ();

		$this->acao ();
		$this->inicio ();
	}
	public function acao() {
		switch (isset($_POST["acao"]) ? $_POST["acao"] : false) {
			case 'consulta':
			$this->consulta();
			break;
		}
	}
	public function inicio() {

		$movDAO = new MovimentacaoDAO();
		$result = $movDAO->getMovimento($_GET["cli_id"]);

		$this->smarty->assign ( 'movimentacao', $result );
		$this->template ( "consulta_movimentacao" );
	}
	public function consulta() {
		
	}
}

new ConsultaMovimentacao ();
