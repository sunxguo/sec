$(document).ready(function (){
	$("#phone_bt").click(function (){
		$(this).attr("class","r_phone_sel");
		$("#email_bt").attr("class","r_email");
		$("#phone").show();
		$("#email").hide();
		$("#radio_phone").prop("checked", true); 
	});
	$("#email_bt").click(function (){
		$(this).attr("class","r_email_sel");
		$("#phone_bt").attr("class","r_phone");
		$("#phone").hide();
		$("#email").show();
		$("#radio_email").prop("checked", true); 
	});
	$("#phoneNum").blur(function (){
		checkSubmitMobile();
	});
	$("#emailString").blur(function (){
		checkSubmitEmail();
	});
	$("#PPwd").blur(function (){
		checkSubmitPwd('phone');
	});
	$("#EPwd").blur(function (){
		checkSubmitPwd('email');
	});
	$("#PCPwd").blur(function (){
		checkSubmitConfirmPwd('phone');
	});
	$("#ECPwd").blur(function (){
		checkSubmitConfirmPwd('email');
	});
	$("#code").blur(function (){
		checkSubmitMobileCode();
	});
});

function register(){
	if($("#radio_phone").prop("checked")){
		var type="phone";
		if(checkSubmitMobile() && checkSubmitPwd(type) && checkSubmitConfirmPwd(type) && checkSubmitMobileCode()){
			$.post("/cuc/register_user",
					{
						type:"phone",
						name:$("#PUsername").val(),
						pwd:$("#PPwd").val(),
						qq:$("#Pqq").val(),
						value:$("#phoneNum").val()
					},
					function(data){
						var rs=$.parseJSON(data);
						if(rs.code) {
							$("#miniLogin_username").val($("#phoneNum").val());
							$("#miniLogin_pwd").val($("#PPwd").val());
							$("#auto").prop("checked",false);
							login();
							window.location.href = "/";
						}
						else {alert(rs.message);}
					}
			);
			return true;
		}
		return false;
	}else{
		var type="email";
		if(checkSubmitEmail()&&checkSubmitPwd(type) && checkSubmitConfirmPwd(type)){
			$.post("/cuc/register_user",
					{
						type:"email",
						name:$("#EUsername").val(),
						pwd:$("#EPwd").val(),
						qq:$("#Eqq").val(),
						value:$("#emailString").val()
					},
					function(data){
						var rs=$.parseJSON(data);
						if(rs.code) {
							$("#miniLogin_username").val($("#emailString").val());
							$("#miniLogin_pwd").val($("#EPwd").val());
							$("#auto").prop("checked",false);
							login("/");
						}
						else {alert(rs.message);}
					}
			);
			return true;
		}
		return false;
	}
}
//jquery验证手机号码 
function checkSubmitMobile(){ 
    if($("#phoneNum").val()==""){ 
		$("#phoneMsg").html("<font color='red'>× 手机号码不能为空！</font>"); 
		$("#phoneNum").focus(); 
		return false; 
	} 

    if(!$("#phoneNum").val().match(/^1[3|4|5|8][0-9]\d{8,8}$/)){ 
		$("#phoneMsg").html("<font color='red'>× 手机号码格式不正确！</font>"); 
		$("#phoneNum").focus(); 
		return false; 
    } 
	$("#phoneMsg").html("<font color='green'>√ 正确</font>"); 
    return true; 
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
//jquery验证邮箱 
function checkSubmitEmail(){
    if($("#emailString").val()==""){
		$("#emailMsg").html("<font color='red'>× 邮箱地址不能为空！</font>"); 
		$("#emailString").focus(); 
		return false; 
    } 
    if(!$("#emailString").val().match(/^\w+((-\w+)|(\.\w+))*\@[A-Za-z0-9]+((\.|-)[A-Za-z0-9]+)*\.[A-Za-z0-9]+$/)){ 
		$("#emailMsg").html("<font color='red'>× 邮箱格式不正确！</font>"); 
		$("#emailString").focus(); 
		return false; 
	}
	$("#emailMsg").html("<font color='green'>√ 正确</font>"); 
    return true; 
}
//jquery验证密码
function checkSubmitPwd(type){
	var pwdId=(type=="email")?"#EPwd":"#PPwd";
	var pwdMsg=(type=="email")?"#emailPwdMsg":"#phonePwdMsg";
	var pwd=$(pwdId).val();
    if (pwd.length > 22 || pwd.length < 6){
		$(pwdMsg).html("<font color='red'>× 密码长度 6-22 位！</font>"); 
		return false;
	}
	$(pwdMsg).html("<font color='green'>√ 正确</font>"); 
	return true;
}
//jquery验证确认密码
function checkSubmitConfirmPwd(type){
	var pwdId=(type=="email")?"#EPwd":"#PPwd";
	var confirmPwdId=(type=="email")?"#ECPwd":"#PCPwd";
	var pwdMsg=(type=="email")?"#emailCPwdMsg":"#phoneCPwdMsg";
	var pwd=$(pwdId).val();
	var confirmPwd=$(confirmPwdId).val();
    if (pwd!=confirmPwd){
		$(pwdMsg).html("<font color='red'>× 密码不一致！</font>"); 
		return false;
	}
	$(pwdMsg).html("<font color='green'>√ 正确</font>"); 
	return true;
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