<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Cshopping extends CI_Controller {
	function __construct(){
		parent::__construct();
		$this->load->helper("base");
		$this->load->model("dbHandler");
		$this->load->model("category");
	}
	public function get_products_info($name="",$cat="",$scat="",$page=1){
		$condition["p_listed"]=true;
		$like=$name==""?array():array("p_title"=>$name);
		if($cat!="") $condition["p_cat"]=$cat;
		if($scat!="") $condition["p_subCat"]=$scat;
		$amount=$this->dbHandler->amount_data_by_like('products',$like,$condition);
		$page_info=_get_page_info($page,$amount,PRODUCTS_ITEM_NUM);
		$products=$this->dbHandler->select_data_by_like('products',$like,$condition,$page_info['limit'],$page_info['offset'],'p_publishTime','DESC');
		return array(
			"amount"=>$amount,
			"page_amount"=>$page_info['page_amount'],
			"products"=>$products
		);
	}
	public function filter($cat,$scat){
		if($cat!="" && $scat!=""){
			$catId=($scat!="")?$scat:"";
			$cat=$this->dbHandler->selectPartData('category','cat_id',$scat)[0];
			return $cat;
		}
		return false;
	}
	public function index(){
		$page=isset($_GET['page'])?$_GET['page']:1;
		$name=isset($_GET['name'])?$_GET['name']:"";
		$cat=isset($_GET['cat'])?$_GET['cat']:"";
		$scat=isset($_GET['scat'])?$_GET['scat']:"";
		$products_info=$this->get_products_info($name,$cat,$scat,$page);
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
						"showNav"=>true
					));
		$this->load->view('shopping',$data);
		$this->load->view('footer');
	}
	public function product(){
		$this->load->view('header',
					array(
						"title"=>"iphone 5s -学城网",
						"description"=>"太原工业学院二手交易平台，校内线下交易",
						"keywords"=>"太原工业学院，二手交易，titer，校内线下交易",
						"showSideCat"=>true,
						"cat"=>$this->category->_get_categories(),
						"showNav"=>true
					));
		$this->load->view('product');
		$this->load->view('footer');
	}
	public function cart(){
		$this->load->view('header',
					array(
						"title"=>"我的购物车 -学城网",
						"description"=>"太原工业学院二手交易平台，校内线下交易",
						"keywords"=>"太原工业学院，二手交易，titer，校内线下交易",
						"showSideCat"=>false,
						"showNav"=>false
					));
		$this->load->view('cart');
		$this->load->view('footer');
	}
}