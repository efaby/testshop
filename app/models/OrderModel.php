<?php
require_once(PATH_MODELS."/ConnectionModel.php");

class OrderModel {

    private $id;
    private $userId;
    private $state;
    private $total;
    private $shipping;

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

    public function getState() {
        return $this->state;
    }
 
    public function setState($state) {
        $this->state = $state;
    }

    public function getTotal() {
        return $this->total;
    }
 
    public function setTotal($total) {
        $this->total = $total;
    }

    public function getShipping() {
        return $this->shipping;
    }
 
    public function setShipping($shipping) {
        $this->shipping = $shipping;
    }

	public function save(){
		$model = new ConnectionModel();	
		$sql = "INSERT INTO `order` ( user_id,state,total,shipping)
        VALUES(
               ".$this->userId.",
               ".$this->state.",
               ".$this->total.",
               ".$this->shipping.");";	
		return $model->execSql($sql, array(),false, true);
	}	
	
	public function update(){
		$model = new ConnectionModel();	
		$sql = "UPDATE `order` set 
            state = ".$this->state.",
            total = ".$this->total.",
            shipping = ".$this->shipping." 
            where id = ".$this->id;	
		return $model->execSql($sql, array(),false, true);
    }

    public function getActiveOrder($userId){
        $model = new ConnectionModel();	
		$sql = "select id from `order` where user_id = ? and state = 1";
        $order = $model->execSql($sql, array($userId));
        return $order ? $order->id : 0;
    }
}