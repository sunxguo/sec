$(document).ready(function(){
/*
	$("#miniCart").mouseover(function(){
		$("#miniCartBt").addClass("mini-cart-on");
		$("#miniCartList").show();
		get_cart();
	});
	$("#miniCart").mouseout(function(){
		$("#miniCartBt").removeClass("mini-cart-on");
		$("#miniCartList").hide();
	});*/
	
		
});	

function del_cat(id){
	if(confirm("确定删除该分类？")){
		$.post("/cadmin/deleteCat",
				{id:id},
				function(data){
					var rs=$.parseJSON(data);
					if(rs.code) {window.location.reload();}
					else{alert(rs.message);}
				}
		);
	}
}
function save_cat(id){
	$.post("/cadmin/saveCat",
			{
				id:id,
				property:$("#property"+id).val()
			},
			function(data){
				var rs=$.parseJSON(data);
				if(rs.code) {window.location.reload();}
				else{alert(rs.message);}
			}
	);
}