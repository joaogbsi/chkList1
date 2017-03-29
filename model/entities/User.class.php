<?php

/**
 * Description of User
 *
 * @author Daniel / updated by Edilson Justiniano
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

//require_once PATH_MODEL_ENTITIES. 'Role.class.php';


class User {

  private $id;
  private $name;
  private $password;
  
  private $email;
  
  /*
   * Attribute add by Edilson Justiniano on day 2013-08-06 
   * to perform the REFACTOR conform solicited by Client
   */
  private $isActive;
  

  public function getId() {
    return $this->id;
  }

  public function setId($id) {
    $this->id = $id;
  }

  public function getName() {
    return $this->name;
  }

  public function setName($name) {
    $this->name = $name;
  }

  public function getPassword() {
    return $this->password;
  }

  public function setPassword($password) {
    $this->password = $password;
  }

  public function getEmail() {
    return $this->email;
  }

  public function setEmail($email) {
    $this->email = $email;
  }

   /*
   * Methods Getters and Setters solicited by client
   * this attribute will be allow to lock and to unlock
   * the client by Root Administrator add by Edilson Justiniano
   * on day 2013-08-06
   */
  public function getIsActive() {
      return $this->isActive;
  }
  
  public function setIsActive($isActive) {
      $this->isActive = $isActive;
  }

}

?>
