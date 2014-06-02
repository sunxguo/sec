<link rel="stylesheet" href="/assets/css/cart.css" type="text/css">
<div class="cart">
	<div class="cart-header"><h2>我的购物车</h2> 您看中的商品随时被抢购，请立即交易哦</div>
	<div class="products-lists">
		<ul>
			<li class="lists-header">
				<dl>
					<dd class="product">商品</dd>
					<dd class="merchant">卖家</dd>
					<dd class="price">价格</dd>
					<dd class="discount">优惠</dd>
					<dd class="new">成色</dd>
					<dd class="oper">操作</dd>
				</dl>
			</li>
			<?php for($i=0;$i<5;$i++):?>
			<li class="lists-body">
				<dl>
					<dd class="product">
						<a href="/">
							<img src="/assets/img/product/tv.jpg"/>
							<div class="color-bule show-short">苹果 iPhone4s/ 5s /三星 S4 / NOTE3 保修期内苹果 iPhone4s/ 5s /三星 S4 / NOTE3 保修期内苹果 iPhone4s/ 5s /三星 S4 / NOTE3 保修期内苹果 iPhone4s/ 5s /三星 S4 / NOTE3 保修期内苹果 iPhone4s/ 5s /三星 S4 / NOTE3 保修期内 低价促销</div>
						</a>
					</dd>
					<dd class="merchant"><a class="show-short">孙行者孙行者孙行者孙行者孙行者</a></dd>
					<dd class="price color-red">￥120</dd>
					<dd class="discount">无</dd>
					<dd class="new">九成新</dd>
					<dd class="oper"><a href="" class="color-red">删除</a></dd>
				</dl>
			</li>
			<?php endfor;?>
			<li class="lists-footer clearfix">
				<div class="f_r">
					总计：<b class="color-red">￥1200</b>
				</div>
			</li>
		</ul>
	</div>
	<div class="cart-footer mg_t20">
		<input type="button" value="继续购物" class="a_bt_rig width150 ">
		<input type="button" value="立即交易" class="a_bt_err width150 f_r">
	</div>
</div>