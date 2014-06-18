<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Cinfo extends CI_Controller {
	function __construct(){
		parent::__construct();
		$this->load->helper("base");
		$this->load->helper("orders");
		$this->load->helper("upload");
		$this->load->model("dbHandler");
	}
	public function index(){
		$info=$this->dbHandler->selectPartData('users','u_id',$_SESSION["userid"]);
		$data=array(
				"info"=>$info[0]
		);
		$this->load->view('header',
					array(
						"title"=>"我的学城",
						"description"=>"太原工业学院二手交易平台，校内线下交易",
						"keywords"=>"太原工业学院，二手交易，titer，校内线下交易",
						"showSideCat"=>false,
						"showNav"=>true
					));
		$this->load->view('uc/uc',$data);
		$this->load->view('footer');
	}
	public function about(){
		$this->load->view('header',
					array(
						"title"=>"关于我们",
						"description"=>"太原工业学院二手交易平台，校内线下交易",
						"keywords"=>"太原工业学院，二手交易，titer，校内线下交易",
						"showSideCat"=>false,
						"showNav"=>true
					));
		
		$about=$this->dbHandler->selectPartData('info','i_name',"about");
		$data=array(
				"info"=>$about[0]
		);
		$this->load->view('info/info',$data);
		$this->load->view('footer');
	}
	public function contact(){
		$this->load->view('header',
					array(
						"title"=>"联系我们",
						"description"=>"太原工业学院二手交易平台，校内线下交易",
						"keywords"=>"太原工业学院，二手交易，titer，校内线下交易",
						"showSideCat"=>false,
						"showNav"=>true
					));
		
		$contact=$this->dbHandler->selectPartData('info','i_name',"contact");
		$data=array(
				"info"=>$contact[0]
		);
		$this->load->view('info/info',$data);
		$this->load->view('footer');
	}
	public function link(){
		$this->load->view('header',
					array(
						"title"=>"友情链接",
						"description"=>"太原工业学院二手交易平台，校内线下交易",
						"keywords"=>"太原工业学院，二手交易，titer，校内线下交易",
						"showSideCat"=>false,
						"showNav"=>true
					));
		
		$link=$this->dbHandler->selectPartData('info','i_name',"link");
		$data=array(
				"info"=>$link[0]
		);
		$this->load->view('info/info',$data);
		$this->load->view('footer');
	}
	public function attention(){
		$this->load->view('header',
					array(
						"title"=>"关注我们",
						"description"=>"太原工业学院二手交易平台，校内线下交易",
						"keywords"=>"太原工业学院，二手交易，titer，校内线下交易",
						"showSideCat"=>false,
						"showNav"=>true
					));
		
		$attention=$this->dbHandler->selectPartData('info','i_name',"attention");
		$data=array(
				"info"=>$attention[0]
		);
		$this->load->view('info/info',$data);
		$this->load->view('footer');
	}
}