<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Cuc extends CI_Controller {
	function __construct(){
		parent::__construct();
		$this->load->helper("base");
		$this->load->helper("orders");
		$this->load->helper("upload");
		$this->load->model("dbHandler");
	}
	public function index(){
		if(!checkLogin()){
			$this->load->view('redirect',array("message"=>"请先登录"));
			return;
		}
		$info=$this->dbHandler->selectPartData('users','u_id',$_SESSION["userid"])[0];
		$data=array(
				"info"=>$info
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
	public function register(){
		if(checkLogin()){
			$this->load->view('redirect',array("message"=>"您已经登录！请退出后再注册","url"=>"/"));
			return;
		}
		$data=array(
		);
		$this->load->view('header',
					array(
						"title"=>"我的学城",
						"description"=>"太原工业学院二手交易平台，校内线下交易",
						"keywords"=>"太原工业学院，二手交易，titer，校内线下交易",
						"showSideCat"=>false,
						"showNav"=>false
					));
		$this->load->view('uc/register',$data);
		$this->load->view('footer');
	}
	public function purchaser_orders(){
		if(!checkLogin()){
			$this->load->view('redirect',array("message"=>"请先登录"));
			return;
		}
		$page=isset($_GET['page'])?$_GET['page']:1;
		$amount=$this->dbHandler->amount_data('orders','o_purchaser',$_SESSION['userid']);
		$page_info=_get_page_info($page,$amount,10);
		$page_amount=$page_info["page_amount"];
		$orders=$this->dbHandler->selectdata('orders','o_purchaser',$_SESSION['userid'],$page_info['limit'],$page_info['offset'],'o_time','DESC');
		//print_r($orders);
		foreach($orders as $item){
			$item->products=array();
			foreach(unserialize($item->o_products) as $product){
				array_push($item->products,$this->get_product($product));
			}
			$item->merchant=$this->get_user_info($item->o_seller);
			$item->cn_status=_convert_order_status($item->o_status);
		}
		$data=array(
				"ucNaviPOrders"=>true,
				"orders"=>$orders,
				"pre_link"=>$page<=1?"javascript:void();":"/uc/purchaser_orders?page=".($page-1),
				"next_link"=>$page>=$page_amount?"javascript:void();":"/uc/purchaser_orders?page=".($page+1),
				"show_page"=>$page."/".$page_amount
			);
		$this->load->view('header',
					array(
						"title"=>"我的学城",
						"description"=>"太原工业学院二手交易平台，校内线下交易",
						"keywords"=>"太原工业学院，二手交易，titer，校内线下交易",
						"showSideCat"=>false,
						"showNav"=>true
					));
		$this->load->view('uc/purchaser-orders',$data);
		$this->load->view('footer');
	}
	public function seller_orders(){
		if(!checkLogin()){
			$this->load->view('redirect',array("message"=>"请先登录"));
			return;
		}
		$page=isset($_GET['page'])?$_GET['page']:1;
		$amount=$this->dbHandler->amount_data('orders','o_seller',$_SESSION['userid']);
		$page_info=_get_page_info($page,$amount,10);
		$page_amount=$page_info["page_amount"];
		$orders=$this->dbHandler->selectdata('orders','o_seller',$_SESSION['userid'],$page_info['limit'],$page_info['offset'],'o_time','DESC');
		//print_r($orders);
		foreach($orders as $item){
			$item->products=array();
			foreach(unserialize($item->o_products) as $product){
				array_push($item->products,$this->get_product($product));
			}
			$item->recipient=$this->get_user_info($item->o_purchaser);
			$item->cn_status=_convert_order_status($item->o_status);
		}
		$data=array(
				"ucNaviSOrders"=>true,
				"orders"=>$orders,
				"pre_link"=>$page<=1?"javascript:void();":"/uc/seller_orders?page=".($page-1),
				"next_link"=>$page>=$page_amount?"javascript:void();":"/uc/seller_orders?page=".($page+1),
				"show_page"=>$page."/".$page_amount
			);
		$this->load->view('header',
					array(
						"title"=>"我的学城",
						"description"=>"太原工业学院二手交易平台，校内线下交易",
						"keywords"=>"太原工业学院，二手交易，titer，校内线下交易",
						"showSideCat"=>false,
						"showNav"=>true
					));
		$this->load->view('uc/seller-orders',$data);
		$this->load->view('footer');
	}
	public function order(){
		$this->load->view('header',
					array(
						"title"=>"我的学城",
						"description"=>"太原工业学院二手交易平台，校内线下交易",
						"keywords"=>"太原工业学院，二手交易，titer，校内线下交易",
						"showSideCat"=>false,
						"showNav"=>true
					));
		if(isset($_GET['id']) && $_GET['id']!="" && is_numeric($_GET['id'])){
			$oid=$_GET['id'];
			$order=$this->dbHandler->selectPartData('orders','o_id',$oid);
			if(count($order)>0){
				$this->load->view('uc/order',array("order"=>$order[0],"purchaser"=>$this->get_user_info($order[0]->o_purchaser),"merchant"=>$this->get_user_info($order[0]->o_seller)));
			}else{
				$this->load->view('404',array("message"=>"抱歉，找不到该订单"));
			}
		}else{
			$this->load->view('404',array("message"=>"抱歉，找不到该订单"));
		}
		$this->load->view('footer');
	}
	public function user(){
		$this->load->view('header',
					array(
						"title"=>"我的学城",
						"description"=>"太原工业学院二手交易平台，校内线下交易",
						"keywords"=>"太原工业学院，二手交易，titer，校内线下交易",
						"showSideCat"=>false,
						"showNav"=>true
					));
		if(isset($_GET['id']) && $_GET['id']!="" && is_numeric($_GET['id'])){
			$uid=$_GET['id'];
			$user=$this->dbHandler->selectPartData('users','u_id',$uid);
			if(count($user)>0){
				$this->load->view('uc/user',array("user"=>$user[0]));
			}else{
				$this->load->view('404',array("message"=>"抱歉，找不到该用户"));
			}
		}else{
			$this->load->view('404',array("message"=>"抱歉，找不到该用户"));
		}
		$this->load->view('footer');
	}
	public function publish(){
		if(!checkLogin()){
			$this->load->view('redirect',array("message"=>"请先登录"));
			return;
		}
		$cat=json_decode($this->_get_cat());
		$data=array(
				"ucNaviPublish"=>true,
				"cat"=>$cat,
				"fscat"=>json_decode($this->_get_sub_cat($cat[0]->cat_id))
			);
		$this->load->view('header',
					array(
						"title"=>"我的学城",
						"description"=>"太原工业学院二手交易平台，校内线下交易",
						"keywords"=>"太原工业学院，二手交易，titer，校内线下交易",
						"showSideCat"=>false,
						"showNav"=>true
					));
		$this->load->view('uc/publish',$data);
		$this->load->view('footer');
	}
	public function info(){
		if(!checkLogin()){
			$this->load->view('redirect',array("message"=>"请先登录"));
			return;
		}
		$info=$this->dbHandler->selectPartData('users','u_id',$_SESSION["userid"])[0];
		$data=array(
				"ucNaviInfo"=>true,
				"info"=>$info
			);
		$this->load->view('header',
					array(
						"title"=>"我的学城",
						"description"=>"太原工业学院二手交易平台，校内线下交易",
						"keywords"=>"太原工业学院，二手交易，titer，校内线下交易",
						"showSideCat"=>false,
						"showNav"=>true
					));
		$this->load->view('uc/info',$data);
		$this->load->view('footer');
	}
	public function messages(){
		if(!checkLogin()){
			$this->load->view('redirect',array("message"=>"请先登录"));
			return;
		}
		$page=isset($_GET['page'])?$_GET['page']:1;
		$amount=$this->dbHandler->amount_data_multi('messages',array('msg_from_uid'=>$_SESSION['userid'],'msg_to_uid'=>$_SESSION['userid']));
		$page_info=_get_page_info($page,$amount,10);
		$page_amount=$page_info["page_amount"];
		$messages=$this->dbHandler->selectdata_multi('messages',array('msg_from_uid'=>$_SESSION['userid'],'msg_to_uid'=>$_SESSION['userid']),$page_info['limit'],$page_info['offset'],'msg_time','DESC');
		foreach($messages as $message){
			$message->msg_from_u=$this->get_user_info($message->msg_from_uid);
			$message->msg_to_u=$this->get_user_info($message->msg_to_uid);
			$message->msg_cn_status=($message->msg_status=="new")?"未查看":"已查看";
		}
		$data=array(
				"ucNaviMessages"=>true,
				"messages"=>$messages,
				"pre_link"=>$page<=1?"javascript:void();":"/uc/messages?page=".($page-1),
				"next_link"=>$page>=$page_amount?"javascript:void();":"/uc/messages?page=".($page+1),
				"show_page"=>$page."/".$page_amount
			);
		$this->load->view('header',
					array(
						"title"=>"我的学城",
						"description"=>"太原工业学院二手交易平台，校内线下交易",
						"keywords"=>"太原工业学院，二手交易，titer，校内线下交易",
						"showSideCat"=>false,
						"showNav"=>true
					));
		$this->load->view('uc/messages',$data);
		$this->load->view('footer');
		
	}
	public function send_msg(){
		if(!checkLogin()){
			$this->load->view('redirect',array("message"=>"请先登录","url"=>"/"));
			return;
		}
		if(isset($_POST['title']) && isset($_POST['content'])){
			$data=array(
					"msg_from_uid"=>$_SESSION['userid'],
					"msg_to_uid"=>$_POST['touserid'],
					"msg_title"=>$_POST['title'],
					"msg_content"=>$_POST['content'],
					"msg_status"=>"new",
					"msg_time"=>date("Y-m-d H:i:s")
			);
			$result=$this->dbHandler->insertdata('messages',$data);
			if($result==0) $this->load->view('redirect',array("message"=>"发送失败"));
			else $this->load->view('redirect',array("message"=>"发送成功"));
		}else{
			$this->load->view('redirect',array("message"=>"发送失败，没有填写完整！"));
		}
	}
	
	//修改消息状态
	public function modify_status_msg(){
		if(!isset($_POST['id']) || !isset($_POST['status'])){
			echo json_encode(array("code"=>false,"message"=>'修改失败'));
			return;
		}
		$data=array("msg_status"=>$_POST['status']);
		$result=$this->dbHandler->updatedata("messages",$data,"msg_id",$_POST['id']);
		if($result==0)  echo json_encode(array("code"=>false,"message"=>'修改失败'));
		else  echo json_encode(array("code"=>true,"message"=>'修改成功'));
	}
	public function products(){
		if(!checkLogin()){
			$this->load->view('redirect',array("message"=>"请先登录","url"=>"/"));
			return;
		}
		$page=isset($_GET['page'])?$_GET['page']:1;
		$amount=$this->dbHandler->amount_data('products','p_userId',$_SESSION['userid']);
		$page_info=_get_page_info($page,$amount,10);
		$page_amount=$page_info["page_amount"];
		$products=$this->dbHandler->selectdata('products','p_userId',$_SESSION['userid'],$page_info['limit'],$page_info['offset'],'p_publishTime','DESC');
		$data=array(
				"ucNaviProducts"=>true,
				"products"=>$products,
				"pre_link"=>$page<=1?"javascript:void();":"/uc/products?page=".($page-1),
				"next_link"=>$page>=$page_amount?"javascript:void();":"/uc/products?page=".($page+1),
				"show_page"=>$page."/".$page_amount
			);
		$this->load->view('header',
					array(
						"title"=>"我的学城",
						"description"=>"太原工业学院二手交易平台，校内线下交易",
						"keywords"=>"太原工业学院，二手交易，titer，校内线下交易",
						"showSideCat"=>false,
						"showNav"=>true
					));
		$this->load->view('uc/products',$data);
		$this->load->view('footer');
	}
	//添加商品
	public function publish_product(){
		if(!checkLogin()){
			$this->load->view('redirect',array("message"=>"请先登录","url"=>"/"));
			return;
		}
		if(!isset($_POST['img_url'])){
			$this->load->view('redirect',array("message"=>"至少添加一张图片！"));
			return;
		}
		if(isset($_POST['cat']) && $_POST['cat']!="" && isset($_POST['subcat']) && $_POST['subcat']!="" && 
			isset($_POST['new']) && $_POST['new']!="" && isset($_POST['price']) && $_POST['price']!="" && 
			isset($_POST['address']) && $_POST['address']!="" && isset($_POST['title']) && $_POST['title']!="" && 
			isset($_POST['position']) && $_POST['position']!="" && isset($_POST['description']) && $_POST['description']!=""){
			
			$data=array(
					"p_cat"=>$_POST['cat'],
					"p_subCat"=>$_POST['subcat'],
					"p_perNew"=>$_POST['new'],
					"p_title"=>$_POST['title'],//
					"p_price"=>$_POST['price'],
					"p_oriPrice"=>$_POST['oriprice'],
					"p_address"=>$_POST['address'],
					"p_listed"=>$_POST['position']?1:0,
					"p_featured"=>false,
					"p_description"=>$_POST['description'],
					"p_userId"=>$_SESSION['userid'],
					"p_status"=>0,
					"p_publishTime"=>date("Y-m-d H:i:s"),
					"p_property"=>$_POST['property']
			);
			$img_urls=isset($_POST['img_url'])?$_POST['img_url']:array();
			$data['p_images']=serialize($img_urls);
			$result=$this->dbHandler->insertdata('products',$data);
			if($result==0) $this->load->view('redirect',array("message"=>"添加失败"));
			else $this->load->view('redirect',array("message"=>"添加成功","url"=>"/uc/publish"));
		}else{
			$this->load->view('redirect',array("message"=>"添加失败，没有填写完整！"));
		}
	}
	//删除商品
	public function delete_product(){
		if(!isset($_POST['id'])){
			echo json_encode(array("code"=>false,"message"=>'删除失败'));
			return;
		}
		$result=$this->dbHandler->deletedata("products","p_ID",$_POST['id']);
		if($result!="")  echo json_encode(array("code"=>false,"message"=>'删除失败'));
		else  echo json_encode(array("code"=>true,"message"=>'删除成功'));
	}
	//删除消息
	public function delete_msg(){
		if(!isset($_POST['id'])){
			echo json_encode(array("code"=>false,"message"=>'删除失败'));
			return;
		}
		$result=$this->dbHandler->deletedata("messages","msg_id",$_POST['id']);
		if($result!="")  echo json_encode(array("code"=>false,"message"=>'删除失败'));
		else  echo json_encode(array("code"=>true,"message"=>'删除成功'));
	}
	//修改商品上/下架
	public function shel_product(){
		if(!isset($_POST['id']) || !isset($_POST['status'])){
			echo json_encode(array("code"=>false,"message"=>'修改失败'));
			return;
		}
		$data=array("p_listed"=>$_POST['status']);
		$result=$this->dbHandler->updatedata("products",$data,"p_ID",$_POST['id']);
		if($result==0)  echo json_encode(array("code"=>false,"message"=>'修改失败'));
		else  echo json_encode(array("code"=>true,"message"=>'修改成功'));
	}
	//修改订单状态
	public function modify_status_order(){
		if(!isset($_POST['id']) || !isset($_POST['status'])){
			echo json_encode(array("code"=>false,"message"=>'修改失败'));
			return;
		}
		$data=array("o_status"=>$_POST['status']);
		$result=$this->dbHandler->updatedata("orders",$data,"o_id",$_POST['id']);
		if($result==0)  echo json_encode(array("code"=>false,"message"=>'修改失败'));
		else  echo json_encode(array("code"=>true,"message"=>'修改成功'));
	}
	public function upload_img(){
	/*
		for($i=1;$i<=$_POST['img_count'];$i++){
			$upload=json_decode(upload("images".$i));
			if($upload->code){
				array_push($image,$upload->message);
			}else{
				$img_result.=";图片"+$i+"添加失败";
			};
		}*/
		$result=upload("image");
		$result['num']=$_POST['count'];
		echo json_encode($result);
		
	}
	public function get_subCat(){
		$cat=$_REQUEST['cat'];
		echo  $this->_get_sub_cat($cat);
	}
	public function get_property(){
		$cat=$_REQUEST['cat'];
		echo $this->_get_property($cat);
	}
	//注册
	public function register_user(){
		$type=isset($_POST['type']) && ($_POST['type']=="email")?"u_email":"u_phone";
		$value=$_POST['value'];
		if($this->is_exist('users',$type,$value)){
			echo json_encode(array("code"=>false,"message"=>$_POST['type'].'已经注册！'));
		}else{
			if($_POST['name']!=null && $_POST['pwd']!=null){
				$data=array(
					"u_name"=>$_POST['name'],
					"u_pwd"=>md5('xuechengw'.$_POST['pwd']),
					$type=>$value,
					"u_qq"=>isset($_POST['qq'])?$_POST['qq']:"",
					"u_creationtime"=>date("Y-m-d H:i:s"),
					"u_rank"=>0,
					"u_rate"=>5
				);
				$result=$this->dbHandler->insertdata('users',$data);
				if($result==0) echo json_encode(array("code"=>false,"message"=>'注册失败，请稍后再试！'));
				else echo json_encode(array("code"=>true,"message"=>'注册成功！'));
			}else{
				echo json_encode(array("code"=>false,"message"=>'请填写完整！'));
			}
		};
	}
	public function bind_phone(){
		if(!isset($_POST['phone'])){
			echo json_encode(array("code"=>false,"message"=>'修改失败'));
			return;
		}
		$phone=$_POST["phone"];
		if($this->is_exist('users',"u_phone",$phone)){
			echo json_encode(array("code"=>false,"message"=>$phone.'已经绑定！'));
			return;
		}
		$data=array("u_phone"=>$phone);
		$result=$this->dbHandler->updatedata("users",$data,"u_id",$_SESSION['userid']);
		if($result==0)  echo json_encode(array("code"=>false,"message"=>'绑定失败'));
		else{
			$_SESSION["phone"]=$phone;
			echo json_encode(array("code"=>true,"message"=>'成功绑定'));
		}
	}
	public function new_info(){
		$img_result=upload("image");
		if($img_result["code"]) $data["u_img"]=$img_result["message"];
		$data["u_name"]=$_POST['username'];
		$result=$this->dbHandler->updatedata("users",$data,"u_id",$_SESSION['userid']);
		if($result==0)  $this->load->view('redirect',array("message"=>"修改失败"));
		else{
			$_SESSION['username']=$_POST['username'];
			$this->load->view('redirect',array("message"=>"修改成功","url"=>"/uc/info"));
		}
	}
	public function is_exist_phone(){
		$phone=$_POST["phone"];
		if($this->is_exist('users',"u_phone",$phone)) echo json_encode(array("code"=>true,"message"=>'存在'));
		else echo json_encode(array("code"=>false,"message"=>'不存在'));
	}
	public function login_user(){
		if(isset($_SESSION['name'])){
			echo json_encode(array("code"=>false,"message"=>"您已经登录！"));
			return;
		}
		if(!isset($_POST['username']) || !isset($_POST['pwd']) || !isset($_POST['type'])){
			echo json_encode(array("code"=>false,"message"=>"请填写用户名&密码&登录类型"));
			return;
		}
		$userName=$_POST['username'];
		$pwd=md5('xuechengw'.$_POST['pwd']);
		$type=$_POST['type']=="email"?"u_email":"u_phone";
		$user_info=$this->dbHandler->selectPartData('users',$type,$userName);
		if(count($user_info)==0){
			echo json_encode(array("code"=>false,"message"=>"用户名不存在"));
			return;
		}
		$user_info=$user_info[0];
		if($user_info->u_pwd != $pwd){
			echo json_encode(array("code"=>false,"message"=>"密码错误"));
			return;
		}
		$_SESSION["userid"]=$user_info->u_id;
		$_SESSION["name"]=$user_info->u_name;
		$_SESSION["email"]=$user_info->u_email;
		$_SESSION["phone"]=$user_info->u_phone;
		$_SESSION["qq"]=$user_info->u_qq;
		$_SESSION["creationtime"]=$user_info->u_creationtime;
		$_SESSION["rank"]=$user_info->u_rank;
		$_SESSION["rate"]=$user_info->u_rate;
		$_SESSION["type"]="user";
		if (isset($_POST['rememberMe']) && $_POST['rememberMe']) {
			setcookie("userid", $_SESSION["userid"], time()+3600*24*365);
			setcookie("name", $_SESSION["name"], time()+3600*24*365);
			setcookie("email", $_SESSION["email"], time()+3600*24*365);
			setcookie("phone", $_SESSION["phone"], time()+3600*24*365);
			setcookie("qq", $_SESSION["qq"], time()+3600*24*365);
			setcookie("creationtime", $_SESSION["creationtime"], time()+3600*24*365);
			setcookie("rank", $_SESSION["rank"], time()+3600*24*365);
			setcookie("rate", $_SESSION["rate"], time()+3600*24*365);
			setcookie("type", $_SESSION["type"], time()+3600*24*365);
		}
		echo json_encode(array("code"=>true,"message"=>"登录成功"));
	}
	public function logout() {
		unset($_SESSION["userid"]);
		unset($_SESSION["name"]);
		unset($_SESSION["email"]);
		unset($_SESSION["phone"]);
		unset($_SESSION["qq"]);
		unset($_SESSION["creationtime"]);
		unset($_SESSION["rank"]);
		unset($_SESSION["rate"]);
		unset($_SESSION["type"]);
		setcookie("userid");
		setcookie("name");
		setcookie("phone");
		setcookie("qq");
		setcookie("creationtime");
		setcookie("rank");
		setcookie("rate");
		echo json_encode(array("code"=>true,"message"=>"成功退出"));
	}
	//查重
	public function is_exist($table,$where,$content){
		$total=$this->dbHandler->selectPartData($table,$where,$content);
		if(count($total)==0)return false;
		if(count($total)>0)return true;
	}
	//验证码
	public function send_mobile_code(){
		if ((isset($_REQUEST["phone"]) && strlen($_REQUEST["phone"]) == 0) ||
			!isset($_REQUEST["phone"]) ) {
			echo json_encode(array("code"=>false, "message"=>"未登录或还没有验证手机号"));
			return;
		}

		//mt_srand((double)microtime() * 1000000);
		$mobileauthcode = mt_rand(100000, 999999);
		unset($_SESSION["mobileauthcode"]);
		$_SESSION["mobileauthcode"] = $mobileauthcode;
		$result = $this->sendsms($_REQUEST["phone"],$mobileauthcode);
		if ($result>0) {
			echo json_encode(array("code"=>true, "message"=>"发送验证码成功"));
		} else {
			echo json_encode(array("code"=>false, "message"=>"发送失败，请稍后再试"));
			unset($_SESSION["mobileauthcode"]);
		}
	}
	//验证手机验证码
	public function check_mobile_code(){
		if(!isset($_REQUEST["mobile_code"])){
			echo json_encode(array("code"=>false, "message"=>"请先填写验证码"));
			return;
		}
		if(!isset($_SESSION["mobileauthcode"])){
			echo json_encode(array("code"=>false, "message"=>"请先发送验证码"));
			return;
		}
		if($_REQUEST["mobile_code"]!=$_SESSION["mobileauthcode"]){
			echo json_encode(array("code"=>false, "message"=>"验证码错误"));
			return;
		}
		echo json_encode(array("code"=>true, "message"=>"验证成功"));
	}
	public function sendsms($phone,$code){
		$text="验证码是".$code."【学城网】";
		$url="http://utf8.sms.webchinese.cn/?Uid=MonkeyKing&Key=916befe64d458c759a3a&smsMob=".$phone."&smsText=".$text;
		if(function_exists('file_get_contents')){
			$file_contents = file_get_contents($url);
		}
		else{
			$ch = curl_init();
			$timeout = 5;
			curl_setopt ($ch, CURLOPT_URL, $url);
			curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt ($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
			$file_contents = curl_exec($ch);
			curl_close($ch);
		}
		return $file_contents;
	}
	/**获取一级分类
	 * 
	 */
	function _get_cat()
	{
		$cat=$this->dbHandler->selectPartData('category','cat_fid','0');
		return json_encode($cat);
	}
	/**获取二级分类
	 * 
	 */
	function _get_sub_cat($cat)
	{
		$subCat=$this->dbHandler->selectPartData('category','cat_fid',$cat);
		return json_encode($subCat);
	}
	public function _get_property($id){
		$property=$this->dbHandler->selectPartData('category','cat_id',$id);
		return count($property)>0?$property[0]->cat_property:"";
	}
	public function get_product($id){
		$product=$this->dbHandler->selectPartData('products','p_id',$id);
		return count($product)>0?$product[0]:array();
	}
	public function get_user_info($id){
		$merchant=$this->dbHandler->selectPartData('users','u_id',$id);
		return  count($merchant)>0?$merchant[0]:array();
	}

}