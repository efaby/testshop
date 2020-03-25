<?php
namespace Model;

use Model\ProductModel;
use Model\OrderModel;
use Model\DetailsModel;
use Model\RatingModel;
use Model\UserModel;


class ShoppingCartModel {

	public function getProducts(){
		$model = new ProductModel();		
		return $model->getProductList();
	}
	
	public function getOrder(int $orderId){
		$model = new DetailsModel();		
		return $model->getProductList($orderId);
	}

	public function addProduct(int $orderId, int $userId){
		$product = new ProductModel();
		$product->setId($_POST["id"]);
		$product->setPrice($_POST["price"]);
		$product->setAmount($_POST["amount"]);

		if (!$orderId) {
			$order = new OrderModel();
			$order->setUserId($userId);
			$order->setState(1);
			$order->setTotal($product->getPrice());
			$order->setShipping(0);
			$orderId = $order->save();
			$_SESSION['SESSION_USER']->orderId = $orderId;
		}
		$details = new DetailsModel();
		$detail = $details->getDetail($orderId, $product->getId());
		if ($detail) {
			$details->setId($detail->id);
			$details->setAmount($detail->amount + 1);
			$details->updateAmount();
		} else {
			$details->setOrderId($orderId);
			$details->setPrice($product->getPrice());
			$details->setProductId($product->getId());
			$details->setAmount(1);
			$details->save();
		}
		return $details->getActiveData($orderId);
	}

	public function sumAmount(int $orderId){
		$details = new DetailsModel();
		$details->setId($_POST["id"]);
		$details->setAmount($_POST["amount"]);
		$details->updateAmount();
		return $details->getActiveData($orderId);
	}

	public function removeProduct(int $orderId){
		$details = new DetailsModel();
		$details->setId($_POST["id"]);
		$details->removeProduct();
		return $details->getActiveData($orderId);
	}
	
	public function saveCart(int $orderId){
		$order = new OrderModel();
		$order->setId($orderId);
		$order->setState(0);
		$order->setTotal($_POST["totalPay"]);
		$order->setShipping($_POST["shippingPay"]);
		$order->update();
		$userModel = new UserModel();
		$userModel->updateBalance($_SESSION['SESSION_USER']->id, $_POST["totalPay"]);
		$balance = $userModel->getUserBalance($_SESSION['SESSION_USER']->id);
		return (object) array(
			'total' => $_POST["totalPay"],
			'previous' => $balance + $_POST["totalPay"],
			'current' => $balance,
			"products" => 4
		);		
	}

	public function saveRating(int $userId){
		$ratingModel = new RatingModel();
		$rating = $ratingModel->getRatingSave($userId, $_POST["id"]);
		if (!$rating) {
			$ratingModel->setUserId($userId);
			$ratingModel->setProductId($_POST["id"]);
			$ratingModel->setValue($_POST["value"]);
			$ratingModel->save();
		}
		return $ratingModel->getActiveData($_POST["id"]);
	}

	public function valideBalance(int $userId){
		$userModel = new UserModel();
		$total = $_POST["totalPay"];
		$balance = $userModel->getUserBalance($userId);
		return $balance > $total;		
	}
}
