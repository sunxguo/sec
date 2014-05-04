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
					<th class="c7">商品</th>
					<th class="c1">标题</th>
					<th class="c3">价格</th>
					<th class="c4">时间</th>
					<th class="c5">状态</th>
					<th class="c6">操作</th>
				</tr>
				<?php for($i=0;$i<6;$i++):?>
				<tr class="orders-info">
					<td class="c7">
						<a href="">
							<img src="" title=""/>
						</a>
					</td>
					<td class="c1"><a href="" class="color-bule2">三星手机</a></td>
					<td class="c3 color-red">￥998</td>
					<td class="c4">2014-03-26 09:31:52</td>
					<td class="c5">交易成功</td>
					<td class="c6">
						<input type="button" value="查看" class="confirm_bt"/>
						<input type="button" value="发布/下架" class="confirm_bt mg_t10"/>
					</td>
				</tr>
				<?php endfor;?>
			</table>
		</div>
		<div class="uc-footer mg_t20">
			1/2页
			<a class="no">上一页</a>
			<a class="page_bt">上一页</a>
		</div>
	</div>
</div>