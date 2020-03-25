<?php
namespace Model;

use interfaces\RegisterInterface;
use Model\BaseModel;

class DetailsModel extends BaseModel implements RegisterInterface {
    private $orderId;
    private $productId;
    private $amount;
    private $price;

    public function getOrderId() {
        return $this->orderId;
    }
 
    public function setOrderId(int $orderId) {
        $this->orderId = $orderId;
    }

    public function getProductId() {
        return $this->productId;
    }
 
    public function setProductId(int $productId) {
        $this->productId = $productId;
    }

    public function getAmount() {
        return $this->total;
    }
 
    public function setAmount(float $amount) {
        $this->amount = $amount;
    }

    public function getPrice() {
        return $this->price;
    }
 
    public function setPrice(float $price) {
        $this->price = $price;
    }

    public function getProductList(int $orderId) {	
        $sql = "select details.*, product.name, product.unit, product.image from details 
            inner join product on details.product_id = product.id
            where details.order_id = ?";		
		return $this->execSql($sql, array($orderId),true);
    }

    public function getDetail(int $orderId, int $productId) {
		$sql = "select * from details where order_id = ? and product_id = ?";
		return $this->execSql($sql, array($orderId, $productId));
    }
    
	public function save(){	
		$sql = "INSERT INTO details ( id,order_id,product_id,amount,price)
        VALUES(NULL,
               ".$this->orderId.",
               ".$this->productId.",
               ".$this->amount.",
               ".$this->price.");";	
		return $this->execSql($sql, array(),false, true);
	}	
	
	public function updateAmount(){
		$sql = "UPDATE details set 
            amount = ".$this->amount."
            where id = ".$this->getId();	
		return $this->execSql($sql, array(),false, true);
    }
    
    public function getActiveData(int $id){
		$sql = "select sum(amount) as total from details where order_id = ?";
        $amount = $this->execSql($sql, array($id));
        return $amount->total != "" ? $amount->total : 0;
    }

    public function removeProduct(){
		$sql = "delete from details where id = ?";
		$this->execSql($sql, array($this->getId()),false, true);
	}
}