<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Cadmin extends CI_Controller {
	function __construct(){
		parent::__construct();
		$this->load->helper("base");
		$this->load->helper("orders");
		$this->load->helper("upload");
		$this->load->model("dbHandler");
		$this->load->model("category");
	}
	public function login(){
		if(checkAdminLogin()){
			$this->load->view('redirect',array("message"=>"已登录","url"=>"/admin/index"));
			return;
		}
		$this->load->view('admin/login',
					array(
						"title"=>"后台登录",
						"description"=>"太原工业学院二手交易平台，校内线下交易",
						"keywords"=>"太原工业学院，二手交易，titer，校内线下交易"
					));
	}
	public function index(){
		if(!checkAdminLogin()){
			$this->load->view('redirect',array("message"=>"未登录","url"=>"/admin/login"));
			return;
		}
		$this->load->view('header',
					array(
						"title"=>"后台",
						"description"=>"太原工业学院二手交易平台，校内线下交易",
						"keywords"=>"太原工业学院，二手交易，titer，校内线下交易",
						"showAdminSideCat"=>true,
						"showNav"=>true
					));
		$this->load->view('admin/index');
		$this->load->view('footer');
	}
	public function users(){
		if(!checkAdminLogin()){
			$this->load->view('redirect',array("message"=>"未登录","url"=>"/admin/login"));
			return;
		}
		$this->load->view('header',
					array(
						"title"=>"后台",
						"description"=>"太原工业学院二手交易平台，校内线下交易",
						"keywords"=>"太原工业学院，二手交易，titer，校内线下交易",
						"showAdminSideCat"=>true,
						"showNav"=>true,
						"adminNaviUsers"=>true
					));
		$this->load->view('admin/users');
		$this->load->view('footer');
	}
	public function cats(){
		if(!checkAdminLogin()){
			$this->load->view('redirect',array("message"=>"未登录","url"=>"/admin/login"));
			return;
		}
		$categories=$this->category->_get_categories();
		$data=array("categories"=>$categories);
		//print_r($categories);
		$this->load->view('header',
					array(
						"title"=>"后台",
						"description"=>"太原工业学院二手交易平台，校内线下交易",
						"keywords"=>"太原工业学院，二手交易，titer，校内线下交易",
						"showAdminSideCat"=>true,
						"showNav"=>true,
						"adminNaviCats"=>true
					));
		$this->load->view('admin/cats',$data);
		$this->load->view('footer');
	}
	public function addCat(){
		if(!checkAdminLogin()){
			$this->load->view('redirect',array("message"=>"未登录","url"=>"/admin/login"));
			return;
		}
		$categories=$this->category->_get_categories();
		$data=array("categories"=>$categories);
		//print_r($categories);
		$this->load->view('header',
					array(
						"title"=>"后台",
						"description"=>"太原工业学院二手交易平台，校内线下交易",
						"keywords"=>"太原工业学院，二手交易，titer，校内线下交易",
						"showAdminSideCat"=>true,
						"showNav"=>true,
						"adminNaviAddCat"=>true
					));
		$this->load->view('admin/addCat',$data);
		$this->load->view('footer');
	}
	public function addNewCat(){
		$imgurl=upload("image")["message"];
		$fid=0;
		if($_POST['type']==2){
			$fid=$_POST['cat'];
		}
		$data=array(
				"cat_fid"=>$fid,
				"cat_name"=>$_POST['catname'],
				"cat_property"=>$_POST['property'],
				"cat_img"=>$imgurl
		);
		$result=$this->dbHandler->insertdata('category',$data);
		if($result==0) $this->load->view('redirect',array("message"=>"添加失败"));
		else $this->load->view('redirect',array("message"=>"添加成功","url"=>"/admin/addCat"));
	}
	public function saveCat(){
		if(!isset($_POST['id']) || !isset($_POST['property'])){
			echo   $this->load->view('redirect',array("message"=>"修改失败"));
			return;
		}
		$data=array(
			"cat_property"=>$_POST['property']
		);
		$img_result=upload("img");
		if($img_result["code"]) $data["cat_img"]=$img_result["message"];
		$result=$this->dbHandler->updatedata("category",$data,"cat_id",$_POST['id']);
		if($result==0)  $this->load->view('redirect',array("message"=>"修改失败"));
		else $this->load->view('redirect',array("message"=>"修改成功","url"=>"/admin/cats"));
	}
	/*onclick="save_cat('<?=$scat->cat_id?>')"*/
	public function adminLogin(){
		if(isset($_POST['username']) && isset($_POST['pwd'])){
			$userName=$_POST['username'];
			$pwd=md5('xuechengwadmin'.$_POST['pwd']);
			$user_info=$this->dbHandler->selectPartData('managers','m_name',$userName);
			if(count($user_info)==0){
				$this->load->view('redirect',array("message"=>"用户名".$userName."不存在"));
				return;
			}
			$user_info=$user_info[0];
			if($user_info->m_pwd != $pwd){
				$this->load->view('redirect',array("message"=>"密码错误"));
				return;
			}
			$_SESSION["userid"]=$user_info->m_id;
			$_SESSION["name"]=$user_info->m_name;
			$_SESSION["type"]="admin";
			$this->load->view('redirect',array("url"=>"/admin/index"));
		}else $this->load->view('redirect',array("message"=>"请输入完整"));
	}
	public function saveCat2(){
		if(!isset($_POST['id']) || !isset($_POST['property'])){
			echo json_encode(array("code"=>false,"message"=>'修改失败'));
			return;
		}
		//$array=explode(',', $_POST['property']);
		$data=array(
			"cat_property"=>$_POST['property']
		);
		$result=$this->dbHandler->updatedata("category",$data,"cat_id",$_POST['id']);
		if($result==0)  echo json_encode(array("code"=>false,"message"=>'修改失败'));
		else  echo json_encode(array("code"=>true,"message"=>'修改成功'));
	}
	//删除分类
	public function deleteCat(){
		if(!isset($_POST['id'])){
			echo json_encode(array("code"=>false,"message"=>'删除失败'));
			return;
		}
		$result=$this->dbHandler->deletedata("category","cat_id",$_POST['id']);
		if($result!="")  echo json_encode(array("code"=>false,"message"=>'删除失败'));
		else  echo json_encode(array("code"=>true,"message"=>'删除成功'));
	}
}