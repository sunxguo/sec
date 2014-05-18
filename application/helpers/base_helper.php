<?php

@session_start();

/**
 * object转array
 */
function object_to_array($obj){
	$_arr = is_object($obj)? get_object_vars($obj) :$obj;
	foreach ($_arr as $key => $val){
		$val=(is_array($val)) || is_object($val) ? object_to_array($val) :$val;
		$arr[$key] = $val;
	}
	return $arr;
}

/**
 * 检查用户登录状态
 * @return boolean 是否已登录
 */
function checkLogin(){
	if(isset($_SESSION['name'])){
		return true;
	} else {
		if (isset($_COOKIE["name"]) && isset($_COOKIE["email"]) && $_COOKIE["userid"] &&
		isset($_COOKIE["phone"]) && isset($_COOKIE["qq"]) && 
		isset($_COOKIE["rank"]) && isset($_COOKIE["rate"])) {
			$_SESSION["userid"] = $_COOKIE["userid"];
			$_SESSION["name"] = $_COOKIE["name"];
			$_SESSION["email"] = $_COOKIE["email"];
			$_SESSION["phone"] = $_COOKIE["phone"];
			$_SESSION["qq"] = $_COOKIE["qq"];
			$_SESSION["rank"] = $_COOKIE["rank"];
			$_SESSION["rate"] = $_COOKIE["rate"];
			return true;
		}
		return false;
	}
}

/**
 * 返回错误信息数组
 */
function errorMessage($code, $message){
	return array('code'=>$code,'message'=>$message);
}

/**
 * 生成cookie数组
 * @param string $key 
 * @param string $value
 */
function createCookieArray($key, $value, $expire) {
	$cookie = array(
		'name'   => $key,
		'value'  => $value,
		'expire' => "".$expire,
		'domain' => '',
		'path'   => '/',
		'prefix' => '',
		'secure' => false,
	);
	return $cookie;
}

/**
 * http get
 * @param string $url url to get
 * @return html return
 */
function httpGet($url, $param = array(), $header = array(), $ssl = false) {
	$paramString = "?";
	foreach ($param as $key => $value) $paramString = $paramString.$key."=".$value."&";
	if($paramString != "") $paramString[strlen($paramString) - 1] = '';

	if (count($header) == 0) {
		$header[0] = "Accept: text/xml,application/xml,application/xhtml+xml,";   
		$header[0] .= "text/html;q=0.9,text/plain;q=0.8,image/png,*/*;q=0.5";   
		$header[] = "Cache-Control: max-age=0";   
		$header[] = "Connection: keep-alive";   
		$header[] = "Keep-Alive: 300";   
		$header[] = "Accept-Charset: ISO-8859-1,utf-8;q=0.7,*;q=0.7";   
		$header[] = "Accept-Language: en-us,en;q=0.5";   
		$header[] = "Pragma: ";
	}
	
	//$ch = curl_init($url.$paramString);
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $url.$paramString);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_BINARYTRANSFER, true);
	if($ssl) {
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
	}
	curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
	$html = curl_exec($ch);
	curl_close($ch);
	return $html;
}

/**
 * http post
 * @param string $url url to post
 * @return html return
 */
function httpPost($url, $param = array(), $header = array(), $ssl = false) {
	if (count($header) == 0) {
		$header[0] = "Accept: text/xml,application/xml,application/xhtml+xml,";   
		$header[0] .= "text/html;q=0.9,text/plain;q=0.8,image/png,*/*;q=0.5";   
		$header[] = "Cache-Control: max-age=0";   
		$header[] = "Connection: keep-alive";   
		$header[] = "Keep-Alive: 300";   
		$header[] = "Accept-Charset: ISO-8859-1,utf-8;q=0.7,*;q=0.7";   
		$header[] = "Accept-Language: en-us,en;q=0.5";   
		$header[] = "Pragma: ";
	}

	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_BINARYTRANSFER, true);
	if($ssl) {
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
	}
	curl_setopt($ch, CURLOPT_POST, true);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $param);
	curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
	$html = curl_exec($ch);
	curl_close($ch);
	return $html;
}

/**
 * http patch
 * @param string $url url to patch
 * @return html return
 */
function httpPatch($url, $param = array(), $header = array(), $ssl = USE_HTTPS) {
	if (false && count($header) == 0) {
		$header[0] = "Accept: text/xml,application/xml,application/xhtml+xml,";   
		$header[0] .= "text/html;q=0.9,text/plain;q=0.8,image/png,*/*;q=0.5";   
		$header[] = "Cache-Control: max-age=0";   
		$header[] = "Connection: keep-alive";   
		$header[] = "Keep-Alive: 300";   
		$header[] = "Accept-Charset: ISO-8859-1,utf-8;q=0.7,*;q=0.7";   
		$header[] = "Accept-Language: en-us,en;q=0.5";   
		$header[] = "Pragma: ";
	}

	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	if($ssl) {
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
	}
	curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PATCH');
	curl_setopt($ch, CURLOPT_POSTFIELDS, $param);
	curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
	$html = curl_exec($ch);
	curl_close($ch);
	return $html;
}

/**
 * http delete
 * @param string $url url to patch
 * @return html return
 */
function httpDelete($url,  $header = array(), $ssl = USE_HTTPS) {
	if (count($header) == 0) {
		$header[0] = "Accept: text/xml,application/xml,application/xhtml+xml,";   
		$header[0] .= "text/html;q=0.9,text/plain;q=0.8,image/png,*/*;q=0.5";   
		$header[] = "Cache-Control: max-age=0";   
		$header[] = "Connection: keep-alive";   
		$header[] = "Keep-Alive: 300";   
		$header[] = "Accept-Charset: ISO-8859-1,utf-8;q=0.7,*;q=0.7";   
		$header[] = "Accept-Language: en-us,en;q=0.5";   
		$header[] = "Pragma: ";
	}

	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_BINARYTRANSFER, true);
	if($ssl) {
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
	}
	curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'DELETE');
	//curl_setopt($ch, CURLOPT_POSTFIELDS, $param);
	curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
	$html = curl_exec($ch);
	curl_close($ch);
	return $html;
}
	function _get_page_info($page,$amount,$page_items){
		$info['page_amount']=ceil($amount/$page_items);
		$info['limit']=$page_items;
		$info['offset']=($page-1)*$page_items;
		return $info;
	}

?>

