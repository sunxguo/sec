<link rel="stylesheet" href="/assets/css/uc.css" type="text/css">
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
					<th class="c4">时间</th>
					<th class="c5">状态</th>
					<th class="c6">操作</th>
				</tr>
				<?php foreach($products as $item):?>
				<tr class="orders-info">
					<td class="c1">
						<a href="">
							<?php if(unserialize($item->p_images))foreach(unserialize($item->p_images) as $img):?>
							<img src="<?=$img?>" title="<?=property_exists($item,"p_title")?$item->p_title:""?>"/>
							<?php endforeach;?>
						</a>
					</td>
					<td class="c3 color-red"><?=property_exists($item,"p_price")?$item->p_price:""?></td>
					<td class="c4"><?=property_exists($item,"p_publishTime")?$item->p_publishTime:""?></td>
					<td class="c5"><?=property_exists($item,"p_status")?$item->p_status:""?></td>
					<td class="c6">
						<input type="button" value="查看" class="confirm_bt"/>
						<input type="button" value="发布/下架" class="confirm_bt mg_t10"/>
					</td>
				</tr>
				<?php endforeach;?>
			</table>
		</div>
		<div class="uc-footer mg_t20">
			1/2页
			<a class="no">上一页</a>
			<a class="page_bt">上一页</a>
		</div>
	</div>
</div>