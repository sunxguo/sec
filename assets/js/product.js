$(document).ready(function(){
	$('.orders-info .status').each(function() {
		//alert(converStatus($(this).text()));
		$(this).html(converStatus($(this).text()));
	});
});
function converStatus(status){
	var cn_status="";
	switch(status){
		case "0":  
		cn_status="<font color='green'>未被预订</font>";
		break;
		case "1":
		cn_status="<font color='blue'>已被预订</font>";
		break;
		case "2":
		cn_status="<font color='black'>已成交</font>";
		break;
		case "3":
		cn_status="<font color='red'>交易失败</font>";
		break;
	}
	return cn_status;
}
function del_product(id){
	if(confirm("确定删除？")){
		$.post("/cuc/delete_product",
			{'id':id},
			function(data){
				var rs=$.parseJSON(data);
				if(rs.code) {
					alert(rs.message);
					window.location.reload();
				}else alert(rs.message);
			}
		);
	}
}
function shel_product(id,status){
	$.post("/cuc/shel_product",
		{'id':id,'status':status},
		function(data){
			var rs=$.parseJSON(data);
			if(rs.code) {
				alert(rs.message);
				window.location.reload();
			}else alert(rs.message);
		}
	);
}