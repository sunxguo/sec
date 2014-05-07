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
			$this->load->view('redirect',array("message"=>"请先登录","url"=>"/"));
			return;
		}
		$data=array(
				"ucNaviPOrders"=>true
				
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
			$this->load->view('redirect',array("message"=>"请先登录","url"=>"/"));
			return;
		}
		$data=array(
				"ucNaviSOrders"=>true
				
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
	public function publish(){
		if(!checkLogin()){
			$this->load->view('redirect',array("message"=>"请先登录","url"=>"/"));
			return;
		}
		$data=array(
				"ucNaviPublish"=>true,
				"cat"=>json_decode($this->_get_cat())
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
	public function get_subCat(){
		$cat=$_REQUEST['cat'];
		echo  $this->_get_sub_cat($cat);
	}
	public function info(){
		if(!checkLogin()){
			$this->load->view('redirect',array("message"=>"请先登录","url"=>"/"));
			return;
		}
		$data=array(
				"ucNaviInfo"=>true
				
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
			$this->load->view('redirect',array("message"=>"请先登录","url"=>"/"));
			return;
		}
		$data=array(
				"ucNaviMessages"=>true
				
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
	public function products(){
		if(!checkLogin()){
			$this->load->view('redirect',array("message"=>"请先登录","url"=>"/"));
			return;
		}
		$page=isset($_GET['page'])?$_GET['page']:1;
		$amount=$this->dbHandler->amount_data('products','p_userId',$_SESSION['userid']);
		$page_info=_get_page_info($page,$amount,10);
		$products=$this->dbHandler->selectdata('products','p_userId',$_SESSION['userid'],$page_info['limit'],$page_info['offset'],'p_publishTime','DESC');
		$data=array(
				"ucNaviProducts"=>true,
				"products"=>$products
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
					"p_listed"=>$_POST['position'],
					"p_description"=>$_POST['description'],
					"p_userId"=>$_SESSION['userid'],
					"p_status"=>'new',
					"p_publishTime"=>date("Y-m-d H:i:s")
			);
			$img_urls=$_POST['img_url'];
			$data['p_images']=serialize($img_urls);
			$result=$this->dbHandler->insertdata('products',$data);
			if($result==0) $this->load->view('redirect',array("message"=>"添加失败"));
			else $this->load->view('redirect',array("message"=>"添加成功","url"=>"/uc/publish"));
		}else{
			$this->load->view('redirect',array("message"=>"添加失败，没有填写完整！"));
		}
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
		if (isset($_POST['rememberMe']) && $_POST['rememberMe']) {
			setcookie("userid", $_SESSION["userid"], time()+3600*24*365);
			setcookie("name", $_SESSION["name"], time()+3600*24*365);
			setcookie("email", $_SESSION["email"], time()+3600*24*365);
			setcookie("phone", $_SESSION["phone"], time()+3600*24*365);
			setcookie("qq", $_SESSION["qq"], time()+3600*24*365);
			setcookie("creationtime", $_SESSION["creationtime"], time()+3600*24*365);
			setcookie("rank", $_SESSION["rank"], time()+3600*24*365);
			setcookie("rate", $_SESSION["rate"], time()+3600*24*365);
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
		$result = $this->SendSMS($_REQUEST["phone"],"学城网短信验证码$mobileauthcode");
		$result=json_decode($result);
		if (property_exists($result, "statusCode") && $result->statusCode == "000000") {
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
	 /**
    * 发送短信
    * @param to 短信接收端手机号码集合,用逗号分开
    * @param body 短信正文
    * @param msgType 消息类型。取值0（普通短信）、1（长短信），默认值 0
    * @param sub_account 子账户Id
    */
	function SendSMS($to,$body)
	{
        // 拼接请求包体
       	$body= "{'to':'$to','body':'$body','msgType':'0','appId':'aaf98f8945880f9e0145b81bc2c4283f','subAccountSid':'aaf98f8944f35b130144f3bb3f6b0081'}"; 
        // 大写的sig参数 
        $sig =  strtoupper(md5('aaf98f8944f35b130144f3b5412b0076' . 'f708d6bf0d33463bac5313571e91cbe9' . date("YmdHis")));
        // 生成请求URL        
        $url="https://app.cloopen.com:8883/2013-12-26/Accounts/aaf98f8944f35b130144f3b5412b0076/SMS/Messages?sig=$sig";
        // 生成授权：主账户Id + 英文冒号 + 时间戳。
        $authen = base64_encode("aaf98f8944f35b130144f3b5412b0076" . ":" . date("YmdHis"));
        // 生成包头
        $header = array("Accept:application/json","Content-Type:application/json;charset=utf-8","Authorization:$authen");
        // 发送请求
        $result = httpPost($url,$body,$header,true);
        return $result;
	}
	function getSubAccount()
	{
        // 拼接请求包体
       	$body= "{'appId':'aaf98f8945880f9e0145b81bc2c4283f','friendlyName':'MonkeyKing1024@gmail.com','accountSid':'aaf98f8944f35b130144f3b5412b0076'}"; 
        // 大写的sig参数 
        $sig =  strtoupper(md5('aaf98f8944f35b130144f3b5412b0076' . 'f708d6bf0d33463bac5313571e91cbe9' . date("YmdHis")));
        // 生成请求URL        
        $url="https://app.cloopen.com:8883/2013-12-26/Accounts/aaf98f8944f35b130144f3b5412b0076/SubAccounts?sig=$sig";
        // 生成授权：主账户Id + 英文冒号 + 时间戳。
        $authen = base64_encode("aaf98f8944f35b130144f3b5412b0076" . ":" . date("YmdHis"));
        // 生成包头
        $header = array("Accept:application/json","Content-Type:application/json;charset=utf-8","Authorization:$authen");
        // 发送请求
        $result = httpPost($url,$body,$header,true);
        echo $result;
	}
	function send_email(){
		$to = "sunxguo@163.com";
		$subject = "Test mail";
		$message = "Hello! This is a simple email message.";
		$from = "sunxguo@163.com";
		$headers = "From: $from";
		mail($to,$subject,$message,$headers);
		echo "Mail Sent.";
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
}