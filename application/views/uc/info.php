<link rel="stylesheet" href="/assets/css/uc.css" type="text/css">
<div class="uc">
	<?php require("uc-left.php");?>
	<div class="uc-main">
		<div class="uc-header">
			<h3>我的资料</h3>
		</div>
		<div class="uc-info clearfix">
			<form method="post" action="/cuc/new_info" enctype="multipart/form-data">
				<div class="wraper clearfix">
					<div class="avatar" id="avatar">
						<img src="<?=$info->u_img?>"/>
						<div class="upload-new-avatar" id="upload-new-avatar">
							上传新头像
						</div>
						<input type="file" style="display:none;" accept="image/*" name="image" id="avatar_img" >
					</div>
					<div class="info">
						<div class="nick">
							<span class="username"><input name="username" type="text" value="<?=$info->u_name?>"></a></span>
						</div>
						<div class="safe">
						<?php if(isset($_SESSION["phone"]) && $_SESSION["phone"]!=0 && $_SESSION["phone"]!=""){?>
							<ul id="old_phone">
								<li>已绑定手机号：<?=$_SESSION["phone"]?>&nbsp;&nbsp;<input type="button" value="修改" onclick="bind_new_phone()" class="input-bt radius3"/></li>
							</ul>
							<ul style="display:none;" id="bind_new_phone">
								<li>绑定手机号</li>
								<li>
									①&nbsp;&nbsp;<input type="text" id="phoneNum" placeholder="187****0576" class="input-text radius3"/>
									<input type="button" value="发送验证码" onclick="send_code()" class="input-bt radius3"/>
									<span id="phoneMsg"></span>
								</li>
								<li>
									②&nbsp;&nbsp;输入验证码：<input type="text" id="code" value="" class="input-text radius3 width160"/>
									<span id="phoneCodeMsg"></span>
								</li>
								<li>
									③&nbsp;&nbsp;<input type="button" value="验证" onclick="bind_phone()" class="input-bt radius3"/>
								</li>
							</ul>
						<?php }else{?>
							<ul>
								<li>绑定手机号</li>
								<li>
									①&nbsp;&nbsp;<input type="text" id="phoneNum" placeholder="187****0576" class="input-text radius3"/>
									<input type="button" value="发送验证码" onclick="send_code()" class="input-bt radius3"/>
									<span id="phoneMsg"></span>
								</li>
								<li>
									②&nbsp;&nbsp;输入验证码：<input type="text" id="code" value="" class="input-text radius3 width160"/>
									<span id="phoneCodeMsg"></span>
								</li>
								<li>
									③&nbsp;&nbsp;<input type="button" value="验证" onclick="bind_phone()" class="input-bt radius3"/>
								</li>
							</ul>
						<?php }?>
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
$(document).ready(function(){
	$("#phoneNum").blur(function (){
		checkSubmitMobile();
	});
	$("#code").blur(function (){
		checkSubmitMobileCode();
	});
	$("#avatar").mouseover(function (){
		$("#upload-new-avatar").show();
	}) .mouseout(function (){
		$("#upload-new-avatar").hide();
	});
	$("#upload-new-avatar").click(function(){
		$("#avatar_img").click();
	});
});
function bind_new_phone(){
	$("#old_phone").hide();
	$("#bind_new_phone").show();
}
function bind_phone(){
	if(checkSubmitMobile()  && checkSubmitMobileCode()){
		$.post("/cuc/bind_phone",
				{
					phone:$("#phoneNum").val()
				},
				function(data){
					var rs=$.parseJSON(data);
					if(rs.code) {
						alert(rs.message);
						window.location.reload();
					}
					else {alert(rs.message);}
				}
		);
		return true;
	}
}
//jquery验证手机号码 
function checkSubmitMobile(){ 
	var result=false;
    if($("#phoneNum").val()==""){ 
		$("#phoneMsg").html("<font color='red'>× 手机号码不能为空！</font>"); 
		return false; 
	} 

    if(!$("#phoneNum").val().match(/^1[3|4|5|8][0-9]\d{8,8}$/)){ 
		$("#phoneMsg").html("<font color='red'>× 手机号码格式不正确！</font>"); 
		return false; 
    }
	
	$.ajax({
          type : "post",  
          url : "/cuc/is_exist_phone",  
          data : "phone="+$("#phoneNum").val(),  
          async : false,  
          success : function(data){
						var rs=$.parseJSON(data);
						if(rs.code) {
							$("#phoneMsg").html("<font color='red'>× 该号码已被绑定</font>");
							result=false;
						}
						else {
							$("#phoneMsg").html("<font color='green'>√ 正确</font>"); 
							result=true;
						}
					}
     });
//	$("#phoneMsg").html("<font color='green'>√ 正确</font>"); 
    return result; 
}
//发送验证码
function send_code(){
	if(checkSubmitMobile()){
		$.post("/cuc/send_mobile_code",
				{
					phone:$("#phoneNum").val()
				},
				function(data){
					var rs=$.parseJSON(data);
					if(rs.code) $("#phoneMsg").html("<font color='green'>√ "+rs.message+"</font>"); 
					else $("#phoneMsg").html("<font color='red'>× "+rs.message+"</font>");
				}
		);
	}
}
//jquery验证手机验证码
function checkSubmitMobileCode(){
	if($("#code").val().length==0){
		$("#phoneCodeMsg").html("<font color='red'>× 验证码不能为空！</font>"); 
		return false;
	}
	var result=false;
	$.ajax({  
          type : "post",  
          url : "/cuc/check_mobile_code",  
          data : "mobile_code="+$("#code").val(),  
          async : false,  
          success : function(data){
						var rs=$.parseJSON(data);
						if(rs.code){
							$("#phoneCodeMsg").html("<font color='green'>√ "+rs.message+"</font>"); 
							result=true;
						}
						else {
							$("#phoneCodeMsg").html("<font color='red'>× "+rs.message+"！</font>"); 
							result=false;
						}
					}
     });
	return result;
}
</script>