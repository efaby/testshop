<?php
require_once(PATH_MODELS."/ConnectionModel.php");

class RatingModel {

    private $id;
    private $userId;
    private $productId;
    private $amount;
    private $price;

    public function getId() {
        return $this->id;
    }
 
    public function setId($id) {
        $this->id = $id;
    }

    public function getUserId() {
        return $this->userId;
    }
 
    public function setUserId($userId) {
        $this->userId = $userId;
    }

    public function getProductId() {
        return $this->productId;
    }
 
    public function setProductId($productId) {
        $this->productId = $productId;
    }

    public function getValue() {
        return $this->value;
    }
 
    public function setValue($value) {
        $this->value = $value;
    }

    public function save(){
		$model = new ConnectionModel();	
		$sql = "INSERT INTO rating ( id,user_id,product_id,value)
        VALUES(NULL,
               ".$this->userId.",
               ".$this->productId.",
               ".$this->value.");";	
		return $model->execSql($sql, array(),false, true);
    }

    public function getRatingValue($productId) {
		$model = new ConnectionModel();	
        $sql = "SELECT product_id, AVG(`value`) as rating FROM rating
            where product_id = ?
            GROUP BY product_id";		
		return $model->execSql($sql, array($productId));
    }

    public function getRatingSave($userId, $productId) {
        $model = new ConnectionModel();	
		$sql = "select * from rating where user_id = ? and product_id = ?";
		return $model->execSql($sql, array($userId, $productId));
    }
}