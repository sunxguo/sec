<link rel="stylesheet" href="/assets/css/product.css" type="text/css">
<script src="/assets/js/unslider.min.js"></script>
<div class="product">
	<div class="params clearfix">
		<div class="gallery">
			<div class="slider" id="slider">
				<ul>
					<?php $imgs=unserialize($product->p_images);foreach($imgs as $img):?>
					<li><img src="<?=$img?>" title="<?=$product->p_title?>"  onload="AutoResizeImage(436,240,this)"/></li>
					<?php endforeach;?>
				</ul>
			</div>
			<a class="bt_nav icon-slides-prev icon-slides" id="previous">Previous</a>
			<a class="bt_nav icon-slides-next icon-slides" id="next">Next</a>	
		</div>
		<div class="summary">
			<ul>
				<li class="title"><h4><?=$product->p_title?></h4></li>
				<li><b>价格：</b><span class="price">￥<?=$product->p_price?></span></li>
				<li><b>成色：</b><span class="new"><?=$product->p_perNew?>成新</span></li>
				<li><b>卖家：</b><a href="/uc/user?id=<?=$merchant->u_id?>" target="_blank" class="seller"><?=$merchant->u_name?></a></li>
				<li><b>QQ：</b><a class="seller" target="_blank" href="javascript:window.location='tencent://message/?uin=<?=$merchant->u_qq?>';" class="qq"><?=$merchant->u_qq?></a></li>
				<li><b>Email:</b><span class="email"><?=$merchant->u_email?></span></li>
				<?php if($show>0){?>
				<li><b>电话:</b><span class="email"><?=$merchant->u_phone?></span></li>
				<?php }else{?>
				<li><span class="tip">确定交易后可查看手机号</span></li>
				<?php }?>
				
			</ul>
			<div class="oper">
				<?php if($product->p_status==0){?>
					<input type="button" value="加入购物车" onclick="addToCart('<?=$product->p_id?>')"/>
					<input type="button" value="立即交易" onclick="confirmDeal('<?=$product->p_id?>')"/>
				<?php }else{?>
					<input type="button" value="该商品已被预定" onclick="alert('抱歉，该商品已被预定');"/>
				<?php }?>
			</div>
		</div>
	</div>
	<div class="description">
		<div class="bar">商品详情</div>
		<div class="content">
			<?=$product->p_description?>
		</div>
	</div>
</div>

<script>
$(function() {
	var slidey=$('#slider').unslider({dots: true});
	var data = slidey.data('unslider');
	$('#previous').click(function(){
		data.prev();
	});
	$('#next').click(function(){
		data.next();
	});
	$('.products .floor .floor-head .filter ul li:last-child').css({border:"none"});
	/*
	$(".products .floor .lists .box").mouseover(function(){
		$(this).children(".product-info").show();
	});*/
});
function addToCart(id){
	$.ajax({  
          type : "post",  
          url : "/cshopping/is_bought_product",  
          data : "id="+id,  
          async : false,  
          success : function(data){
						var rs=$.parseJSON(data);
						if(rs.code){
							alert(rs.message);
						}
						else {
							$.post("/cshopping/put_to_cart",{id:id},function(result){
								var obj=$.parseJSON(result);
								if(obj.code)window.location="/shopping/cart";
								else alert(obj.message);
							});
						}
					}
     });
}
</script>