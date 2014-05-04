<link rel="stylesheet" href="/assets/css/uc.css" type="text/css">
<div class="uc">
	<?php require("uc-left.php");?>
	<div class="uc-main">
		<div class="uc-header">
			<h3>我的资料</h3>
		</div>
		<div class="uc-info clearfix">
			<form method="post" action="" enctype="multipart/form-data">
				<div class="wraper clearfix">
					<div class="avatar" id="avatar">
						<img src="/assets/img/uc/avatar.png"/>
						<div class="upload-new-avatar" id="upload-new-avatar">
							上传新头像
						</div>
					</div>
					<div class="info">
						<div class="nick">
							<span class="username"><input name="username" type="text" value="郝贱"></a></span>
						</div>
						<div class="safe">
							<ul>
								<li>绑定手机号</li>
								<li>
									①&nbsp;&nbsp;<input type="text" placeholder="187****0503" class="input-text radius3"/>
									<input type="button" value="发送验证码" class="input-bt radius3"/>
								</li>
								<li>
									②&nbsp;&nbsp;输入验证码：<input type="text" value="" class="input-text radius3"/>
								</li>
								<li>
									③&nbsp;&nbsp;<input type="button" value="验证" class="input-bt radius3"/>
								</li>
							</ul>
							<ul>
								<li>已绑定手机号：187****0503&nbsp;&nbsp;<input type="button" value="修改" class="input-bt radius3"/></li>
							</ul>
						</div>
					</div>
				</div>
				<div class="save">
					<input type="submit" value="保存修改" class="confirm_bt width200"/>
				</div>
			</form>
		</div>
	</div>
</div>
<script>
	$("#avatar").mouseover(function (){
		$("#upload-new-avatar").show();
	}) .mouseout(function (){
		$("#upload-new-avatar").hide();
	});
</script>