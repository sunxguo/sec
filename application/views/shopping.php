<link rel="stylesheet" href="/assets/css/shopping.css" type="text/css">
<div class="shopping">
	<div class="filter radius4">
		<div class="filter-header"><span class="cat">平板电视</span>-商品筛选</div>
		<ul class="filter-body">
			<li class="filter-item clearfix">
				<div class="param">品牌：</div>
				<dl>
					<dd><a>海信</a></dd>
					<dd><a>TCL</a></dd>
					<dd><a>三星</a></dd>
				</dl>
			</li>
			<li class="filter-item clearfix">
				<div class="param">价格：</div>
				<dl>
					<dd><a>海信</a></dd>
					<dd><a>TCL</a></dd>
					<dd><a>三星</a></dd>
				</dl>
			</li>
		</ul>
	</div>
	<div class="products-header clearfix radius4">
		<div class="order">
			<span>排序：</span>
			<ul>
				<li class="price">价格 ↑</li>
				<li class="price">价格 ↓</li>
				<li class="time">发布时间</li>
			</ul>
		</div>
		<div class="page">
			1/12页
			<a class="no">上一页</a>
			<a class="page_bt ">下一页</a>
		</div>
	</div>
	<div class="products-list clearfix">
		<ul class="lists">
		<?php for($i=0;$i<10;$i++):?>
			<li class="box">
				<a href="/shopping/product" title="苹果（APPLE）iPhone 5s 32G版 4G手机（深空灰色）">
					<img src="/assets/img/product/tv.jpg">
					<span class="title">苹果（APPLE）iPhone 5s 32G版 4G手机（深空灰色）</span>
				</a>
				<span class="price">￥4999</span>
				<div class="oper">
					<input type="button" value="加入购物车"/>
					<input type="button" value="立即交易" onclick="confirmDeal()"/>
				</div>
			</li>
		<?php endfor;?>
		</ul>
	</div>
	<div class="products-header clearfix products-footer">
		<div class="page">
			1/12页
			<a class="no">上一页</a>
			<a class="page_bt ">下一页</a>
		</div>
	</div>
</div>