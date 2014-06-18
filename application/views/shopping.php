<link rel="stylesheet" href="/assets/css/shopping.css" type="text/css">
<div class="shopping">
	<?php if($filter):?>
	<div class="filter radius4">
		<div class="filter-header"><span class="cat"><?=$filter->cat_name?></span>-商品筛选</div>
		<ul class="filter-body">
			<?php /* foreach(unserialize($item->cat_property) as $item):?>
			<li class="filter-item clearfix">
				<div class="param"><?=$item->name?>：</div>
				<dl>
					<?php foreach($item->value as $v):?>
					<dd><a><?=$v?></a></dd>
					<?php endforeach;?>
				</dl>
			</li>
			<?php endforeach;*/?>
			<li class="filter-item clearfix">
				<form id="filter_form" action="" method="get">
					<dl>
					<?php  $property=explode(',', $filter->cat_property); foreach($property as $item):?>
					<?php  if(isset( $_GET['pro'])) $get_property=explode(',', $_GET['pro']);?> 
					<dd><a href="<?=isset($_GET['pro']) && in_array($item,$get_property)?"javascript:r_filter('".$item."')":"javascript:filter('".$item."')"?>" class="<?=isset($_GET['pro']) && in_array($item,$get_property)?"check":""?>"><?=$item?></a></dd>
					<?php endforeach;?>
					</dl>
					<?php if(isset($_GET['name'])):?>
					<input name="name" type="hidden" value="<?=$_GET['name']?>"/>
					<?php endif;?>
					<?php if(isset($_GET['page'])):?>
					<input name="page" type="hidden" value="<?=$_GET['page']?>"/>
					<?php endif;?>
					<?php if(isset($_GET['cat'])):?>
					<input name="cat" type="hidden" value="<?=$_GET['cat']?>"/>
					<?php endif;?>
					<?php if(isset($_GET['scat'])):?>
					<input name="scat" type="hidden" value="<?=$_GET['scat']?>"/>
					<?php endif;?>
					<?php if(isset($_GET['order'])):?>
					<input name="order" type="hidden" value="<?=$_GET['order']?>"/>
					<?php endif;?>
					<input name="pro" type="hidden" value="<?=isset($_GET['pro'])?$_GET['pro']:""?>" id="filter_input" />
				</form>
			</li>
		</ul>
	</div>
	<?php endif;?>
	<div class="products-header clearfix radius4">
		<div class="order">
			<span>排序：</span>
			<ul>
			<form id="order_type" action="" method="get">
				<li class="price <?=isset($_GET['order']) && $_GET['order']=="price"?"check":""?>" onclick="order('price');">价格 ↑</li>
				<li class="price <?=isset($_GET['order']) && $_GET['order']=="-price"?"check":""?>" onclick="order('-price');">价格 ↓</li>
				<li class="time <?=isset($_GET['order']) && $_GET['order']=="time"?"check":""?>" onclick="order('time');">发布时间</li>
				<input name="name" type="hidden" value="<?=isset($_GET['name'])?$_GET['name']:""?>"/>
				<input name="page" type="hidden" value="<?=isset($_GET['page'])?$_GET['page']:1?>"/>
				<input name="cat" type="hidden" value="<?=isset($_GET['cat'])?$_GET['cat']:""?>"/>
				<input name="scat" type="hidden" value="<?=isset($_GET['scat'])?$_GET['scat']:""?>"/>
				<input name="pro" type="hidden" value="<?=isset($_GET['pro'])?$_GET['pro']:""?>"/>
				<input id="order_type_input" name="order" type="hidden"/>
			</form>
			</ul>
		</div>
		<div class="page">
			<?=$page_current?>/<?=$page_amount?>页
			<a href="<?=$pre_link?>" class="<?=($pre_link=="javascript:void();")?"no":"page_bt"?>">上一页</a>
			<a href="<?=$next_link?>" class="<?=($next_link=="javascript:void();")?"no":"page_bt"?> ">下一页</a>
		</div>
	</div>
	<div class="products-list clearfix">
		<ul class="lists">
		<?php foreach($products as $item):?>
			<li class="box">
				<a href="/shopping/product?id=<?=$item->p_id?>" title="<?=$item->p_title?>">
					<img src="<?php $imgs=unserialize($item->p_images);if(count($imgs)>0) echo $imgs[0];?>"/>
					<span class="title"><?=$item->p_title?></span>
				</a>
				<span class="price">￥<?=$item->p_price?></span>
				<div class="oper">
					<?php if($item->p_status==0){?>
						<input type="button" value="加入购物车" onclick="addToCart('<?=$item->p_id?>')"/>
						<input type="button" value="立即交易" onclick="confirmDeal('<?=$item->p_id?>')"/>
					<?php }else{?>
						<input type="button" value="该商品已被预定" onclick="alert('抱歉，该商品已被预定');"/>
					<?php }?>
				</div>
			</li>
		<?php endforeach;?>
		</ul>
	</div>
	<div class="products-header clearfix products-footer">
		<div class="page">
			<?=$page_current?>/<?=$page_amount?>页
			<a href="<?=$pre_link?>" class="<?=($pre_link=="javascript:void();")?"no":"page_bt"?>">上一页</a>
			<a href="<?=$next_link?>" class="<?=($next_link=="javascript:void();")?"no":"page_bt"?> ">下一页</a>
		</div>
	</div>
</div>
<script>
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
								alert(obj.message);
							});
						}
					}
     });
}
function order(type){
	$("#order_type_input").val(type);
	$("#order_type").submit();
}
function filter(name){
	var new_filter=($("#filter_input").val()=="")?name:$("#filter_input").val()+','+name;
	$("#filter_input").val(new_filter);
	$("#filter_form").submit();
}
function r_filter(name){
	var a=$("#filter_input").val().split(",");
	var b=new Array();
	for(i=0;i<a.length;i++)
	{
		if(a[i]!=name) b[i]=a[i];
	}
	var c=b.join(",");
	$("#filter_input").val(c);
	$("#filter_form").submit();
}
</script>