$(document).ready(function(){
		$("input:button[name=deleteButton]").click(function(){
			var checked = [];
			$('input:checkbox[name=pro]:checked').each(function() {
				if($(this).val()!="on"){
					checked.push($(this).val());
				}
			});
			if(checked.length > 0){
				$.post("/merchant/product_delete",{'checked':checked},function(data){alert(data);location.href = "/merchant/"+$("#type").val();});
			}else{
				alert("请先选择要删除的商品！");
			}
			
		});
		$(".side-cat ul li").mouseover(function(){
			$(this).children(".subCat").offset().top=$(this).index()*40+'px';
			$(this).children(".subCat").show();
			$(this).children(".showPos").show();
		});
		$(".side-cat ul li").mouseout(function(){
			$(this).children(".subCat").hide();
			$(this).children(".showPos").hide();
		});
		$('#backdrop').click(function(){
			hideLogin();
		});
		$("#miniCart").mouseover(function(){
			$(this).addClass("mini-cart-on");
			$("#miniCartList").delay(100).show(300);
		});
		$("#miniCart").mouseout(function(){
			$(this).removeClass("mini-cart-on");
			$("#miniCartList").delay(1000).hide(300);
		});
});	
	function showLogin(){
		$('#login-panel').show(200);
		$('#backdrop').show();
	}
	function hideLogin(){
		$('#login-panel').hide(200);
		$('#backdrop').hide();
	}
	function confirmDeal(){
		if(confirm("您将遵守诚信协议，并和卖家线下交易？")){
			//ajax生成订单
			
		}
	}
	function login(){
		var url = arguments[0] ? arguments[0] : "self";
		if($("#miniLogin_username").val() && $("#miniLogin_pwd").val()){
			var type=check_type($("#miniLogin_username").val());
			if(!type){ alert("发生错误！");return;}
			$.post("/cuc/login_user",
					{
						type:type,
						username:$("#miniLogin_username").val(),
						pwd:$("#miniLogin_pwd").val(),
						remeberMe:$("#auto").prop("checked")
					},
					function(data){
						var rs=$.parseJSON(data);
						if(rs.code) {if(url=="self")window.location.reload();else window.location=url;}
						else{alert(rs.message);}
					}
			);
			return true;
		}else{
			alert("请输入用户名和密码");
		}
	}
	function logout(){
		$.get("/cuc/logout",
					function(data){
						var rs=$.parseJSON(data);
						if(rs.code) {window.location.reload();}
					}
		);
	}
	function check_type(value){
		if(value==""){ 
			return false;
		} 
		if(value.match(/^1[3|4|5|8][0-9]\d{8,8}$/))
			return "phone"; 
		if(value.match(/^\w+((-\w+)|(\.\w+))*\@[A-Za-z0-9]+((\.|-)[A-Za-z0-9]+)*\.[A-Za-z0-9]+$/))
			return "email"; 
		return false;
	}
	//让指定的DIV始终显示在屏幕正中间   
	function setDivCenter(divId){  
		var top = ($(window).height() - $(divId).height())/2;   
		var left = ($(window).width() - $(divId).width())/2;   
		var scrollTop = $(document).scrollTop();   
		var scrollLeft = $(document).scrollLeft();   
		$(divId).css( { position : 'absolute', top : top + scrollTop, left : left + scrollLeft } ).show(600);  
	}
	function removeDiv(divId){  
		$(divId).hide(600);  
	}	
	function jump(keywords){
		var pageNum=$('#pagenum').val();
		if(pageNum>0&&pageNum!=null)
			location.href="/merchant/"+$("#type").val()+"?page="+pageNum+keywords;
		else
			alert("请输入正确页数!");
	}
	