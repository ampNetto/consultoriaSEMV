<?php
require_once 'Conexao.php';

class MovimentacaoDAO extends Conexao {
	
	public function __construct() {
		$this->conex = self::getConnection ();
	}

// 	recupera todos os movimentos do cliente
	public function getMovimento($cli_id) {
		$sql = 'SELECT 
					movi_horario
					,cli_id
					,cli_nome
					,movi_nundoc
					,mov_nome || '."'  '".' || tipmov_nome AS movimentos
					,movi_valor
					,movi_saldo saldo
				FROM 
					dbconsultoria.movimento
				
				INNER JOIN dbconsultoria.tipo_movimento tip USING (mov_id)
				INNER JOIN dbconsultoria.movimentacao USING (tipmov_id)
				INNER JOIN dbconsultoria.cliente USING (cli_id)
				WHERE
					cli_id = :idcli
				ORDER BY 
					movi_horario DESC';

		$stmt = $this->conex->prepare ( $sql );
		$stmt->bindValue ( ':idcli', $cli_id );
		$stmt->execute ();
		// reescrever o $stmt para retorna
		$stmt = $stmt->fetchAll ( PDO::FETCH_ASSOC );
		return $stmt;
	}
// 	recupera o ultimo movimento
	public function getUltimoMovimento($cli_id) {
		$sql = 'SELECT
					movi_horario
					,cli_id
					,cli_nome
					,movi_nundoc
					,mov_nome || '."'  '".' || tipmov_nome AS movimentos
					,movi_valor
					,movi_saldo saldo
				FROM
					dbconsultoria.movimento
							
				INNER JOIN dbconsultoria.tipo_movimento tip USING (mov_id)
				INNER JOIN dbconsultoria.movimentacao USING (tipmov_id)
				INNER JOIN dbconsultoria.cliente USING (cli_id)
				WHERE
					cli_id = :idcli
				AND
					movi_horario = (SELECT max(movi_horario) 
									FROM dbconsultoria.movimentacao 
									WHERE cli_id = :idcli)
				ORDER BY
					movi_horario DESC';
		
		$stmt = $this->conex->prepare ( $sql );
		$stmt->bindValue ( ':idcli', $cli_id );
		$stmt->execute ();
		// reescrever o $stmt para retorna
		$stmt = $stmt->fetch ( PDO::FETCH_ASSOC );
		return $stmt;
	}
	/*
	 * setInsert pega $array que foi tratado para inserir
	 */
	public function setInsert($id,$tipoMov,$numDoc,$xvalor,$novoSaldo) {
		
		$sql = 'INSERT INTO
					dbconsultoria.movimentacao
					(
					cli_id
					,tipmov_id
					,movi_nundoc
					,movi_valor
					,movi_saldo
					)
				VALUES
 					(
 					:id
 					,:tipoMov
 					,:numDoc
					,:xvalor
					,:xnovoSaldo
					)';
		$stmt = $this->conex->prepare($sql);
		$stmt->bindValue(':id', $id);
		$stmt->bindValue(':tipoMov', $tipoMov);
		$stmt->bindValue(':numDoc', $numDoc);
		$stmt->bindValue(':xvalor', $xvalor);
		$stmt->bindValue(':xnovoSaldo', $novoSaldo);
		$stmt->execute();

		return $stmt;
	}
// 	filto por perito de data escolhido
	public function getMovimentoData($cli_id,$xdataIni, $xdataFim) {
		$sql = 'SELECT
					movi_horario
					,cli_id
					,cli_nome
					,movi_nundoc
					,mov_nome || '."'  '".' || tipmov_nome AS movimentos
					,movi_valor
					,movi_saldo saldo
				FROM
					dbconsultoria.movimento
							
				INNER JOIN dbconsultoria.tipo_movimento tip USING (mov_id)
				INNER JOIN dbconsultoria.movimentacao USING (tipmov_id)
				INNER JOIN dbconsultoria.cliente USING (cli_id)
				WHERE
					cli_id = :idcli
				AND
					movi_horario BETWEEN :xdataIni AND :xdataFim
				ORDER BY
					movi_horario DESC';

		$stmt = $this->conex->prepare ( $sql );
		$stmt->bindValue ( ':idcli', $cli_id );
		$stmt->bindValue ( ':xdataIni', $xdataIni );
		$stmt->bindValue ( ':xdataFim', $xdataFim );
		$stmt->execute ();
		// reescrever o $stmt para retorna
		$stmt = $stmt->fetchAll ( PDO::FETCH_ASSOC );
		return $stmt;
	}
// 	recupera o todal de debito e o todal de credito
	public function getSomaMovimento($cli_id) {
		$sql = 'SELECT
					(SELECT SUM(movi_valor) FROM dbconsultoria.movimentacao
						INNER JOIN dbconsultoria.tipo_movimento tip USING (tipmov_id)
						WHERE 
						mov_id = 1) AS debido
					,(SELECT SUM(movi_valor) FROM dbconsultoria.movimentacao
						INNER JOIN dbconsultoria.tipo_movimento tip USING (tipmov_id)
						WHERE 
						mov_id = 2)AS credito
				FROM
					dbconsultoria.movimentacao
				WHERE
					cli_id = :idcli
				LIMIT 1';
		
		$stmt = $this->conex->prepare ( $sql );
		$stmt->bindValue ( ':idcli', $cli_id );
		$stmt->execute ();
		// reescrever o $stmt para retorna
		$stmt = $stmt->fetch ( PDO::FETCH_ASSOC );
		return $stmt;
	}
	// 	Mostrar o saldo na tela consulta cliente
	public function getClientesSaldo($idpeclis) {
		$sql = 'SELECT
					(SELECT SUM(movi_valor) FROM dbconsultoria.movimentacao
						INNER JOIN dbconsultoria.tipo_movimento tip USING (tipmov_id)
						WHERE
						mov_id = 1) - (SELECT SUM(movi_valor) FROM dbconsultoria.movimentacao
						INNER JOIN dbconsultoria.tipo_movimento tip USING (tipmov_id)
						WHERE
						mov_id = 2) AS saldo
				FROM
					dbconsultoria.cliente
					INNER JOIN dbconsultoria.movimentacao USING (cli_id)
				WHERE
					cli_id = :idpeclis
				AND
					movi_horario = (SELECT max(movi_horario)
									FROM dbconsultoria.movimentacao
									WHERE cli_id = :idpeclis )';
		
		$stmt = $this->conex->prepare ( $sql );
		$stmt->bindValue ( ':idpeclis', $idpeclis );
		$stmt->execute ();
		// reescrever o $stmt para retorna
		$stmt = $stmt->fetch ( PDO::FETCH_ASSOC );
		return $stmt;
	}
}
