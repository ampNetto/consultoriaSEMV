<?php
error_reporting(E_ALL);
ini_set("display_errors", true);

include_once 'config.php';

class Home extends Config
{
	public function __construct()
	{
		parent::__construct();
	
		$this->inicio();
	}
	
	public function inicio()
	{
		$this->template('home');
	}
}

new Home();
