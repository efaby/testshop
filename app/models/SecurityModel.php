<?php
require_once(PATH_MODELS."/ConnectionModel.php");

class SecurityModel {

	public function valideUser($login, $password){
		$model = new ConnectionModel();	
		$sql = "select u.id, u.username, u.balance 
				from `user` as u
				where u.username= '".$login."' and u.password = '".md5($password)."'";
		return $model->execSql($sql, array($login,$password));
	}	
}
