<link rel="stylesheet" href="/assets/css/uc.css" type="text/css">
<div class="uc">
	<?php require("uc-left.php");?>
	<div class="uc-main" id="uc_main">
		<div class="uc-header">
			<h3>我的消息</h3>
		</div>
		<div class="uc-orders clearfix">
			<table>
				<tr class="orders-header">
					<th class="c2">发件人</th>
					<th class="c1 width400">消息标题</th>
					<th class="c4">时间</th>
					<th class="c5">状态</th>
					<th class="c6">操作</th>
				</tr>
				<?php for($i=0;$i<2;$i++):?>
				<tr class="orders-info">
					<td class="c2"><a href="">郝贱</a></td>
					<td class="c1 width400 text-left">
						<a href="" class=" color-bule2">下雨收衣服了</a>
					</td>
					<td class="c4">2014-03-26 09:31:52</td>
					<td class="c5">未查看</td>
					<td class="c6">
						<input type="button" value="查看" class="confirm_bt" onclick="check_detail()"/>
						<input type="button" value="删除" class="a_bt_err mg_t10 width100"/>
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
	<div class="msg-detail uc-main" id="msg_detail">
		<div class="msg-detail-header">
			<span class="color-bule2">账户风险提示（重要）</span>-学友消息
			<div class="close" onclick="window.location.reload()">X</div>
		</div>
		<ul>
			<li>发件人：</li>
			<li>收件人：</li>
			<li class="b-none">内容：</li>
			<p class="text-intent2">我们发现您最近一次登录可能存在异常，
				请查看并核实近期的登录历史，如果存在非您本人的登录记录我们发现您最近一次登录可能存在异常，
				请查看并核实近期的登录历史，如果存在非您本人的登录记录
			</p>
		</ul>
		<a class="a_bt_err width150 mg_t20 margin-auto">删除</a>
	</div>
	<script>
		function check_detail(){
			$("#msg_detail").show();
			$("#uc_main").hide();
		}
	</script>
</div>
<div class="backdrop"></div>