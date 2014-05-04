<link rel="stylesheet" href="/assets/css/uc.css" type="text/css">
<script charset="utf-8" src="/assets/js/uc.js"></script>
<div class="uc">
	<div class="uc-main mr_l150">
		<div class="uc-register radius4 clearfix">
			<div class="uc-header">
				<h3>注册学城</h3>
			</div>
			<div class="reg-wraper">
				<div class="wraper clearfix">
					<div class="info">
						<div class="register_style clearfix">
						  <ul>
							<li id="phone_bt" class="r_phone_sel"><a href="javascript:void();">手机注册 </a> </li>
							<li id="email_bt" class="r_email"><a href="javascript:void();">邮箱注册</a></li>
						  </ul>
						</div>
						<div class="safe">
							<ul id="phone">
								<li>
									①<span>手机号：</span>
									<input id="phoneNum" type="text" placeholder="" class="input-text radius3 width100"/>
									<input type="button" value="发送验证码" onclick="send_code()" class="input-bt radius3"/>
									<span id="phoneMsg"></span>
								</li>
								<li>
									②<span>验证码：</span>
									<input id="code" type="text" value="" class="input-text radius3"/>
									<span id="phoneCodeMsg"></span>
								</li>
								<li>
									③<span>昵称：</span>
									<input id="PUsername" type="text" placeholder="您随意，昵称不可用于登录" class="input-text radius3"/>
								</li>
								<li>
									④<span>QQ：</span>
									<input id="Pqq" type="text" placeholder="" class="input-text radius3"/>
								</li>
								<li>
									⑤<span>密码：</span>
									<input id="PPwd" type="password" value="" class="input-text radius3"/>
									<span id="phonePwdMsg"></span>
								</li>
								<li>
									⑥<span>确认密码：</span>
									<input id="PCPwd" type="password" value="" class="input-text radius3"/>
									<span id="phoneCPwdMsg"></span>
								</li>
							</ul>
							<ul id="email">
								<li>
									①<span>邮箱：</span>
									<input id="emailString" type="email" placeholder="" class="input-text radius3"/>
									<span id="emailMsg"></span>
								</li>
								<li>
									②<span>昵称：</span>
									<input id="EUsername" type="text" placeholder="您随意，昵称不可用于登录" class="input-text radius3"/>
								</li>
								<li>
									③<span>QQ：</span>
									<input id="Eqq" type="text" placeholder="" class="input-text radius3"/>
								</li>
								<li>
									④<span>密码：</span>
									<input id="EPwd" type="password" value="" class="input-text radius3"/>
									<span id="emailPwdMsg"></span>
								</li>
								<li>
									⑤<span>确认密码：</span>
									<input id="ECPwd" type="password" value="" class="input-text radius3"/>
									<span id="emailCPwdMsg"></span>
								</li>
							</ul>
							<div style="display:none">
								<input type="radio" value="phone" name="type" id="radio_phone" checked/>
								<input type="radio" value="email" name="type" id="radio_email"/>
							</div>
						</div>
					</div>
				</div>
				<div class="save">
					<input type="submit" value="遵守协议并注册" onclick="register()" class="confirm_bt width200 height40"/>
				</div>
			</div>
		</div>
	</div>
</div>