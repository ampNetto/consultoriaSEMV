<?php
require_once 'Conexao.php';

class ClienteDAO extends Conexao {
	
	public function __construct() {
		$this->conex = self::getConnection ();
	}

// 	recupera todos os clientes
	public function getClientes() {
		$sql = 'SELECT 
					*
					,extract(year from age(cli_datanasc)) AS idade
				FROM 
					dbconsultoria.cliente
				ORDER BY 
					cli_id asc';

		$stmt = $this->conex->prepare ( $sql );
		$stmt->execute ();
		// reescrever o $stmt para retorna
		$stmt = $stmt->fetchAll ( PDO::FETCH_ASSOC );
		return $stmt;
	}
// 	exclui o cliente
	public function setDeletar($cli_id) {
		$sql = 'DELETE FROM 
					dbconsultoria.cliente 
				WHERE 
					cli_id = :idcli';

		$stmt = $this->conex->prepare ( $sql );
		$stmt->bindValue ( ':idcli', $cli_id );
		$stmt->execute ();
		return $stmt;
	}
	/*
	 * setInsert pega $array que foi tratado para inserir
	 */
	public function setInsert($array) {
		$colunas = null;
		$valores = null;
		
		foreach ( $array as $key => $value ) {
// 			supistidui o "_" da chave
			$keyTratado = str_replace ( "_", "", $key );
// 			valida se tem a coluna para inserir na variavel
			if (isset ( $colunas )) {
				$colunas .= " ," . $key . " ";
				$valores .= " , :x" . $keyTratado . " ";
			} else {
				$colunas .= " " . $key . " ";
				$valores .= " :x" . $keyTratado . " ";
			}
		}
		
		$sql = 'INSERT INTO
					dbconsultoria.cliente
					(' . $colunas . ')
				VALUES
					(' . $valores . ')';
		
		$stmt = $this->conex->prepare ( $sql );
		foreach ( $array as $key => $value ) {
			$key = str_replace ( "_", "", $key );
			$stmt->bindValue ( ":x" . $key, $value );
		}

		$stmt->execute ();
		return $stmt;
	}
	/*
	 * setUpdate pega array tratado para inserir
	 * $idwhere recebe qual a conticao ele irar compara
	 * $id combara com $idwhere para ser atualizado
	 */
	public function setUpdate($array, $idwhere, $id) {
		$colunas = null;
		$valores = null;
		foreach ( $array as $key => $value ) {
			$keyTratado = str_replace ( "_", "", $key );
			if (isset ( $colunas )) {
				$colunas .= " ," . $key . " = :x" . $keyTratado;
			} else {

				$colunas .= " " . $key . " = :x" . $keyTratado;
			}
		}

		$sql = 'UPDATE
					dbconsultoria.cliente
				SET
					' . $colunas . '
				WHERE
					' . $idwhere . ' = ' . $id;

		$stmt = $this->conex->prepare ( $sql );
		foreach ( $array as $key => $value ) {
			$key = str_replace ( "_", "", $key );
			$stmt->bindValue ( ":x" . $key, $value );
		}
		$stmt->execute ();
		return $stmt;
	}
	public function getCliente($idpeclis) {
		$sql = 'SELECT
					*
				FROM
					dbconsultoria.cliente
				WHERE
					cli_id = :idpeclis ';
		
		$stmt = $this->conex->prepare ( $sql );
		$stmt->bindValue ( ':idpeclis', $idpeclis );
		$stmt->execute ();
		// reescrever o $stmt para retorna
		$stmt = $stmt->fetch ( PDO::FETCH_ASSOC );
		return $stmt;
	}
// 	verifica se o cliente tem alguma movimentação
	public function getCliFiltro($idpeclis) {
		$sql = 'SELECT 
					*
				FROM 
					dbconsultoria.cliente
				INNER JOIN dbconsultoria.movimentacao USING (cli_id)
				WHERE 
					cli_id = :idpeclis ';

		$stmt = $this->conex->prepare ( $sql );
		$stmt->bindValue ( ':idpeclis', $idpeclis );
		$stmt->execute ();
		// reescrever o $stmt para retorna
		$stmt = $stmt->fetch ( PDO::FETCH_ASSOC );
		return $stmt;
	}

}
