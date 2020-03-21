<?php
require_once(PATH_MODELS."/ConnectionModel.php");

class DetailsModel {

    private $id;
    private $orderId;
    private $productId;
    private $amount;
    private $price;

    public function getId() {
        return $this->id;
    }
 
    public function setId($id) {
        $this->id = $id;
    }

    public function getOrderId() {
        return $this->orderId;
    }
 
    public function setOrderId($orderId) {
        $this->orderId = $orderId;
    }

    public function getProductId() {
        return $this->productId;
    }
 
    public function setProductId($productId) {
        $this->productId = $productId;
    }

    public function getAmount() {
        return $this->total;
    }
 
    public function setAmount($amount) {
        $this->amount = $amount;
    }

    public function getPrice() {
        return $this->price;
    }
 
    public function setPrice($price) {
        $this->price = $price;
    }

    public function getProductList($orderId) {
		$model = new ConnectionModel();	
        $sql = "select details.*, product.name, product.unit, product.image from details 
            inner join product on details.product_id = product.id
            where details.order_id = ?";		
		return $model->execSql($sql, array($orderId),true);
    }

    public function getDetail($orderId, $productId) {
        $model = new ConnectionModel();	
		$sql = "select * from details where order_id = ? and product_id = ?";
		return $model->execSql($sql, array($orderId, $productId));
    }
    
	public function save(){
		$model = new ConnectionModel();	
		$sql = "INSERT INTO details ( id,order_id,product_id,amount,price)
        VALUES(NULL,
               ".$this->orderId.",
               ".$this->productId.",
               ".$this->amount.",
               ".$this->price.");";	
		return $model->execSql($sql, array(),false, true);
	}	
	
	public function updateAmount(){
		$model = new ConnectionModel();	
		$sql = "UPDATE details set 
            amount = ".$this->amount."
            where id = ".$this->id;	
		return $model->execSql($sql, array(),false, true);
    }
    
    public function countProducts($orderId){
        $model = new ConnectionModel();	
		$sql = "select sum(amount) as total from details where order_id = ?";
        $amount = $model->execSql($sql, array($orderId));
        return $amount->total != "" ? $amount->total : 0;
    }

    public function removeProduct(){
        $model = new ConnectionModel();
		$sql = "delete from details where id = ?";
		$model->execSql($sql, array($this->id),false, true);
	}
}