<link rel="stylesheet" href="/assets/css/uc.css" type="text/css">
<script src="/assets/js/product.js" type="text/javascript"></script>
<div class="uc">
	<?php require("uc-left.php");?>
	<div class="uc-main">
		<div class="uc-header">
			<h3>卖家-商品</h3>
		</div>
		<div class="uc-orders clearfix">
			<table>
				<tr class="orders-header">
					<th class="lc1">商品</th>
					<th class="c3">价格</th>
					<th class="c4">发布时间</th>
					<th class="c5">状态</th>
					<th class="c6">操作</th>
				</tr>
				<?php foreach($products as $item):?>
				<tr class="orders-info <?=$item->p_listed==0?"off":"on"?>">
					<td class="c1">
						<a href="/shopping/product?id=<?=$item->p_id?>" target="_blank">
							<?php $imgs=unserialize($item->p_images);foreach($imgs as $img):?>
							<img src="<?=$img?>" title="<?=property_exists($item,"p_title")?$item->p_title:""?>"/>
							<?php endforeach;?>
						</a>
					</td>
					<td class="c3 color-red"><?=property_exists($item,"p_price")?"￥".$item->p_price:""?></td>
					<td class="c4"><?=property_exists($item,"p_publishTime")?$item->p_publishTime:""?></td>
					<td class="c5 status"><?=property_exists($item,"p_status")?$item->p_status:""?></td>
					<td class="c6 font15">
						<a href="/shopping/product?id=<?=$item->p_id?>" target="_blank" class="a-green" >查看</a> |
						<a href="javascript:shel_product('<?=$item->p_id?>','<?=$item->p_listed==0?1:0?>');" class="a-blue"><?=$item->p_listed==0?"上架":"下架"?></a><br>
						<a href="javascript:del_product('<?=$item->p_id?>')" class="a-red">删除<a>
					</td>
				</tr>
				<?php endforeach;?>
			</table>
		</div>
		<div class="uc-footer mg_t20">
			<?=$show_page?>页
			<a href="<?=$pre_link?>" class="<?=($pre_link=="javascript:void();")?"no":"page_bt"?>">上一页</a>
			<a href="<?=$next_link?>" class="<?=($next_link=="javascript:void();")?"no":"page_bt"?>">下一页</a>
		</div>
	</div>
</div>