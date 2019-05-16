<?php

error_reporting(E_ALL);
ini_set("display_errors", true);

require_once '../lib/smarty-3.1.30/libs/Smarty.class.php';

class Config {
	
	public $smarty;
	
	public function __construct() {
		session_name("consultoria");
		session_start();
		
		$this->smarty = new Smarty();
		$this->smarty->compile_dir = '/tmp';
		$this->aviso();
	}
	/*
	 * Em $msg recebe um array com duas posições ( string mensagem , int tipo).
	 * @param type $tela
	 * @param type $msg
	 * @tipo: 0(sucesso), 1(erro), 2(alerta)
	 */
	private function aviso(){
		$msg = isset($_SESSION["aviso"])?$_SESSION["aviso"]:null;
		if ($msg) {
			if ($msg[1] == 0) {
				$msg["tipo"] = "success";
			} else if ($msg[1] == 1) {
				$msg["tipo"] = "danger";
			} else if ($msg[1] == 2) {
				$msg["tipo"] = "warning";
			}
			$msg["mensagem"] = $msg[0];
			$this->smarty->assign("msg", $msg);
			$_SESSION["aviso"]=null;
		}
	}
	/*
	 * Tradamendo do Array que e recebito
	 * para o cadastro e edição
	 */
	public function arrayTratado($arr){
		$err = NULL;
		foreach ($arr as $key => $value) {
			$exColumn = explode("-", $key);
			$column = $exColumn[0] . "_" . $exColumn[1];
			$valor = trim($value);
			if (empty($valor)) {
				$err .= " " . $exColumn[2];
			}
			$arrTratado[$column] = $valor;
		}
		if ($err) {
			$_SESSION['aviso'] = ['Erro! Campo(s) ' . $err . ' estão(á) vazio(s). Porfavor preencha corretamente', 2];
		}
		return $arrTratado;
	}
	/*
	 * Recebe o nome da tela mostrar a tela pelo smarty
	 *@param type $tela nome da tela sem o ".tpl"
	 */
	public function template($tela) {
		$this->smarty->assign("content","../view/".$tela.".tpl");
		$this->smarty->display("../view/menu.tpl");
	}
	
}

?>