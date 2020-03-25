<?php
namespace Model;

use Model\BaseModel;

class ProductModel extends BaseModel {

    private $amount;
    private $price;

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

	public function getProductList(){
		$sql = "SELECT p.*, r.rating FROM product as p 
                left join (SELECT product_id, AVG(`value`) as rating FROM rating 
                GROUP BY product_id) as r on p.id = r.product_id";		
		return $this->execSql($sql, array(),true);
	}
}
