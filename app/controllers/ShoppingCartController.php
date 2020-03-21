<?php
require_once (PATH_MODELS . "/ShoppingCartModel.php");

class ShoppingCartController {
	
	public function products() {
		$model = new ShoppingCartModel();
		$products = $model->getProducts();
		$message = "";
		require_once PATH_VIEWS."/ShoppingCart/view.list.php";
	}

	public function cart() {
		$model = new ShoppingCartModel();
		$products = $model->getOrder($_SESSION['SESSION_USER']->orderId);
		$message = "";
		require_once PATH_VIEWS."/ShoppingCart/view.cart.php";
	}
	
	public function addProduct() {
		$model = new ShoppingCartModel();
		$items = $model->addProduct($_SESSION['SESSION_USER']->orderId, $_SESSION['SESSION_USER']->id);
		$_SESSION['SESSION_USER']->numberItems = $items;
		echo $items;
	}

	public function sumAmount() {
		$model = new ShoppingCartModel();
		echo $model->sumAmount($_SESSION['SESSION_USER']->orderId);
	}

	public function removeProduct() {
		$model = new ShoppingCartModel();
		echo $model->removeProduct($_SESSION['SESSION_USER']->orderId);
	}

	public function saveCart() {
		$model = new ShoppingCartModel();
		$result = $model->saveCart($_SESSION['SESSION_USER']->orderId);
		$_SESSION['SESSION_USER']->orderId = 0;
		$_SESSION['SESSION_USER']->numberItems = 0;
		require_once PATH_VIEWS."/ShoppingCart/view.pay.php";
	}

	public function saveRating() {
		$model = new ShoppingCartModel();
		$result = $model->saveRating($_SESSION['SESSION_USER']->id);
		echo intval ($result->rating);
	}

}
