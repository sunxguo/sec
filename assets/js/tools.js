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
	//让指定的DIV始终显示在屏幕正中间   
	function setDivCenter(divId){  
		var top = ($(window).height() - $(divId).height())/2;   
		var left = ($(window).width() - $(divId).width())/2;   
		var scrollTop = $(document).scrollTop();   
		var scrollLeft = $(document).scrollLeft();   
		$(divId).css( { position : 'absolute', 'top' : top + scrollTop, left : left + scrollLeft } ).show(600);  
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
	//搜索
	function search(){
		var p_name="";
		var p_listed="";
		if($("#type").val()!=undefined){
			p_name=$("#p_name").val();
			if($("#p_listed option:selected").val()!=undefined){
				p_listed=$("#p_listed option:selected").val()!="all"?"&listed="+$("#p_listed option:selected").val():"";
			}
			location.href="/merchant/"+$("#type").val()+"?name="+p_name+p_listed;
		}
		else{
		alert("没有商品可搜索！");}
		
	}
	//单个商品上架
	function shelve(p_id){
		var checked = [];
		checked.push(p_id);
		if(checked.length > 0){
			$.post("/merchant/shelve",{'checked':checked},function(data){alert(data);location.href = "/merchant/"+$("#type").val();});
		}else{
			alert("请先选择要上架的商品！");
		}
	}
	//单个商品下架
	function offShelve(p_id){
		var checked = [];
		checked.push(p_id);
		if(checked.length > 0){
			$.post("/merchant/offShelve",{'checked':checked},function(data){alert(data);location.href = "/merchant/"+$("#type").val();});
		}else{
			alert("请先选择要下架的商品！");
		}
	}
function logout(){
	$.get("/users/user_logout",
		function(data){
			alert(data);
			location.reload();}
		);
		
}
	//提交代码
	function submit_code(){
		
	}
	