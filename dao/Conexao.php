<?php

error_reporting(E_ALL);
ini_set("display_errors", true);

include '../initProjeto.php';

class Conexao {

    private $gerenciador = 'pgsql';
    public static $instance;
    public $conex = NULL;

    public function __construct() {
        try {
            $stconexao = $this->gerenciador . ':dbname=' . DBNAME . ';host=' . DBHOST . ';';
            $this->conex = new PDO($stconexao, DBUSER, DBPASS);
        } catch (Exception $ex) {
            echo 'erro' . $ex->getMessage();
        }
    }

    public function __destruct() {
        $this->conex = NULL;
    }

    public static function getConnection() {
        if (!self::$instance) {
            self::$instance = new Conexao();
        }
        //pegar o conex que esta tentro da instase
        return self::$instance->conex;
    }

    public function closeConex() {
        $this->conex = NULL;
    }

}

?>