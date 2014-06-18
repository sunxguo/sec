<link rel="stylesheet" href="/assets/css/uc.css" type="text/css">
<link rel="stylesheet" href="/assets/kindEditor/themes/default/default.css" />
<script charset="utf-8" src="/assets/kindEditor/kindeditor-min.js"></script>
<script charset="utf-8" src="/assets/kindEditor/lang/zh_CN.js"></script>
<script>
var editor;
KindEditor.ready(function(K) {
	editor = K.create('textarea[name="content"]', {
		uploadJson : '/assets/kindEditor/php/upload_json.php',
		fileManagerJson : '/assets/kindEditor/php/file_manager_json.php',
		allowFileManager : true,
		width : '660px',
		height:'225px',
		resizeType:1,
		imageTabIndex:1,
		items : [
				'undo', 'redo', '|', 'justifyleft', 'justifycenter', 'justifyright',
				'justifyfull', 'fontname', 'fontsize', '|', 'forecolor', 'hilitecolor', 'bold',
				'italic', 'underline', 'strikethrough', 'lineheight', '|', 'image', 'multiimage',
				'flash', 'media', 'insertfile', 'table', 'hr', 'emoticons', 'link', 'unlink'
				]
	});
});
</script>
<div class="uc">
	<div class="uc-main">
		<div class="uc-header">
			<h3>用户信息</h3>
		</div>
		<div class="uc-body clearfix">
			<div class="avatar">
				<img src="<?=$user->u_img?>"/>
			</div>
			<div class="message">
				<div class="welcome">
					<span class="username"><a><?=$user->u_name?></a></span>
				</div>
				<ul class="clearfix">
					<li>QQ：<a href="javascript:window.location='tencent://message/?uin=<?=$user->u_qq?>';" class="qq"><?=$user->u_qq?></a></li>
					<li>Email：<a><?=$user->u_email?></a></li>
					<li>注册时间：<a><?=$user->u_creationtime?></a></li>
				</ul>
			</div>
			<div class="send-msg">
			<form method="post" action="/cuc/send_msg" enctype="multipart/form-data">
			<input name="touserid" value="<?=$user->u_id?>" type="hidden"/>
				<ul class="">
					<li class="line">给该用户发消息</li>
					<li class="line">标题：<input type="text" name="title" class="title"/></li>
					<li class="content">内容：<textarea name="content"></textarea></li>
					<li class="line"><input type="submit" value="发送" class="confirm_bt width200"/></li>
				</ul>
			</form>
			</div>
		</div>
	</div>
</div>