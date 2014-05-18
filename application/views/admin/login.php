<div class="login-panel" id="login-panel">
	<div class="login-head">
		<h3>登录与注册</h3>
		<a class="close" onclick="hideLogin()">x</a>
	</div>
	<div class="login-main">
		<dl>
			<dd>
				<input type="text" id="miniLogin_username" name="miniLogin_username" placeholder="请输入邮箱/手机号码" data-rule="(^[\w.\-]+@(?:[a-z0-9]+(?:-[a-z0-9]+)*\.)+[a-z]{2,3}$)|(^1[3|4|5|8]\d{9}$)|(^\d{3,}$)|(^\++\d{2,})" autocomplete="off"/><span class="msgTips"></span>
			</dd>
			<dd>
				<input type="password" id="miniLogin_pwd" name="miniLogin_pwd" placeholder="请输入密码" data-rule="" /><span class="msgTips"></span>
			</dd>
		</dl>
		<div class="miniLogin_auto cfl clearfix">
			<label for="auto"><input type="checkbox" id="auto" name="auto" value="true" /><span>自动登录</span></label>
			<p><a href="javascript:;" onclick="window.open('')">忘记密码？</a> </p>
		</div>
		<div class="miniLogin_btn cfl clearfix">
			<input type="submit" class="no_bg" value="立即登录" onclick="login()"/>
			<a href="/uc/register" target="_blank">注册</a>
		</div>
	</div>
</div>