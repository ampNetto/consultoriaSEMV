<?php
error_reporting ( E_ALL );
ini_set ( "display_errors", true );

include_once "config.php";
include "../dao/ClienteDAO.class.php";

class ConsultaCliente extends Config {
	
	public function __construct() {
		parent::__construct ();

		$this->acao ();
		$this->inicio ();
	}
	public function acao() {
		switch (isset($_POST["acao"]) ? $_POST["acao"] : false) {
			case "deletar":
				$this->deletar();
				break;
			
		}
	}
	public function inicio() {
		$cliDAO = new ClienteDAO();
		$result = $cliDAO->getClientes();
// 		var_dump($result);die;
		$this->smarty->assign ( "cliente", $result );
		$this->template ( "consulta_cliente" );
	}
	public function deletar() {
		$cli_id = isset($_POST["id"]) ? $_POST["id"] : False;
		if (!$cli_id) {
			$arrReturn = ["resposta" => false, "mensagem" => "Erro no id."];
			echo json_encode($arrReturn);
			exit;
		}

		$cliDAO = new ClienteDAO();
		if ($cliDAO->setDeletar($cli_id)) {
			$arrReturn = ["resposta" => true, "mensagem" => "Cliente Excluido com sucesso"];
		} else {
			$arrReturn = ["resposta" => false, "mensagem" => "Erro ao excluir." . $cli_id];
		}

		$arrReturn = ["id" => $cli_id, "resposta" => true];
		echo json_encode($arrReturn);
	}

	
}

new ConsultaCliente ();
