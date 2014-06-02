<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller {
	function __construct(){
		parent::__construct();
		$this->load->model("category");
	}
	public function index()
	{	
		$categories=$this->category->_get_categories();
		$products=array();
		foreach($categories as $key=>$cat){
			$products[$key]['cat']=$cat->cat_name;
			$condition["p_cat"]=$cat->cat_id;
			$condition["p_featured"]=true;
			$products[$key]['products']=$this->dbHandler->select_data_by_like('products',array(),$condition,10,0,'p_publishTime','DESC');
		}
		$data=array(
			"products"=>$products
		);
		$this->load->view('header',
					array(
						"title"=>"学城网官网-titer唯一二手交易平台",
						"description"=>"太原工业学院二手交易平台，校内线下交易",
						"keywords"=>"太原工业学院，二手交易，titer，校内线下交易",
						"showSideCat"=>true,
						"cat"=>$categories,
						"showNav"=>true
					));
		$this->load->view('index',$data);
		$this->load->view('footer');
	}
}