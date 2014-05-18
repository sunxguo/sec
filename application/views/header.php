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
    <script src="/assets/js/jquery-1.11.0.min.js" type="text/javascript"></script>
	<script src="/assets/js/tools.js" type="text/javascript"></script>
</head>
<body>
	<div class="modal-backdrop" id="backdrop"></div>
    <div class="header">
		<div class="top clearfix">
			<div class="logo"><a href="/"><img src="/assets/img/logo.png"/></a></div>
			<div class="search">
				<form action="" method="get">
					<input type="text" name="keyword" class="search_txt" autocomplete="off" placeholder="搜索更快~">
					<input type="submit" value="" class="search_bt icon-common">
					<label class="hot">
						<a href="">小米手机3</a>
						<a href="">小米手机3</a>
						<a href="">小米手机3</a>
						<a href="">小米手机3</a>
					</label>
				</form>
			</div>
			<div class="miniCart" id="miniCart">
				<div>
					<span class="cart-bt icon-common"></span>
					购物车
				</div>
				<div class="mini-cart-list" id="miniCartList">
					<div class="loading">数据加载中，请稍后...</div>
				</div>
			</div>
			<div class="menu">
				<ul>
					<li><a href="http://zl.xuechengw.com" target="_blank">学城资料</a></li>
					
					<li>
					<?php if(!checkLogin()){?>
						<a onclick="showLogin()">登录</a> / 
						<a href="/uc/register" target="_blank">注册</a>
					<?php }else{?>
						欢迎您 <a href="/uc"><?=$_SESSION["name"]?></a>
						<a href="javascript: void();" onclick="logout();">[退出]</a>
					<?php }?>
					</li>
					<div class="login-panel" id="login-panel">
						<div class="login-head">
							<h3>登录与注册</h3>
							<a class="close" onclick="hideLogin()">x</a>
						</div>
						<div class="login-main">
							<dl>
								<dd>
									<input type="text" id="miniLogin_username" name="miniLogin_username" placeholder="请输入邮箱/手机号码" data-rule="(^[\w.\-]+@(?:[a-z0-9]+(?:-[a-z0-9]+)*\.)+[a-z]{2,3}$)|(^1[3|4|5|8]\d{9}$)|(^\d{3,}$)|(^\++\d{2,})" autocomplete="off"/><span class="msgTips"></span>
								</dd>
								<dd>
									<input type="password" id="miniLogin_pwd" name="miniLogin_pwd" placeholder="请输入密码" data-rule="" /><span class="msgTips"></span>
								</dd>
							</dl>
							<div class="miniLogin_auto cfl clearfix">
								<label for="auto"><input type="checkbox" id="auto" name="auto" value="true" /><span>自动登录</span></label>
								<p><a href="javascript:;" onclick="window.open('')">忘记密码？</a> </p>
							</div>
							<div class="miniLogin_btn cfl clearfix">
								<input type="submit" class="no_bg" value="立即登录" onclick="login()"/>
								<a href="/uc/register" target="_blank">注册</a>
							</div>
						</div>
					</div>
				</ul>
			</div>
		</div>
		<?php if($showNav):?>
		<div class="nav">
			<div class="all-cat"><a>全部商品分类</a></div>
			<div class="links">
				<ul>
					<li><a>首页</a></li>
					<li><a>图书</a></li>
					<li><a>电脑</a></li>
					<li><a>生活</a></li>
				</ul>
			</div>
		</div>
		<?php endif;?>
    </div>
	<div class="main clearfix">
		<?php if($showSideCat) require("category.php");?>
		<?php //require("product-side-ad.php"); ?>