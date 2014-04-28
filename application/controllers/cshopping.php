<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Cshopping extends CI_Controller {
	function __construct(){
		 parent::__construct();
	}
	public function index(){
		$this->load->view('header',
					array(
						"title"=>"学城网官网-titer唯一二手交易平台",
						"description"=>"太原工业学院二手交易平台，校内线下交易",
						"keywords"=>"太原工业学院，二手交易，titer，校内线下交易",
						"showSideCat"=>true,
						"showNav"=>true
					));
		$this->load->view('shopping');
		$this->load->view('footer');
	}
	public function product(){
		$this->load->view('header',
					array(
						"title"=>"iphone 5s -学城网",
						"description"=>"太原工业学院二手交易平台，校内线下交易",
						"keywords"=>"太原工业学院，二手交易，titer，校内线下交易",
						"showSideCat"=>true,
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