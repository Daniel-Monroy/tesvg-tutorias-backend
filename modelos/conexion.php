<?php 

/**
* Conexion
*/
class Conexion
{

	static public function conectar(){

		$link = new PDO("mysql:host=localhost; dbname=u881670891_tuto1", 
			"root", 
			"");

		$link -> exec("set names utf8");

		return $link;

	}

}