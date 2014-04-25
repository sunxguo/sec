<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller {
	public function index()
	{
		$this->load->view('header',
					array(
						"title"=>"学城网官网-titer唯一二手交易平台",
						"description"=>"太原工业学院二手交易平台，校内线下交易",
						"keywords"=>"太原工业学院，二手交易，titer，校内线下交易"
					));
		$this->load->view('index');
		$this->load->view('footer');
	}
}