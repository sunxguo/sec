<?php

@session_start();
function _ensureCartInSession() {
	if(!isset($_SESSION['cart'])) {
		$_SESSION['cart'] = array();
	}
}
function add_to_cart($product_id,$merchant_id){
	_ensureCartInSession();
	$cart = $_SESSION['cart'];
	if(array_key_exists($product_id, $cart)) {
		return false;
	}
	$cart[$product_id]["merchant"] = $merchant_id;
	$_SESSION['cart'] =($cart);
	return true;
}
function getCartListByMerchants(){
	_ensureCartInSession();
	
}
?>

