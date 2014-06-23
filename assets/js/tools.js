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
		$("#miniCart").mouseenter(function(){
			$("#miniCartBt").addClass("mini-cart-on");
			$("#miniCartList").show();
			$("#cart_list").html("数据加载中，请稍后...");
			get_mini_cart();
		});
		$("#miniCart").mouseleave(function(){
			$("#miniCartBt").removeClass("mini-cart-on");
			$("#miniCartList").hide();
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
	function confirmDeal(id){
		if(confirm("您将遵守诚信协议，并和卖家线下交易？")){
			//ajax生成订单
			$.ajax({  
				  type : "post",  
				  url : "/cshopping/is_bought_product",  
				  data : "id="+id,  
				  async : false,  
				  success : function(data){
								var rs=$.parseJSON(data);
								if(rs.code){
									alert(rs.message);
								}
								else {
									$.post("/cshopping/buy_product",
											{id:id},
											function(data){
												var rs=$.parseJSON(data);
												if(rs.code) {alert(rs.message);window.location.reload();}
												else{alert(rs.message);}
											}
									);
								}
							}
			 });
		}
	}
	function login(){
		var url = arguments[0] ? arguments[0] : "self";
		if($("#miniLogin_username").val() && $("#miniLogin_pwd").val()){
			var type=check_type($("#miniLogin_username").val());
			if(!type){ alert("请使用邮箱或手机登录！");return;}
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
						if(rs.code) {window.location="/";}
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
	function AutoResizeImage(maxWidth,maxHeight,objImg){
		var img = new Image();
		img.src = objImg.src;
		var hRatio;
		var wRatio;
		var Ratio = 1;
		var w = img.width;
		var h = img.height;
		wRatio = maxWidth / w;
		hRatio = maxHeight / h;
		if (maxWidth ==0 && maxHeight==0){
		Ratio = 1;
		}else if (maxWidth==0){
		if (hRatio<1) Ratio = hRatio;
		}else if (maxHeight==0){
		if (wRatio<1) Ratio = wRatio;
		}else if (wRatio<1 || hRatio<1){
		Ratio = (wRatio<=hRatio?wRatio:hRatio);
		}
		if (Ratio<1){
		w = w * Ratio;
		h = h * Ratio;
		}
		objImg.height = h;
		objImg.width = w;
	}
	function get_mini_cart(){
		$.get("/cshopping/get_mini_cart",
			function(data){
				var rs=$.parseJSON(data);
				$("#cart_list").text("");
				var total=0;
				for(var product in rs){
					$("#cart_list").append('<li><a href="/shopping/product?id='+rs[product].p_id+'" target="_blank"><img src="'+rs[product].p_images+'"/><span class="width120 mini-span">'+rs[product].p_title+'</span></a><span class="width50 color-red mini-span">￥'+rs[product].p_price+'</span><input class="del-bt" type="button" value="x" onclick="removeFromCart(\''+rs[product].p_id+'\')"/></li>');
					total+=parseFloat(rs[product].p_price);
				}
				if(total>0)
				$("#cart_list").append('<li style="border:none;"><span class="width120 mini-total">合计：<font color="red">￥'+total+'</font></span><a href="/shopping/cart" target="_blank" class="goto-cart-bt"> 去购物车交易</a></li>');
				else $("#cart_list").append('购物车中还没有商品，赶紧抢购吧！');
			}
		);
	}
	function removeFromCart(id){
		$("#cart_list").html("数据加载中，请稍后...");
		$.post("/cshopping/removeFromCart",
			{'id':id},
			function(data){
				var rs=$.parseJSON(data);
				if(rs.code) {
					get_mini_cart();
				}else alert(rs.message);
			}
		);
	}
