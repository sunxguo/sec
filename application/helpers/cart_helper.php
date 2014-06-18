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
/**
 * 从购物车中删除商品
 * @param string $product_id
 * @return bool success
 */
function removeFromCart($product_id){
	_ensureCartInSession();

	unset($_SESSION["cart"][$product_id]);
	return true;
}

function getCartListByMerchants(){
	_ensureCartInSession();
	$cart = ($_SESSION['cart']);
	$result = array();
	foreach($cart as $product_id => $item) {
		$merchant_id = $item["merchant"];
		$merchant_info = _getMerchantInfoFromDB($merchant_id);
		$product_info = _getProductInfoFromDB($product_id); 
		$result[$merchant_id] = array(
			"merchant_info" => $merchant_info,
			"products" => array(),
		);
		$result[$merchant_id]["products"][$product_id] = $product_info;
	}
	return $result;
}

function _getMerchantInfoFromDB($id){
	$merchant=$this->dbHandler->selectPartData('users','u_id',$id);
	return $merchant[0];
}
function _getProductInfoFromDB($id){
	$product=$this->dbHandler->selectPartData('products','p_id',$id);
	return $product[0];
}
?>

