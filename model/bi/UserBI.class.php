<?php

/*
 * This class is responsible by call the methods on class of package
 * dao to insert, search, delete or update data on the database 
 * 
 * @author Edilson Justiniano
 */


/*
 * INCLUDE SECTOR
 */

//include the file of configuration
#require_once '../config.php';
#require_once PATH .'config.php';
// require_once  '/home/arqui937/public_html/config.php';
// require_once '/opt/lampp/htdocs/arquivoImobiliario/config.php';

/*$filename = '/home/arqui937/public_html/config.php';
if (file_exists ( $filename )) {
	require_once '/home/arqui937/public_html/config.php';
} else {
	require_once '/opt/lampp/htdocs/arquivoImobiliario/config.php';
}*/

require_once PATH_MODEL_DAO.        'UserDAO.class.php';
require_once PATH_MODEL_BI .        'GenericBI.php';
require_once PATH_MODEL_ENTITIES.   'User.class.php';




class UserBI extends GenericBI {

  private $userDAO;

  public function __construct($connection) {
    parent::__construct($connection);
  }

  public function addUser($user) {
    if (is_null($this->userDAO)) {
      $this->userDAO = new UserDAO($this->connection);
    }

    $this->userDAO->insert($user);
  }

  public function getById($id) {
    if (is_null($this->userDAO)) {
      $this->userDAO = new UserDAO($this->connection);
    }
    
    $user = $this->userDAO->findById(intval($id));
    return $user;
  }

  /*public function getByUserEmail($userEmail) {
    if (is_null($this->userDAO)) {
      $this->userDAO = new UserDAO($this->connection);
    }
    $stringCriteria = "WHERE UPPER(email) = UPPER('" . $userEmail . "')";

    $user = $this->userDAO->findUniqueByCriteria($stringCriteria);

    return $user;
  }*/

  public function getByUserName($userName) {
    if (is_null($this->userDAO)) {
      $this->userDAO = new UserDAO($this->connection);
    }
    $stringCriteria = "WHERE UPPER(name) = UPPER('" . $userName . "')";

    $user = $this->userDAO->findUniqueByCriteria($stringCriteria);

    return $user;
  }
  
  public function getByUserNameTelefone($userName, $userTelefone) {
  	if (is_null($this->userDAO)) {
  		$this->userDAO = new UserDAO($this->connection);
  	}
  	$stringCriteria = "WHERE name LIKE '" . $userName . "' AND phone LIKE '".$userTelefone."'";
  
  	$user = $this->userDAO->findUniqueByCriteria($stringCriteria);
  
  	return $user;
  }
  
  
  /*
   * This method will be find the status of all clients and return 
   * your status and some informations about it. REFACTOR
   * code add by Edilson Justiniano on day 2013-08-06
   */
  public function getStatusAllClients($filterByLetter) {
      
    if(is_null($this->userDAO)){
      $this->userDAO = new UserDAO($this->connection);
    }
    
    $statusAllUsers = $this->userDAO->getStatusAllClients($filterByLetter);

    return $statusAllUsers;
  }
  
  
  
  
  
  
  public function alterStatusOfClient($idClient, $status){
    
    if(is_null($this->userDAO)){
      $this->userDAO = new UserDAO($this->connection);
    }
      
    $result = $this->userDAO->alterStatusOfClient($idClient, $status);
    
    return $result;
  }
  
  
  
  
  /*
   * Este método irá receber o idDoUser e a sua nova senha
   * para atualizar no banco de dados
   * isso apenas o administrador irá fazer
   */
  public function updatePassword($idUser, $password){
    
    if(is_null($this->userDAO)){
      $this->userDAO = new UserDAO($this->connection);
    }
      
    $wasUpdated = $this->userDAO->updatePassword($idUser, md5(trim($password)) );
    
    return $wasUpdated;
  }
  
  /*
   * This method receives the new instance of connection and call the method
   * to search the user on database. If user found then return it. Otherwise
   * return a NULL object 
   *
  public function performLogin($email){
    
    if (is_null($this->userDAO)) {
      $this->userDAO = new UserDAO($this->connection);
    }
  
    /*
     * Now call the method to search on the datanase the user with this
     * email and return a user object with every information about him
     *
    $user = $this->userDAO->findUniqueByCriteria("WHERE UPPER(email) = '$email'");
    
    //return user object to validate the password informed
    return $user;
    
  }//eof method
   */
  
  
  
  /*
   * Methods add By Edilson Justiniano, on day 12/11/2013. 
   * This methods will be used to find all Users cadastre
   * on system, or only same.
   */
  public function findAll($limit,$orderBy){
      
    if(is_null($this->userDAO)){
      $this->userDAO = new UserDAO($this->connection);
    }
    
    return $this->userDAO->findAll($limit, $orderBy);
  }
  
  
  
  /*
   * Method that will go search and return a qtde of users
   * stored on system, I can use this information on page of admin
   * list users 
   */
  public function getCount(){
      
    if(is_null($this->userDAO)){
      $this->userDAO = new UserDAO($this->connection);
    }
    
    return $this->userDAO->getCount();
  }
  
  
  
  /*
   * Method that will remove a user from database
   */
  public function delete($idUser){
      
    if(is_null($this->userDAO)){
      $this->userDAO = new UserDAO($this->connection);
    }
    
    return $this->userDAO->delete(intval($idUser));
  }
  
  
  
  /*
   * Method that will go to make a update of user
   */
  public function updateUser($user) {
    if (is_null($this->userDAO)) {
      $this->userDAO = new UserDAO($this->connection);
    }

    return $this->userDAO->update($user);
  }
  
}//eof class

?>
