<?php
	require_once 'C:\xampp\htdocs\chkList_old\config.php';
	require_once PATH_CONTROLLER. 'UserController.class.php';
	require_once PATH_MODEL_ENTITIES. 'User.class.php';
	$jsonTobj = json_decode(file_get_contents("php://input"), true);

	$name = $jsonTobj['name'];
	$password = $jsonTobj['password'];

	$userController = new UserController();

	$user = $userController->performLogin($name, $password);

	//var_dump($user);

	//var_dump($user);
	$params = array();
	if(!is_null($user)){
		$params['id']       = $user->getId();
		$params['name']     = $user->getName();
		$params['password'] = $user->getPassword();
		$params['email']    = $user->getEmail();
		$params['isActive'] = $user->getIsActive();
		echo json_encode($params);
	}
	/*else{
		$params = false;
	}*/
?>