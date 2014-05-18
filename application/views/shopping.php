<link rel="stylesheet" href="/assets/css/shopping.css" type="text/css">
<div class="shopping">
	<?php if($filter && unserialize($filter->cat_property)):?>
	<div class="filter radius4">
		<div class="filter-header"><span class="cat"><?=$filter->cat_name?></span>-商品筛选</div>
		<ul class="filter-body">
			<?php foreach(unserialize($item->cat_property) as $item):?>
			<li class="filter-item clearfix">
				<div class="param"><?=$item->name?>：</div>
				<dl>
					<?php foreach($item->value as $v):?>
					<dd><a><?=$v?></a></dd>
					<?php endforeach;?>
				</dl>
			</li>
			<?php endforeach;?>
		</ul>
	</div>
	<?php endif;?>
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
			<?=$page_current?>/<?=$page_amount?>页
			<a class="no">上一页</a>
			<a class="page_bt ">下一页</a>
		</div>
	</div>
	<div class="products-list clearfix">
		<ul class="lists">
		<?php foreach($products as $item):?>
			<li class="box">
				<a href="/shopping/product?id=<?=$item->p_id?>" title="<?=$item->p_title?>">
					<img src="<?php if(unserialize($item->p_images)) echo unserialize($item->p_images)[0];?>"/>
					<span class="title"><?=$item->p_title?></span>
				</a>
				<span class="price"><?=$item->p_price?></span>
				<div class="oper">
					<input type="button" value="加入购物车"/>
					<input type="button" value="立即交易" onclick="confirmDeal()"/>
				</div>
			</li>
		<?php endforeach;?>
		</ul>
	</div>
	<div class="products-header clearfix products-footer">
		<div class="page">
			<?=$page_current?>/<?=$page_amount?>页
			<a class="no">上一页</a>
			<a class="page_bt ">下一页</a>
		</div>
	</div>
</div>