<?php
/**
 * Classe para conexao com o banco de dados MySql,
 * via acesso nativo do PHP/PDO.
 * É necessário ter definido as seguintes constantes: DB_NAME, DB_HOST, DB_USER, \DB_PASSWORD
 */
class DB{
	/**
	*instacia singleton
	*@var DB
	*/
	private static $instance;
	
	/*conexao com o banco de dados 
	@var PDO
	*/
	private static $connection;
	
	/*Constructor privado da classe singleton*/
	private function __construct(){
		self::$connection = new PDO("'mysql:dbname".DB_NAME.";host:".DB_HOST."'", DB_USER, DB_PASSWORD, array(PDO::MYSQL_ATTR_INIT => "SET NAMES utf8"));
		self::$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		self::$connection->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
	}
	
	public static function getInstance(){
		if(empty(self::$instance)){
			self::$instance=new DB();
		}
		return self::$instance;
	}
	
	public static function getConn(){
		self::getInstance();
		return self::$connection;
	}
	
	public static function prepare($sql){
		return self::getConn()->prepare($sql);
	}
	
	public static function lastInsertId(){
		return self::getConn()->lastInsertId();
	}
	
	public static function beginTransaction(){
		return self::getConn()->beginTransaction();
	}
	
	public static function commit(){
		return self::getConn->commit();
	}
	
	public static function rollBack(){
		return self::getConn()->rollBack()
	}
	
	public static function dateToMySql($date){
		return implode("-", array_reverse(explode("/", $date)))
	}
	
	public static function dateFromMySql($date){
		return implode("/", array_reverse(explode("-", $date)))
	}
}
?>