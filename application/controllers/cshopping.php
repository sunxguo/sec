<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Cshopping extends CI_Controller {
	function __construct(){
		parent::__construct();
		$this->load->helper("base");
		$this->load->helper("cart");
		$this->load->model("dbHandler");
		$this->load->model("category");
	}
	public function get_products_info($name="",$cat="",$scat="",$page=1,$order="time",$pro="",$only=""){
		$condition["p_listed"]=true;
		$db_name=array();
		if($name!="") $db_name["p_title"]=$name;
		if($pro!="") $like=explode(',', $pro); else $like=array();
		if($cat!="") $condition["p_cat"]=$cat;
		if($scat!="") $condition["p_subCat"]=$scat;
		if($order=="") $order="time";
		//if($only=="yes") $condition["p_status"]="0";
		$amount=$this->dbHandler->amount_products_data_by_orlike('products',$db_name,$like,$condition);
		$page_info=_get_page_info($page,$amount,PRODUCTS_ITEM_NUM);
		$order_info=$this->products_by_order($order);
		$products=$this->dbHandler->select_products_data_by_orlike('products',$db_name,$like,$condition,$page_info['limit'],$page_info['offset'],$order_info["col"],$order_info["order"]);
		return array(
			"amount"=>$amount,
			"page_amount"=>$page_info['page_amount'],
			"products"=>$products
		);
	}
	public function products_by_order($type){
		$data=array();
		switch($type){
			case "price":
			$data["col"]="p_price";
			$data["order"]="ASC";
			break;
			case "-price":
			$data["col"]="p_price";
			$data["order"]="DESC";
			break;
			case "time":
			$data["col"]="p_publishTime";
			$data["order"]="DESC";
			break;
		}
		return $data;
	}
	public function filter($cat,$scat){
		if($cat!="" && $scat!=""){
			$catId=($scat!="")?$scat:"";
			$cat=$this->dbHandler->selectPartData('category','cat_id',$scat);
			return $cat[0];
		}
		return false;
	}
	public function generate_link($page,$name,$cat,$scat,$order=""){
		$link="/shopping?page=".$page;
		$link.=($name=="")?"":"&name=".$name;
		$link.=($cat=="")?"":"&cat=".$cat;
		$link.=($scat=="")?"":"&scat=".$scat;
		$link.=($order=="")?"":"&order=".$order;
		return $link;
	}
	public function index(){
		$page=isset($_GET['page']) && $_GET['page']!=""?$_GET['page']:1;
		$name=isset($_GET['name'])?$_GET['name']:"";
		$cat=isset($_GET['cat'])?$_GET['cat']:"";
		$scat=isset($_GET['scat'])?$_GET['scat']:"";
		$order=isset($_GET['order'])?$_GET['order']:"time";
		$pro=isset($_GET['pro'])?$_GET['pro']:"";
		$only=isset($_GET['only'])?$_GET['only']:"";
		$products_info=$this->get_products_info($name,$cat,$scat,$page,$order,$pro,$only);
		$page_amount=$products_info["page_amount"];
		$data=$products_info;
		$data["page_current"]=$page;
		$data["filter"]=$this->filter($cat,$scat);
		$this->load->view('header',
					array(
						"title"=>"学城网官网-titer唯一二手交易平台",
						"description"=>"太原工业学院二手交易平台，校内线下交易",
						"keywords"=>"太原工业学院，二手交易，titer，校内线下交易",
						"showSideCat"=>true,
						"cat"=>$this->category->_get_categories(),
						"showNav"=>true,
						"pre_link"=>$page<=1?"javascript:void();":$this->generate_link($page-1,$name,$cat,$scat,$order),
						"next_link"=>$page>=$page_amount?"javascript:void();":$this->generate_link($page-1,$name,$cat,$scat,$order)
					));
		$this->load->view('shopping',$data);
		$this->load->view('footer');
	}
	public function product(){
		if(isset($_GET['id']) && $_GET['id']!="" && is_numeric($_GET['id'])){
			$pid=$_GET['id'];
			$product=$this->dbHandler->selectPartData('products','p_id',$pid);
			if(count($product)>0){
				$merchant=$this->get_merchant($product[0]->p_userId);
				$show=0;
				if(isset($_SESSION['userid']))$show=$this->dbHandler->amount_data_by_like('orders',array("o_products"=>$pid),array("o_purchaser"=>$_SESSION['userid']));
				$this->load->view('header',
						array(
							"title"=>$product[0]->p_title."-学城网",
							"description"=>"太原工业学院二手交易平台，校内线下交易",
							"keywords"=>"太原工业学院，二手交易，titer，校内线下交易",
							"showSideCat"=>true,
							"cat"=>$this->category->_get_categories(),
							"showNav"=>true
				));
				$this->load->view('product',array("product"=>$product[0],"merchant"=>$merchant,"show"=>$show));
			}else{
				$this->load->view('header',
						array(
							"title"=>"找不到该商品",
							"description"=>"太原工业学院二手交易平台，校内线下交易",
							"keywords"=>"太原工业学院，二手交易，titer，校内线下交易",
							"showSideCat"=>true,
							"cat"=>$this->category->_get_categories(),
							"showNav"=>true
				));
				$this->load->view('404',array("message"=>"抱歉，找不到该商品"));
			}
		}else{
				$this->load->view('header',
						array(
							"title"=>"找不到该商品",
							"description"=>"太原工业学院二手交易平台，校内线下交易",
							"keywords"=>"太原工业学院，二手交易，titer，校内线下交易",
							"showSideCat"=>true,
							"cat"=>$this->category->_get_categories(),
							"showNav"=>true
				));
			$this->load->view('404',array("message"=>"抱歉，找不到该商品"));
		}
		$this->load->view('footer');
	}
	public function cart(){
		$data=array(
			"cartsInfo"=>$this->getCartListByMerchants(),
		);
		$this->load->view('header',
					array(
						"title"=>"我的购物车 -学城网",
						"description"=>"太原工业学院二手交易平台，校内线下交易",
						"keywords"=>"太原工业学院，二手交易，titer，校内线下交易",
						"showSideCat"=>false,
						"showNav"=>false
					));
		$this->load->view('cart',$data);
		$this->load->view('footer');
	}
	public function get_merchant($id){
		$merchant=$this->dbHandler->selectPartData('users','u_id',$id);
		return $merchant[0];
	}
	public function get_product($id){
		$product=$this->dbHandler->selectPartData('products','p_id',$id);
		return count($product)>0?$product[0]:array();
	}
	public function put_to_cart(){
		$product=$this->get_product($_POST['id']);
		if($product->p_status!=0){
			echo json_encode(array("code"=>false,"message"=>"抱歉，该商品已被预定"));
			return false;
		}
		if(add_to_cart($_POST['id'],$product->p_userId)){
			echo json_encode(array("code"=>true,"message"=>"添加成功"));
		}else echo json_encode(array("code"=>false,"message"=>"您已经加入到购物车"));
	}
	public function removeFromCart(){
		if(removeFromCart($_POST['id'])) 
		echo json_encode(array("code"=>true,"message"=>"删除成功"));
		else echo json_encode(array("code"=>false,"message"=>"删除失败"));
	}
	public function buyCart(){
		if(!checkLogin()){
			$this->load->view('redirect',array("message"=>"请先登录"));
			return;
		}
		$error=false;
		$data=$this->getCartListByMerchants();
		foreach($data as $id=>$merchant){
			$products_array=array();
			$total_price=0;
			foreach($merchant['products'] as $key=>$product){
				array_push($products_array,$key);
				$total_price+=$product->p_price;
			}
			$order=array(
					"o_number"=>$this->build_order_no(),//订单号
					"o_purchaser"=>$_SESSION['userid'],
					"o_seller"=>$id,
					"o_address"=>$_POST['address'.$id],//
					"o_status"=>"new",
					"o_total"=>$total_price,
					"o_products"=>serialize($products_array),
					"o_note"=>$_POST['note'.$id],
					"o_discount"=>0,
					"o_time"=>date("Y-m-d H:i:s")
			);
			$result=$this->dbHandler->insertdata('orders',$order);
			if($result==0) $error=true;
			else 
			foreach($products_array as $product){
				removeFromCart($product);
				$this->update_product_status($product,1);
			}
		}
		if($error) 	$this->load->view('redirect',array("message"=>"提交订单失败"));
		else $this->load->view('redirect',array("message"=>"提交成功，您现在可以联系卖家进行线下交易","url"=>"/uc/purchaser_orders"));

	}
	public function is_bought_product(){
		$id=$_POST["id"];
		$product=$this->dbHandler->selectPartData('products','p_id',$id);
		if($product[0]->p_status==0) echo json_encode(array("code"=>false,"message"=>'未被预定'));
		else echo json_encode(array("code"=>false,"message"=>'被预定'));
	}
	public function buy_product(){
		if(!checkLogin()){
			echo json_encode(array("code"=>false,"message"=>'请先登录'));
			return;
		}
		$product_id=$_POST['id'];
		$product_info=$this->get_product($product_id);
		$order=array(
				"o_number"=>$this->build_order_no(),//订单号
				"o_purchaser"=>$_SESSION['userid'],
				"o_seller"=>$product_info->p_userId,
				"o_address"=>"",//
				"o_status"=>"new",
				"o_total"=>$product_info->p_price,
				"o_products"=>serialize(array($product_id)),
				"o_note"=>"",
				"o_discount"=>0,
				"o_time"=>date("Y-m-d H:i:s")
		);
		$result=$this->dbHandler->insertdata('orders',$order);
		if($result==0) echo json_encode(array("code"=>false,"message"=>'提交失败'));
		else{
			$this->update_product_status($product_id,1);
			echo json_encode(array("code"=>true,"message"=>'提交成功，可联系卖家交易'));
		}
	}
	public function build_order_no()
	{
		return substr(implode(NULL, array_map('ord', str_split(substr(uniqid(), 7, 13), 1))), 0, 8);
	}
	public function getCartListByMerchants(){
		_ensureCartInSession();
		$cart = ($_SESSION['cart']);
		$result = array();
		foreach($cart as $product_id => $item) {
			$merchant_id = $item["merchant"];
			if(!array_key_exists($merchant_id, $result)) {
				$merchant_info = $this->get_merchant($merchant_id);
				$result[$merchant_id] = array(
					"merchant_info" => $merchant_info,
					"products" => array(),
				);
			}
			$product_info = $this->get_product($product_id);
			$result[$merchant_id]["products"][$product_id] = $product_info;
		}
		return $result;
	}
	public function update_product_status($id,$status){
		$data=array("p_status"=>$status);
		$result=$this->dbHandler->updatedata("products",$data,"p_ID",$id);
		if($result==0)  return false;
		else  return true;
	}
	public function get_mini_cart(){
		$cart=isset($_SESSION["cart"])?$_SESSION["cart"]:array();
		$products=array();
		foreach($cart as $key=>$item){
			$product=$this->get_product($key);
			@$imgs=unserialize($product->p_images);
			@$product->p_images=$imgs[0];
			array_push($products,$product);
		}
		echo json_encode($products);
	}
}