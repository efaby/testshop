<?php
namespace Model;

use interfaces\RegisterInterface;
use Model\BaseModel;

class OrderModel extends BaseModel implements RegisterInterface {
    private $userId;
    private $state;
    private $total;
    private $shipping;

    public function getUserId() {
        return $this->userId;
    }
 
    public function setUserId(int $userId) {
        $this->userId = $userId;
    }

    public function getState() {
        return $this->state;
    }
 
    public function setState(int $state) {
        $this->state = $state;
    }

    public function getTotal() {
        return $this->total;
    }
 
    public function setTotal(float $total) {
        $this->total = $total;
    }

    public function getShipping() {
        return $this->shipping;
    }
 
    public function setShipping(int $shipping) {
        $this->shipping = $shipping;
    }

	public function save(){
		$sql = "INSERT INTO `order` ( user_id,state,total,shipping)
        VALUES(
               ".$this->userId.",
               ".$this->state.",
               ".$this->total.",
               ".$this->shipping.");";	
		return $this->execSql($sql, array(),false, true);
	}	
	
	public function update(){
		$sql = "UPDATE `order` set 
            state = ".$this->state.",
            total = ".$this->total.",
            shipping = ".$this->shipping." 
            where id = ".$this->getId();	
		return $this->execSql($sql, array(),false, true);
    }

    public function getActiveData(int $id){
		$sql = "select id from `order` where user_id = ? and state = 1";
        $order = $this->execSql($sql, array($id));
        return $order ? $order->id : 0;
    }
}