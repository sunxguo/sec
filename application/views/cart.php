<link rel="stylesheet" href="/assets/css/cart.css" type="text/css">
<script>
	function removeFromCart(id){
		if(confirm("确定删除？")){
			$.post("/cshopping/removeFromCart",
				{'id':id},
				function(data){
					var rs=$.parseJSON(data);
					if(rs.code) {
						window.location.reload();
					}else alert(rs.message);
				}
			);
		}
	}
</script>
<div class="cart">
	<div class="cart-header"><h2>我的购物车</h2> 您看中的商品随时被抢购，请立即交易哦</div>
	<form method="post" action="/cshopping/buyCart">
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
			<?php $total=0;foreach($cartsInfo as $merchantId=>$merchantItem):?>
				<?php foreach($merchantItem["products"] as $product):?>
				<li class="lists-body">
					<dl>
						<dd class="product">
							<a href="/shopping/product?id=<?=$product->p_id?>" target="_blank">
								<img src="<?php if(unserialize($product->p_images)) echo unserialize($product->p_images)[0];?>"/>
								<div class="color-bule show-short"><?=$product->p_title?></div>
							</a>
						</dd>
						<dd class="merchant"><a href="<?="/users?id=".$merchantItem["merchant_info"]->u_name?>" class="show-short"><?=$merchantItem["merchant_info"]->u_name?></a></dd>
						<dd class="price color-red">￥<?=$product->p_price?></dd>
						<?php $total+=$product->p_price;?>
						<dd class="discount"></dd>
						<dd class="new"><?=$product->p_perNew?></dd>
						<dd class="oper"><a href="javascript:removeFromCart('<?=$product->p_id?>');" class="color-red">删除</a></dd>
					</dl>
				</li>
				<?php endforeach;?>
				<li><input type="text" name="address<?=$merchantId?>" placeholder="首选交易地点" class="address"/><textarea name="note<?=$merchantId?>" placeholder="给卖家 <?=$merchantItem['merchant_info']->u_name?> 留言" class="note"></textarea>
				</li>
			<?php endforeach;?>
			<li class="lists-footer clearfix">
				<div class="f_r">
					总计：<b class="color-red">￥<?=$total?></b>
				</div>
			</li>
		</ul>
	</div>
	<div class="cart-footer mg_t20">
		<input type="button" value="继续购物" class="a_bt_rig width150 " onclick="window.open('/')">
		<input type="submit" value="立即交易" class="a_bt_err width150 f_r">
	</div>
	</form>
</div>