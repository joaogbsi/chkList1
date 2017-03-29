<?php

class ConnectionFactory {
	private static $instance;
	private $connection;
	public static function getInstance() {
		if (! self::$instance) {
			self::$instance = new ConnectionFactory ();
		}
		return self::$instance;
	}
	public function createConnection($startTransaction) {
		
		$dsn = "mysql:dbname=".DB_NAME.";host=".DB_HOST."";
		$userName = DB_USER;
		$passwd = DB_PASSWORD;
		
		
		$opcoes = array (
				PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES UTF8' 
		);
		$this->connection = new PDO ( $dsn, $userName, $passwd, $opcoes );
		
		// === Turn off auto commit
		if ($startTransaction) {
			$this->connection->beginTransaction ();
		}
		
		return $this->connection;
	}
	public function releaseConnection($connection) {
		if ($connection != NULL) {
			// === Close connection
			$connection = NULL;
		}
	}
	public function commitConnection($connection, $releaseConnection) {
		if ($connection != NULL) {
			$connection->commit ();
		}
		if ($releaseConnection) {
			$this->releaseConnection ( $connection );
		}
	}
	public function rollBackConnection($connection, $releaseConnection) {
		if ($connection != NULL) {
			$connection->rollBack ();
			if ($releaseConnection) {
				$this->releaseConnection ( $connection );
			}
		}
	}
}

?>
