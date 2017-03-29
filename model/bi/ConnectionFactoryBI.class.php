<?php


require_once 'C:\xampp\htdocs\chkList_old\config.php';


require_once PATH_MODEL_DAO. 'ConnectionFactory.class.php';


class ConnectionFactoryBI {
  
  public function createConnectionWithTransaction($startTransaction){
    return ConnectionFactory::getInstance()->createConnection($startTransaction);
  }
  
  public function commitConnection($connection, $releaseConnection){
    ConnectionFactory::getInstance()->commitConnection($connection, $releaseConnection);
  }
  
  public function rollbackConnection($connection, $releaseConnection){
    ConnectionFactory::getInstance()->rollbackConnection($connection, $releaseConnection);
  }
  
}

?>
