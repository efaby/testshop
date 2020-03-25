<?php
namespace Model;

use interfaces\RegisterInterface;
use Model\BaseModel;

class RatingModel extends BaseModel implements RegisterInterface {
    private $userId;
    private $productId;
    private $amount;
    private $price;

    public function getUserId() {
        return $this->userId;
    }
 
    public function setUserId(int $userId) {
        $this->userId = $userId;
    }

    public function getProductId() {
        return $this->productId;
    }
 
    public function setProductId(int $productId) {
        $this->productId = $productId;
    }

    public function getValue() {
        return $this->value;
    }
 
    public function setValue(int $value) {
        $this->value = $value;
    }

    public function save(){
		$sql = "INSERT INTO rating ( id,user_id,product_id,value)
        VALUES(NULL,
               ".$this->userId.",
               ".$this->productId.",
               ".$this->value.");";	
		return $this->execSql($sql, array(),false, true);
    }

    public function getActiveData(int $id) {
        $sql = "SELECT product_id, AVG(`value`) as rating FROM rating
            where product_id = ?
            GROUP BY product_id";		
		return $this->execSql($sql, array($id));
    }

    public function getRatingSave(int $userId, int $productId) {
		$sql = "select * from rating where user_id = ? and product_id = ?";
		return $this->execSql($sql, array($userId, $productId));
    }
}