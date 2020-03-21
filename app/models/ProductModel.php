<?php
require_once(PATH_MODELS."/ConnectionModel.php");

class ProductModel {

	private $id;
    private $amount;
    private $price;

    public function getId() {
        return $this->id;
    }
 
    public function setId($id) {
        $this->id = $id;
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

	public function getProductList(){
		$model = new ConnectionModel();	
		$sql = "SELECT p.*, r.rating FROM product as p 
                left join (SELECT product_id, AVG(`value`) as rating FROM rating 
                GROUP BY product_id) as r on p.id = r.product_id";		
		return $model->execSql($sql, array(),true);
	}
}
