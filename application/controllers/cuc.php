<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Cuc extends CI_Controller {
	function __construct(){
		 parent::__construct();
	}
	public function index(){
		$this->load->view('header',
					array(
						"title"=>"我的学城",
						"description"=>"太原工业学院二手交易平台，校内线下交易",
						"keywords"=>"太原工业学院，二手交易，titer，校内线下交易",
						"showSideCat"=>false,
						"showNav"=>true
					));
		$this->load->view('uc');
		$this->load->view('footer');
	}
}