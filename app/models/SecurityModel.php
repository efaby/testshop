<?php
namespace Model;

use Model\BaseModel;

class SecurityModel extends BaseModel {

	public function valideUser(string $login, string $password){	
		$sql = "select u.id, u.username  
				from `user` as u
				where u.username= '".$login."' and u.password = '".md5($password)."'";
		return $this->execSql($sql, array($login,$password));
	}	
}
