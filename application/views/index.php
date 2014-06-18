<link rel="stylesheet" href="/assets/css/index.css" type="text/css">
<script src="/assets/js/unslider.min.js"></script>
<script>
	$(function() {
		var slidey=$('#slider').unslider();
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
</script>
<div class="main-slider clearfix">
	<div class="slider" id="slider">
		<ul>
			<li><a href="/"><img src="/assets/img/index/1.jpg"/></a></li>
			<li><a href="/"><img src="/assets/img/index/2.jpg"/></a></li>
			<li><a href="/"><img src="/assets/img/index/3.jpg"/></a></li>
		</ul>
	</div>
	<a class="bt_nav icon-slides-prev icon-slides" id="previous">Previous</a>
	<a class="bt_nav icon-slides-next icon-slides" id="next">Next</a>
</div>
<div class="products">
	<?php foreach($products as $floor):?>
	<div class="floor clearfix">
		<div class="floor-head">
			<h3><?=$floor['cat']?></h3>
			<div class="filter">
				<ul>
					<li><a>全部</a></li>
					<li><a>手机</a></li>
					<li><a>电脑</a></li>
					<li><a>音箱</a></li>
				</ul>
			</div>
		</div>
		<ul class="lists">
		<?php foreach($floor['products'] as $product):?>
			<li class="box">
				<a href="/shopping/product?id=<?=$product->p_id?>" target="_blank">
					<img src="<?=unserialize($product->p_images)?unserialize($product->p_images)["0"]:""?>"/>
					<div class="product-info">
						<h4 class="name txt mr_t80"><?=$product->p_title?></h4>
						<span class="user txt color-red2"><?=$product->p_title?></span>
					</div>
				</a>
			</li>
		<?php endforeach;?>
		</ul>
	</div>
	<?php endforeach;?>
</div>