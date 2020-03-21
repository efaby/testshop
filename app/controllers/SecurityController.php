<?php
require_once(PATH_MODELS."/SecurityModel.php");
require_once (PATH_MODELS . "/OrderModel.php");
require_once (PATH_MODELS . "/DetailsModel.php");

class SecurityController {
	
	public function valide(){

		$login = $this->cleanVariables($_POST['username']);
		$password = $this->cleanVariables($_POST['password']);
		$model = new SecurityModel();
		$result= $model->valideUser($login, $password);
		$response['flag'] = 0;
		if($result)
		{
			session_regenerate_id();			
			$_SESSION['SESSION_USER'] = $result;
			$details = new DetailsModel();
			$order = new OrderModel();		 
			$_SESSION['SESSION_USER']->orderId = $order->getActiveOrder($result->id);
			$_SESSION['SESSION_USER']->numberItems = $details->countProducts($_SESSION['SESSION_USER']->orderId);
			session_write_close();		
			$response['data'] = URL_BASE .'ShoppingCart/products/';
				
		} else {
			$response['data'] = 'Invalid credentials.';
			$response['flag'] = 1;
		}
		echo json_encode($response);
		exit();
	}
	
	private function cleanVariables($str){
		$str = @trim($str);
		if(get_magic_quotes_gpc())
		{
			$str = stripslashes($str);
		}
		return addslashes($str);
	}
	
	public function logout(){
		session_start();
		unset($_SESSION["SESSION_USER"]);
		session_destroy();
		header("Location: ".URL_BASE."ShoppingCart/products/");
	}
		
	public function error404(){
		require_once PATH_VIEWS."/Security/view.error404.php";
	}
	
	public function error403(){
		require_once PATH_VIEWS."/Security/view.error403.php";
	}
	
	public function error500(){
		require_once PATH_VIEWS."/Security/view.error500.php";
	}

}