<?php
namespace Model;
use Model\BaseModel;

class UserModel extends BaseModel {

	public function updateBalance(int $userId, float $balance){
		$sql = "update `user` set balance = balance - ? where id = ?";
		$result = $this->execSql($sql, array($balance, $userId),false,true);
	}
	
	public function getUserBalance(int $userId){	
		$sql = "select balance from `user` where id = ? ";
        $user = $this->execSql($sql, array($userId));
        return $user->balance;
    }
}
