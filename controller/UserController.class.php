<?php

/*
 * This class is responsible to validate the information about the login
 * of users.
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
require_once PATH_MODEL_BI.         'ConnectionFactoryBI.class.php';
require_once PATH_MODEL_BI.         'UserBI.class.php';
require_once PATH_MODEL_ENTITIES.   'User.class.php';
//require_once PATH_MODEL_BI.         'RoleBI.class.php';

class UserController{
    
    //the attribute that receives a instance of connection
    private $connectionFactoryBI;
    private $user;
    
    
    public function addUser($params) {

        if (is_null($this->connectionFactoryBI)) {
          $this->connectionFactoryBI = new ConnectionFactoryBI();
        }

        $connection = $this->connectionFactoryBI->createConnectionWithTransaction(false);

        $userBI = new UserBI($connection);
        $roleBI = new RoleBI($connection);

        try {
          $user = new User();
          $user->setName($params['name']);
          $user->setPassword(md5($params['password']));
          $user->setMobilePhone($params['mobilePhone']);
          $user->setPhone($params['phone']);
          $user->setEmail($params['email']);
          $user->setUserPhotoPath($params['photo']);

          //=== Every user is record as a customer.
          $role = $roleBI->getRoleByName("'cliente'");
          $user->setRole($role);

          $userBI->addUser($user);

          $userBI->releaseConnection($connection);
        } catch (Exception $exc) {
          $connection->rollBack();
          $this->connectionFactoryBI()->releaseConnection($connection);
          echo $exc->getTraceAsString();
        }

        $userBI->releaseConnection($connection);
    }
  
  
  public function getByUserEmail($userEmail) {
    if (is_null($this->connectionFactoryBI)) {
      $this->connectionFactoryBI = new ConnectionFactoryBI();
    }
    $connection = $this->connectionFactoryBI->createConnectionWithTransaction(false);

    $userBI = new UserBI($connection);
    $user = $userBI->getByUserEmail($userEmail);
    $userBI->releaseConnection($connection);

    return $user;
  }
    /*
     * Method to perform the login on the application. The method receives as 
     * parametter the email and password of user
     */
    public function performLogin($name, $password){
        //echo "testeuser";
        $name      =   trim($name);
        
        //validate the fields
        if (empty($name) || $name == ""){
            //$this->returnToPageWithError(URL. "index.php", 0); //return error Inform E-mail
          echo "Por favor digite um Usuário";
          return NULL;
        }
        if (empty($password) || $password == ""){
          echo "Sem senha do usuário";
          return NULL;
             //$this->returnToPageWithError(URL ."index.php", 1); //return error Inform Password
        }
        //recuver the connection with database
        if ($this->connectionFactoryBI == NULL) {
            $this->connectionFactoryBI = new ConnectionFactoryBI();
        }
        $connection = $this->connectionFactoryBI->createConnectionWithTransaction(FALSE);
        
        $userBI     = new UserBI($connection);
        $this->user = $userBI->getByUserName($name);
		if(!is_null($this->user)){
			if ($this->user->getId() != NULL){
				$userBI->releaseConnection($connection);
				
				/*
				 * Now call the method for verify whether (IF) the user is active
				 * if active proceed else return to page error
				 */
				if (!$this->clientIsActive($this->user)) {
					//Now send the pageWithError, because it's no activate
					//$this->returnToPageWithError(URL ."index.php", 3);
          echo "Usuário Invalido";
          return NULL;
					
				} else {
				
					/*
					 * Now call the method to validate now if the password informed is same
					 * password stored on the database
					 */

					//Now verify if the method validateLogin is equal NULL. If true return error to user
					//Otherwise, call the method to create a SESSION
					$validate = $this->validateLogin($this->user->getPassword(), $password);
					if ($validate){
						$this->createSession($this->user); //create a SESSION
						return $this->user;
						
					}else{

						/*
						 * Here We can implement after in next version the max qtde of 
						 * attempts to block the login of user
						 * 
						 * I thought make using the $_SESSION['qtde']. And All times that 
						 * user try login on system and generates the fault of password error
						 * I incremente the value of attempts And verify If value is greather
						 * than the defined Then I set the password as default. And If before
						 * arrive in max value the user perform logi with suscess I remove the 
						 * SESSION
						 */
						//return error INVALID LOGIN Password not found INVALID PASSWORD
						//$this->returnToPageWithError(URL ."index.php", 2); 
            echo "Usuário invalido";
					}
				}//else user isActive
			} else {
				$userBI->releaseConnection($connection);
				//return error INVALID LOGIN name not found INVALID name
				$this->returnToPageWithError(URL ."index.php", 2); 
			}
		}else{
      echo "Usuário invalido";
			return NULL;
		}
      
    }//eof method performLogin
    
    
    
    
    
    /*
     * Method to validate if password informed by user is same stored on database.
     * This method receive as parametter the password stored and the password informed
     * by user
     */
    public function validateLogin($passwordStored, $password){
        
        /*
         * Now convert the password to md5 and compare with password stored on database
         */
        $password = md5(trim($password));
        
        if ($passwordStored == $password)
            return true;
        
        return false;
        
    }//eof method validateEmail
    
    
    
    
    
    /*
     * Method to create a SESSION case the email and password are valid 
     */
    public function createSession($user){
        session_start();
        $_SESSION['id_user'] = $user->getId();
        /*
         * Case the user be the admin user, then send it to AMIN PAGE = adm_index.php
         */
        //if ($user->getRole()->getId() == 1 || $user->getRole()->getId() == 3){
            $_SESSION['admin'] = true;
            
            //header("location: ". URL_ADMIN_PAGE);
            
        //} else
          //  $this->returnToPageWithError(URL. "index.php", 4);
        
    }//eof method createSession
    
    
    
    
    
    /*
     * Method to return the error by page. This method receives as parametter the
     * page to be returned and the code of faulty
     */
    public function returnToPageWithError($page, $codeFault){
        
        if ($codeFault == 4){
            header("location: ". $page. "?success");
        } else {
            header("location: ". $page. "?error=". $codeFault);// return to page with fault
        }
        exit();//finalize the execution
        
    }//eof method returnToPageWithError
    
    
    
    
    
    
    /*
     * Method to perform logout and remove the SESSION and return to index page
     */
    public function performLogout(){
        
        unset($_SESSION['id_user']);
        session_destroy();
    
    }//eof method performLogout
    
    
    
    
    
    /*
     * Method to perform the verification about the client is active or not  
     * REFACTOR code add by Edilson Justiniano on day 2013-08-06 REFACTOR
     */
    public function clientIsActive($user) {
        
        if ($user->getIsActive())
            return true;
        
        return false;
    }
    
    
    
    
    /*
     * This method was ad by Edilson Justiniano to find the status of all clients
     * cadastred on system. This information will be used on root administrator page
     * code add on day 2013-08-06 REFACTOR. 
     */
    public function getStatusAllClients() {
      
        $filterByLetter = (isset($_GET['letter'])) ? $_GET['letter'] : NULL;
        
        if ($this->connectionFactoryBI == NULL) {
            $this->connectionFactoryBI = new ConnectionFactoryBI();
        }

        $connection = $this->connectionFactoryBI->createConnectionWithTransaction(FALSE);
        $userBI = new UserBI($connection);
        if (!is_null($statusAllUsers = $userBI->getStatusAllClients($filterByLetter))) {

          $userBI->releaseConnection($connection);
          return $statusAllUsers;
        }
        $userBI->releaseConnection($connection);
        return NULL;
        
     }
     
     
     
     
     
     /*
      * This method was add by Edilson Justiniano on day 2013-08-08 
      */
     public function alterStatusOfClient($idClient,$status){
        if ($this->connectionFactoryBI == NULL) {
            $this->connectionFactoryBI = new ConnectionFactoryBI();
        }
        $connection = $this->connectionFactoryBI->createConnectionWithTransaction(FALSE);
        $userBI = new UserBI($connection);
        if (!is_null($result = $userBI->alterStatusOfClient($idClient, $status))) {
          $userBI->releaseConnection($connection);
          return $result;
        } else {
          $userBI->releaseConnection($connection);
          return NULL;
        }
     }
    
  
     
     /*
      * Method that will go do logout
      */
     public function logout(){
         
//         echo "here!!";
//         exit();
         
         session_unset($_SESSION['id_user']);
         if (isset($_SESSION['admin']))
             session_unset($_SESSION['admin']);
     }
     
     
     
     /*
     * This method was ad by Edilson Justiniano to find the all data of a client
     * cadastred on system. This information will be used on root administrator page
     * code add on day 2013-11-09 REFACTOR. 
     */
    public function getById($id) {
      
        if ($this->connectionFactoryBI == NULL) {
            $this->connectionFactoryBI = new ConnectionFactoryBI();
        }

        $connection = $this->connectionFactoryBI->createConnectionWithTransaction(FALSE);
        $userBI = new UserBI($connection);
        if (!is_null($user = $userBI->getById($id))) {

          $userBI->releaseConnection($connection);
          return $user;
        }
        $userBI->releaseConnection($connection);
        return NULL;
        
     }
     
     
     
     /*
      * Metodo que irá atualizar a senha do usuário passado por parâmetro
      * isso é feito apenas pelo root user (admin)
      * codigo adicionado em 09/11/2013 por Edilson Justiniano
      */
     public function updatePassword($idUser,$password) {
      
        if ($this->connectionFactoryBI == NULL) {
            $this->connectionFactoryBI = new ConnectionFactoryBI();
        }

        $connection = $this->connectionFactoryBI->createConnectionWithTransaction(FALSE);
        $userBI = new UserBI($connection);
        if (!is_null($user = $userBI->updatePassword($idUser,$password))) {

          $userBI->releaseConnection($connection);
          return $user;
        }
        $userBI->releaseConnection($connection);
        return NULL;
        
     }
     
     
     
     
     
  /*
   * Methods add By Edilson Justiniano, on day 12/11/2013. 
   * This methods will be used to find all Users cadastre
   * on system, or only same.
   */
  public function findAll($limit,$orderBy){
      if(is_null($this->connectionFactoryBI)){
          $this->connectionFactoryBI = new ConnectionFactoryBI();
      }
      $connection = $this->connectionFactoryBI->createConnectionWithTransaction(false);
      
      $userBI = new UserBI($connection);
      $usuarios = $userBI->findAll($limit, $orderBy);
      $userBI->releaseConnection($connection);
      
      return $usuarios;
    
  }
     
  
  /*
   * Method that will go search and return a qtde of users
   * stored on system, I can use this information on page of admin
   * list users 
   */
  public function getCount(){
      
      if(is_null($this->connectionFactoryBI)){
          $this->connectionFactoryBI = new ConnectionFactoryBI();
      }
      $connection = $this->connectionFactoryBI->createConnectionWithTransaction(false);
      
      $userBI = new UserBI($connection);
      $qtde = $userBI->getCount();
      $userBI->releaseConnection($connection);
      
      return $qtde;
  }
  
  
  
  /*
   * Method that will remove a user from database
   */
  public function delete($idUser){
      
      if(is_null($this->connectionFactoryBI)){
          $this->connectionFactoryBI = new ConnectionFactoryBI();
      }
      $connection = $this->connectionFactoryBI->createConnectionWithTransaction(false);
      
      $userBI = new UserBI($connection);
      $wasDeleted = $userBI->delete($idUser);
      $userBI->releaseConnection($connection);
      
      return $wasDeleted;
  }
  
  
  
  
  /*
   * Method that will go to make the update of user
   */
   public function updateUser($params) {

        if (is_null($this->connectionFactoryBI)) {
          $this->connectionFactoryBI = new ConnectionFactoryBI();
        }

        $connection = $this->connectionFactoryBI->createConnectionWithTransaction(false);

        $userBI = new UserBI($connection);
        $roleBI = new RoleBI($connection);

        try {
          $user = new User();
          $user->setId($params['user_id']);
          $user->setName($params['name']);
          $user->setMobilePhone($params['mobilePhone']);
          $user->setPhone($params['phone']);
          $user->setEmail($params['email']);
          $user->setUserPhotoPath($params['photo']);
          
          
          //=== Every user is record as a customer.
          $role = $roleBI->getRoleByName("'cliente'");
          $user->setRole($role);

          $wasUpdated = $userBI->updateUser($user);

          $userBI->releaseConnection($connection);
        } catch (Exception $exc) {
          $connection->rollBack();
          $this->connectionFactoryBI()->releaseConnection($connection);
          echo $exc->getTraceAsString();
        }

        $userBI->releaseConnection($connection);
        
        return $wasUpdated;
    }
     
}//eof class UserController

?>
