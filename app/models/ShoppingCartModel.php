<?php
require_once (PATH_MODELS."/ProductModel.php");
require_once (PATH_MODELS . "/OrderModel.php");
require_once (PATH_MODELS . "/DetailsModel.php");
require_once (PATH_MODELS . "/RatingModel.php");
require_once (PATH_MODELS . "/UserModel.php");

class ShoppingCartModel {

	public function getProducts(){
		$model = new ProductModel();		
		return $model->getProductList();
	}
	
	public function getOrder($orderId){
		$model = new DetailsModel();		
		return $model->getProductList($orderId);
	}

	public function addProduct($orderId, $userId){
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
		return $details->countProducts($orderId);
	}

	public function sumAmount($orderId){
		$details = new DetailsModel();
		$details->setId($_POST["id"]);
		$details->setAmount($_POST["amount"]);
		$details->updateAmount();
		return $details->countProducts($orderId);
	}

	public function removeProduct($orderId){
		$details = new DetailsModel();
		$details->setId($_POST["id"]);
		$details->removeProduct();
		return $details->countProducts($orderId);
	}
	
	public function saveCart($orderId){
		$order = new OrderModel();
		$order->setId($orderId);
		$order->setState(0);
		$order->setTotal($_POST["totalPay"]);
		$order->setShipping($_POST["shippingPay"]);
		$order->update();
		$userModel = new UserModel();
		$balance = $_SESSION['SESSION_USER']->balance - $_POST["totalPay"];
		$userModel->updateBalance($_SESSION['SESSION_USER']->id, $balance);
		$_SESSION['SESSION_USER']->balance = $balance;
		return (object) array(
			'total' => $_POST["totalPay"],
			'previous' => $_SESSION['SESSION_USER']->balance + $_POST["totalPay"],
			'current' => $balance,
			"products" => 4
		);		
	}

	public function saveRating($userId){
		$ratingModel = new RatingModel();
		$rating = $ratingModel->getRatingSave($userId, $_POST["id"]);
		if (!$rating) {
			$ratingModel->setUserId($userId);
			$ratingModel->setProductId($_POST["id"]);
			$ratingModel->setValue($_POST["value"]);
			$ratingModel->save();
		}
		return $ratingModel->getRatingValue($_POST["id"]);
	}

}
