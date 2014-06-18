<?php
	@session_start(); 
	$this->load->helper("base");
?>
<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title><?=$title?></title>
	<meta  name="description"  content="<?=$description?>">
	<meta  name="keywords"  content="<?=$keywords?>">
	<link  rel="shortcut icon"  href="/assets/img/ico/favicon.ico"  type="image/x-icon">
	<link  rel="icon"  href="/assets/img/ico/favicon.ico"  type="image/x-icon">
	<link rel="stylesheet" href="/assets/css/base.css" type="text/css">
    <link rel="stylesheet" href="/assets/css/header.css" type="text/css">
	<link rel="stylesheet" href="/assets/css/alogin.css" type="text/css">
    <script src="/assets/js/jquery-1.11.0.min.js" type="text/javascript"></script>
	<script src="/assets/js/tools.js" type="text/javascript"></script>
</head>
<body>
	<div class="modal-backdrop" id="backdrop"></div>
    <div class="header">
		<div class="top clearfix">
			<div class="logo"><a href="/"><img src="/assets/img/logo.png"/></a></div>
			<div></div>
		</div>
    </div>
	<div class="main clearfix">
		<form action="/cadmin/adminLogin" method="post">
			<input type="text" name="username" placeholder="用户名"/>
			<input type="password" name="pwd" placeholder="密码"/>
			<input type="submit" value="登录" class="bt"/>
		</form>
	</div>
</body>
</html>