<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Cadmin extends CI_Controller {
	function __construct(){
		parent::__construct();
		$this->load->helper("base");
		$this->load->helper("orders");
		$this->load->helper("upload");
		$this->load->model("dbHandler");
	}
	public function index(){
		if(!checkLogin()){
			$this->load->view('redirect',array("message"=>"请先登录","url"=>"/"));
			return;
		}
		$data=array(
				"name"=>$_SESSION['name'],
		);
		$this->load->view('header',
					array(
						"title"=>"我的学城",
						"description"=>"太原工业学院二手交易平台，校内线下交易",
						"keywords"=>"太原工业学院，二手交易，titer，校内线下交易",
						"showSideCat"=>false,
						"showNav"=>true
					));
		$this->load->view('admin/login',$data);
		$this->load->view('footer');
	}
}