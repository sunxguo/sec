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
					<th class="c2">收件人</th>
					<th class="c1 width400">消息标题</th>
					<th class="c4">时间</th>
					<th class="c5">状态</th>
					<th class="c6">操作</th>
				</tr>
				<?php foreach($messages as $message):?>
				<tr class="orders-info">
					<td class="c2"><a href="/uc/user?id=<?=$message->msg_from_uid?>" target="_blank" id="msg-from-user<?=$message->msg_id?>"><?=$message->msg_from_u->u_name?></a></td>
					<td class="c2"><a href="/uc/user?id=<?=$message->msg_to_uid?>" target="_blank" id="msg-to-user<?=$message->msg_id?>"><?=$message->msg_to_u->u_name?></a></td>
					<td class="c1 width400 text-left">
						<a href="javascript:check_detail('<?=$message->msg_id?>');" class=" color-bule2" id="msg-title<?=$message->msg_id?>"><?=$message->msg_title?></a>
					</td>
					<td class="c4" id="msg-time<?=$message->msg_id?>"><?=$message->msg_time?></td>
					<td class="c5"><?=$message->msg_cn_status?></td>
					<td id="msg-content<?=$message->msg_id?>" style="display:none;"><?=$message->msg_content?></td>
					<td class="c6">
						<input type="button" value="查看" class="confirm_bt" onclick="check_detail('<?=$message->msg_id?>')"/>
						<input type="button" value="删除" class="a_bt_err mg_t10 width100" onclick="del_msg('<?=$message->msg_id?>')"/>
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
	<div class="msg-detail uc-main" id="msg_detail">
		<div class="msg-detail-header">
			<span id="msg-title" class="color-bule2"></span>-学友消息
			<div class="close" onclick="window.location.reload()">X</div>
		</div>
		<ul>
			<li>发件人：<span id="msg-from-user"></span></li>
			<li>收件人：<span id="msg-to-user"></span></li>
			<li class="b-none">正文：</li>
			<p id="msg-content" class="text-intent2"></p>
		</ul>
		<input type="hidden" id="msg-id"/>
		<a class="a_bt_err width150 mg_t20 margin-auto" href="javascript:del_detail_msg();">删除</a>
	</div>
</div>
<div class="backdrop"></div>