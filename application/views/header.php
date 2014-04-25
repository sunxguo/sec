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
				<span class="cart icon-common"></span>
				购物车
			</div>
			<div class="menu">
				<ul>
					<li><a href="http://zl.xuechengw.com" target="_blank">学城资料</a></li>
					<li><a>登录</a> / <a>注册</a></li>
					<div class="login-panel">
						<div class="login-head">
							<h3>登录与注册</h3>
							<a class="close">X</a>
						</div>
						<div class="login-main">
							<dl>
								<dd>
									<input type="text" id="miniLogin_username" name="miniLogin_username" placeholder="请输入邮箱/手机号码/小米ID" data-rule="(^[\w.\-]+@(?:[a-z0-9]+(?:-[a-z0-9]+)*\.)+[a-z]{2,3}$)|(^1[3|4|5|8]\d{9}$)|(^\d{3,}$)|(^\++\d{2,})" autocomplete="off"/><span class="msgTips"></span>
								</dd>
								<dd>
									<input type="password" id="miniLogin_pwd" name="miniLogin_pwd" placeholder="请输入密码" data-rule="" /><span class="msgTips"></span>
								</dd>
							</dl>
							<div class="miniLogin_auto cfl">
								<label for="auto"><input type="checkbox" id="auto" name="auto" value="true" /><span>两周内自动登录</span></label>
								<p><a href="javascript:;" onclick="window.open('https://account.xiaomi.com/pass/forgetPassword')">忘记密码？</a> </p>
							</div>
							<p class="miniLogin_btn cfl">
								<input type="submit" class="no_bg" value="立即登录" />
								<a href="javascript:;" onclick="window.open('https://account.xiaomi.com/pass/register');">注册</a>
							</p>
							<div class="miniLogin_third">
								<span>用其他帐户登录：</span>
								<a class="qq" id="miniLogin_third_qq" href="#" target="_top">QQ</a>
								<a class="sina" id="miniLogin_third_sina" href="#" target="_top">新浪</a>        
							</div>
						</div>
					</div>
				</ul>
			</div>
		</div>
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
    </div>
	<div class="main">
		<div class="side-cat">
			<ul>
			<?php for($i=0;$i<10;$i++):?>
				<li class="cat">
					<a class="cat-tit">图书音像</a>
					<span class="arrow icon-common"></span>
					<span class="showPos"><i></i></span>
					<div class="subCat">
						<dl class="lists">
							<dd>
								<a href="">
									<img src="/assets/img/cate/tm.jpg"/>
									教材
								</a>
							</dd>
							<dd>
								<a href="">
									<img src="/assets/img/cate/tm.jpg"/>
									图书音像
								</a>
							</dd>
							<dd>
								<a href="">
									<img src="/assets/img/cate/tm.jpg"/>
									教材
								</a>
							</dd>
						</dl>
					</div>
				</li>
			<?php endfor;?>
			</ul>
		</div>