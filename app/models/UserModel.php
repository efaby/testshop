<?php
require_once(PATH_MODELS."/ConnectionModel.php");

class UserModel {
	public function updateBalance($userId, $balance){
		$sql = "update `user` set balance = ? where id = ?";
		$model = new ConnectionModel();
		$result = $model->execSql($sql, array($balance, $userId),false,true);
	}
}
