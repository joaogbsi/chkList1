<?php

/**
 * Description of UserDAO
 * This class is responsible about every events performed by users.i.e Login,
 * cadastre of clients...
 *
 * @author Daniel / updated by Edilson Justiniano
 */

/*
 * INCLUDE SECTOR
 */

// include the file of configuration
// require_once '../config.php';
// require_once PATH .'config.php';
// require_once '/home/arqui937/public_html/config.php';
// require_once '/opt/lampp/htdocs/arquivoImobiliario/config.php';
/*$filename = '/home/arqui937/public_html/config.php';
if (file_exists ( $filename )) {
	require_once '/home/arqui937/public_html/config.php';
} else {
	require_once '/opt/lampp/htdocs/arquivoImobiliario/config.php';
}*/

require_once PATH_MODEL_ENTITIES . 'User.class.php';
//require_once PATH_MODEL_ENTITIES . 'Role.class.php';
class UserDAO {
	private $connection;
	function __construct($connection) {
		$this->connection = $connection;
		$this->connection->setAttribute ( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
	}
	public function insert(User $user) {
		try {
			$sql = "INSERT INTO  users (
                name,
                password,
                mobile_phone,
                phone,
                email,
                user_photo_path,
                role)
              VALUES (
                :name,
                :password,
                :mobilePhone,
                :phone,
                :email,
                :userPhotoPath,
                :role)";
			$stmt = $this->connection->prepare ( $sql );
			
			$params = array (
					"name" => $user->getName (),
					"password" => $user->getPassword (),
					"mobilePhone" => $user->getMobilePhone (),
					"phone" => $user->getPhone (),
					"email" => $user->getEmail (),
					"userPhotoPath" => $user->getUserPhotoPath (),
					"role" => $user->getRole ()->getId () 
			);
			
			$stmt->execute ( $params );
		} catch ( PDOException $exc ) {
			var_dump ( $stmt->errorInfo () );
			echo "<br />";
			echo $exc->getTraceAsString ();
			exit ();
		}
	}
	public function update($user) {
		try {
			$sql = "UPDATE users SET name = :name,
            mobile_phone = :mobilePhone,phone = :phone,email = :email";
			
			if ($user->getUserPhotoPath () != "")
				$sql .= ",user_photo_path = :userPhotoId";
			
			$sql .= " WHERE id = :id;";
			
			$stmt = $this->connection->prepare ( $sql );
			if ($user->getUserPhotoPath () != "") {
				if ($stmt->execute ( array (
						':name' => $user->getName (),
						':mobilePhone' => $user->getMobilePhone (),
						':phone' => $user->getPhone (),
						':email' => $user->getEmail (),
						':userPhotoId' => $user->getUserPhotoPath (),
						':id' => $user->getId () 
				) ))
					return true;
				
				return false;
			} else {
				if ($stmt->execute ( array (
						':name' => $user->getName (),
						':mobilePhone' => $user->getMobilePhone (),
						':phone' => $user->getPhone (),
						':email' => $user->getEmail (),
						':id' => $user->getId () 
				) ))
					return true;
				
				return false;
			}
		} catch ( PDOException $exc ) {
			var_dump ( $stmt->errorInfo () );
			echo "<br />";
			echo $exc->getTraceAsString ();
			exit ();
		}
	}
	public function delete($id) {
		
		/*
		 * Changed by Edilson Justiniano in 13/11/2013. I add
		 * this DELETE to delete the all service provider
		 * byy user informed
		 */
		try {
			$sql = "DELETE FROM user_service WHERE id_user = :id_user";
			
			$stmt = $this->connection->prepare ( $sql );
			$stmt->execute ( array (
					":id_user" => $id 
			) );
		} catch ( PDOException $exc ) {
			var_dump ( $stmt->errorInfo () );
			echo "<br />";
			echo $exc->getTraceAsString ();
			exit ();
		}
		
		try {
			$sql = "DELETE FROM users WHERE id = :id";
			
			$stmt = $this->connection->prepare ( $sql );
			$stmt->execute ( array (
					":id" => $id 
			) );
			return true;
		} catch ( PDOException $exc ) {
			var_dump ( $stmt->errorInfo () );
			echo "<br />";
			echo $exc->getTraceAsString ();
			exit ();
		}
	}
	public function findById($id) {
		try {
			$user = new User ();
			$sql = "SELECT * FROM  users WHERE id = :id;";
			
			$stmt = $this->connection->prepare ( $sql );
			
			if ($stmt->execute ( array (
					'id' => $id 
			) )) {
				while ( $row = $stmt->fetch () ) {
					$user = $this->row2user ( $row );
				}
				return $user;
			}
			return NULL;
		} catch ( PDOException $exc ) {
			var_dump ( $stmt->errorInfo () );
			echo "<br />";
			echo $exc->getTraceAsString ();
			exit ();
		}
	}
	public function findAll($limit = NULL, $orderBy = NULL) {
		try {
			// $users[] = array();
			$sql = "SELECT * FROM  users";
			
			if (! is_null ( $orderBy ))
				$sql .= " ORDER BY " . $orderBy;
			if (! is_null ( $limit ))
				$sql .= " LIMIT " . $limit . " OFFSET 0";
			
			$sql .= ";";
			
			$stmt = $this->connection->prepare ( $sql );
			if ($stmt->execute ()) {
				$flag = false;
				
				while ( $row = $stmt->fetch () ) {
					$usuarios [] = $this->row2user ( $row );
					$flag = TRUE;
				}
				
				if ($flag) {
					return $usuarios;
				}
			} else {
				return NULL;
			}
		} catch ( PDOException $exc ) {
			var_dump ( $stmt->errorInfo () );
			echo "<br />";
			echo $exc->getTraceAsString ();
			exit ();
		}
	}
	public function findByCriteria($stringCriteria) {
		try {
			$users [] = array ();
			$sql = "SELECT * FROM  users " . $stringCriteria . ";";
			
			$stmt = $this->connection->prepare ( $sql );
			if ($stmt->execute ()) {
				while ( $row = $stmt->fetch () ) {
					$users [] = $this->row2user ( $row );
				}
				return $users;
			}
			return NULL;
		} catch ( PDOException $exc ) {
			var_dump ( $stmt->errorInfo () );
			echo "<br />";
			echo $exc->getTraceAsString ();
			exit ();
		}
	}
	public function findUniqueByCriteria($stringCriteria) {
		try {
			// $user = new User();
			$sql = "SELECT * FROM  users " . $stringCriteria . ";";
			
			$stmt = $this->connection->prepare ( $sql );
			//echo $sql;
			
			if ($stmt->execute ()) {
				$row = $stmt->fetch ();
				if ($row)
					$user = $this->row2user ( $row );
				else
					return NULL;
				return $user;
			} else {
				return NULL;
			}
		} catch ( PDOException $exc ) {
			var_dump ( $stmt->errorInfo () );
			echo "<br />";
			echo $exc->getTraceAsString ();
			exit ();
		}
	}
	public function row2user($row) {
		$user = new User ();
		
		$user->setId ( $row ['id'] );
		$user->setName ( $row ['name'] );
		$user->setPassword ( $row ['password'] );
		$user->setEmail ( $row ['email'] );
		
		/*
		 * This last lines was inserted by Edilson Justiniano on day 2013-07-29
		 * they was inserted for the system of login, with this information
		 * will can known if the user is the administrator or not.
		 * This is a new implementation
		 */
		
		/*
		 * the below line was inserted by Edilson Justiniano on day 2013-08-06
		 * to atend (answer) ATENDER the requirements of client this information
		 * will be used on login system to verify if client is active or not
		 */
		$user->setIsActive ( $row ['is_active'] );

		//var_dump($user);
		
		return $user;
	}
	
	/*
	 * REFACTORS (NEW METHODS)
	 */
	
	/*
	 * method for find and return the id and its status of every client
	 * This method is used to list of clients cadastred on system
	 * for the administrator user can update its status (active or not)
	 */
	public function getStatusAllClients($filterByLetter = NULL) {
		try {
			
			if ($filterByLetter) {
				$sql = "SELECT id,name,phone,email,is_active FROM users where UPPER(name) LIKE '" . $filterByLetter . "%' and role <> 2 order by name;";
			} else {
				$sql = "SELECT id,name,phone,email,is_active FROM users where role <> 2 order by name;";
			}
			
			$stmt = $this->connection->prepare ( $sql );
			if ($stmt->execute ()) {
				while ( $row = $stmt->fetch () ) {
					$statusAllUsers [] = $this->rowStatusAllClients ( $row );
				}
				
				return $statusAllUsers;
			}
			return NULL;
		} catch ( PDOException $exc ) {
			var_dump ( $stmt->errorInfo () );
			echo "<br />";
			echo $exc->getTraceAsString ();
			exit ();
		}
	}
	
	/*
	 * Methos similar the row2user, but this method insert minus information
	 * about the client on array, I did can use the method findAll but
	 * much information did be unneeded
	 */
	public function rowStatusAllClients($row) {
		$statusAllUser = new User ();
		
		$statusAllUser->setId ( $row ['id'] );
		$statusAllUser->setName ( $row ['name'] );
		$statusAllUser->setPhone ( $row ['phone'] );
		$statusAllUser->setEmail ( $row ['email'] );
		$statusAllUser->setIsActive ( $row ['is_active'] );
		
		return $statusAllUser;
	}
	public function alterStatusOfClient($idClient, $status) {
		try {
			
			$sql = "UPDATE users set is_active=$status WHERE id=" . $idClient;
			$stmt = $this->connection->prepare ( $sql );
			if ($stmt->execute ()) {
				return true;
			} else {
				return false;
			}
		} catch ( PDOException $exc ) {
			echo $exc->getTraceAsString ();
			print_r ( $stmt->errorInfo () );
			exit ();
		}
	}
	
	/*
	 * Método que irá realmente salvar a nova senha do usuário
	 * no banco de dados e retornar true ou false
	 * ele recebe como parâmetro o id do usuário e
	 * a senha já codificada em MD5.
	 */
	public function updatePassword($idUser, $password) {
		try {
			
			$sql = "UPDATE users set password= :password WHERE id= :id";
			$stmt = $this->connection->prepare ( $sql );
			if ($stmt->execute ( array (
					':password' => $password,
					':id' => $idUser 
			) )) {
				return true;
			} else {
				return false;
			}
		} catch ( PDOException $exc ) {
			echo $exc->getTraceAsString ();
			print_r ( $stmt->errorInfo () );
			exit ();
		}
	}
	
	/*
	 * Method that will go search and return a qtde of users
	 * stored on system, I can use this information on page of admin
	 * list users
	 */
	public function getCount() {
		try {
			$sql = "SELECT COUNT(u.id) as qtde FROM users AS u";
			
			$stmt = $this->connection->prepare ( $sql );
			
			if ($stmt->execute ()) {
				
				$row = $stmt->fetch ();
				return $row ['qtde'];
			} else {
				return NULL;
			}
		} catch ( PDOException $exc ) {
			echo $exc->getTraceAsString ();
			print_r ( $stmt->errorInfo () );
			exit ();
		}
	}
}

?>
