<link rel="stylesheet" href="/assets/css/uc.css" type="text/css">
<div class="uc">
	<?php require("uc-left.php");?>
	<div class="uc-main">
		<div class="uc-header">
			<h3>买家-订单</h3>
		</div>
		<div class="uc-orders clearfix">
			<table>
				<tr class="orders-header">
					<th class="c1">商品</th>
					<th class="c2">卖家</th>
					<th class="c3">订单金额</th>
					<th class="c4">时间</th>
					<th class="c5">状态</th>
					<th class="c6">操作</th>
				</tr>
				<?php foreach($orders as $item):?>
				<tr class="order-num">
					<td colspan="6">订单号：<a class="color-bule"><?=$item->o_number?></a></td>
				</tr>
				<tr class="orders-info">
					<td class="c1">
						<?php foreach($item->products as $product):?>
						<a href="/shopping/product?id=<?=$product->p_id?>" target="_blank">
							<img src="<?php $imgs=unserialize($product->p_images);if(count($imgs)>0) echo $imgs[0];?>" title="<?=$product->p_title?>" alt="<?=$product->p_title?>"/>
						</a>
						<?php endforeach;?>
					</td>
					<td class="c2"><a href="/uc/user?id=<?=$item->o_seller?>" target="_blank"><?=$item->merchant->u_name?></a></td>
					<td class="c3 color-red">￥<?=$item->o_total?></td>
					<td class="c4"><?=$item->o_time?></td>
					<td class="c5 <?=$item->o_status?>"><?=$item->cn_status?></td>
					<td class="c6">
					<!--	<input type="button" value="查看" class="confirm_bt"/>-->
					<!--	<input type="button" value="晒单" class="confirm_bt mg_t10"/>-->
					<a href="javascript:modify_status('<?=$item->o_id?>','complete');" class="a_bt">交易成功</a>
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