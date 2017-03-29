<?php

/*
 * Class abstract to recuver a connection and established the connection
 * with database
 * 
 * @author Edilson Justiniano
 */

/*
 * INCLUDE SECTOR
 */

//include the file of configure
#require_once '../config.php';
#require_once PATH .'config.php';
// require_once  '/home/arqui937/public_html/config.php';
// require_once '/opt/lampp/htdocs/arquivoImobiliario/config.php';

require_once 'C:\xampp\htdocs\chkList_old\config.php';


require_once PATH_MODEL_DAO. 'ConnectionFactory.class.php';


abstract class GenericBI {
  protected $connection;

  public function __construct($connection) {
    $this->connection = $connection;
  }
  
  public function commitConnection($releaseConnection){
    ConnectionFactory::getInstance()->commitConnection($this->connection, $releaseConnection);
  }
  
  public function rollBackConnection($releaseConnection){
    ConnectionFactory::getInstance()->rollBackConnection($this->connection, $releaseConnection);
  }
  
  public function releaseConnection($connection){
    ConnectionFactory::getInstance()->releaseConnection($connection);
  }

}

?>
