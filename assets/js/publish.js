var editor;
KindEditor.ready(function(K) {
	editor = K.create('textarea[name="description"]', {
		uploadJson : '/assets/kindEditor/php/upload_json.php',
		fileManagerJson : '/assets/kindEditor/php/file_manager_json.php',
		allowFileManager : true,
		width : '880px',
		height:'300px',
		resizeType:1,
		imageTabIndex:1,
		items : [
				'undo', 'redo', '|', 'justifyleft', 'justifycenter', 'justifyright',
				'justifyfull', 'fontname', 'fontsize', '|', 'forecolor', 'hilitecolor', 'bold',
				'italic', 'underline', 'strikethrough', 'lineheight', '|', 'image', 'multiimage',
				'flash', 'media', 'insertfile', 'table', 'hr', 'emoticons', 'link', 'unlink'
				]
	});
});

function handler(catcount){
	$("#pro"+catcount).toggleClass("check");
	if($("#pro"+catcount).next().val()=="false"){ 
		filter($("#pro"+catcount).text());
		$("#pro"+catcount).next().val("true");
	}else{
		r_filter($("#pro"+catcount).text());
		$("#pro"+catcount).next().val("false");
	}
}
$(document).ready(function(){
	get_property($("#cat  option:selected").val());
	get_property($("#subcat  option:selected").val());
	$("#cat").change(function(){
		update_subcat();
		$("#property").html("");
		get_property($("#cat  option:selected").val());
		get_property($("#subcat  option:selected").val());
		$("#product_property").val("");
	});
	$("#subcat").change(function(){
		$("#property").html("");
		get_property($("#cat  option:selected").val());
		get_property($("#subcat  option:selected").val());
		$("#product_property").val("");
	});
	/*
	$(".propertyitem").click(function(){
		$(this).toggleClass("check");
		if($(this).next().val()=="false"){ 
			filter($(this).text());
			$(this).next().val("true");
			
		}else{
			r_filter($(this).text());
			$(this).next().val("false");
		}
		//alert($("#product_property").val());
	});*/
});
function update_subcat(){
	$("#subcat").html("");
	get_subcat($("#cat  option:selected").val());
}
function get_subcat(cat){
/*
	$.get("/cuc/get_subCat",{cat:cat},
		function(data){
			var obj = eval(data);
			$(obj).each(function(index) {
				var val = obj[index];
				$("#subcat").append("<option value='"+val.cat_id+"'>"+val.cat_name+"</option>");
				//alert(val.cat_id + " " + val.cat_fid + " " + val.cat_name);
			});
		}
	);*/
	$.ajax({
		type: "GET",            //http请求方式
		url: "/cuc/get_subCat",    //服务器段url地址
		data: "cat=" + cat,           //发送给服务器段的数据
		dataType: "json", //告诉JQuery返回的数据格式
		success:
			function(data){
				var obj = eval(data);
				$(obj).each(function(index) {
					var val = obj[index];
					$("#subcat").append("<option value='"+val.cat_id+"'>"+val.cat_name+"</option>");
					//alert(val.cat_id + " " + val.cat_fid + " " + val.cat_name);
				});
			}, //定义交互完成，并且服务器正确返回数据时调用的回调函数
		async: false
	});
}
function get_property(cat){
/*
	$.get("/cuc/get_property",{cat:cat},
		function(data){
			data=data.replace(/\s+/g,"")
			var a=data.split(",");
			$(a).each(function(index) {
				var val = unescape(a[index]);
				if(val!="")$("#property").append('<dd class="propertyitem">'+val+'</dd><input type="hidden" value="false"/>');
			});
		}
	);*/
	
	$.ajax({
		type: "GET",            //http请求方式
		url: "/cuc/get_property",    //服务器段url地址
		data: "cat=" + cat,           //发送给服务器段的数据
		dataType: "", //告诉JQuery返回的数据格式
		success:
			function(data){
				data=data.replace(/\s+/g,"")
				var a=data.split(",");
				var pro_count=0;
				$(a).each(function(index) {
					var val = unescape(a[index]);
					if(val!=""){
						$("#property").append('<dd class="propertyitem" id="pro'+cat+pro_count+'" onclick="handler(\''+cat+pro_count+'\');">'+val+'</dd><input type="hidden" value="false"/>');
						pro_count++;
					}
				});
				//var  obj = $('function handler(catcount){ $("#pro"+catcount).toggleClass("check"); if($("#pro"+catcount).next().val()=="false"){ filter($("#pro"+catcount).text()); $("#pro"+catcount).next().val("true"); }else{ r_filter($("#pro"+catcount).text()); $("#pro"+catcount).next().val("false"); } }');
				//$("#property").append(obj);
			}, //定义交互完成，并且服务器正确返回数据时调用的回调函数
		async: false
	});
}
var img_count=0;
function upload_img(form_id){
		$(form_id).ajaxSubmit({
			success: function (data) {
				var result=$.parseJSON(data);
				$("#wrapper"+result.num).empty();
				if(result.code){
					var new_img='<img id="img'+img_count+'" src="'+result.message+'">'+
								'<input name="img_url[]" value="'+result.message+'" type="hidden"/>';
					$("#wrapper"+result.num).append(new_img);
				}else{
					alert(result.message);
				}
			},
			url: "/cuc/upload_img",
			data: $(form_id).formSerialize(),
			type: 'POST',
			beforeSubmit: function () {
				$(form_id).prev().attr("src","/assets/img/tools/loading.gif")
				//$('#ajax_upload_message').html('正在努力上传图片，请稍候...');
				//interval = loop_delimiter("正在努力上传图片，请稍候", 'ajax_upload_message');
			}
		});
		return false;
}
function add_new_img(){
	img_count++;
	var new_img='<div id="wrapper'+img_count+'" class="pwrapper">'+
				'<img id="img'+img_count+'" src="/assets/img/uc/upload.png" class="img_backdrop" onclick="upload_img(\'#form'+img_count+'\');"/>'+
				'<form id="form'+img_count+'" method="post" action="/cuc/upload_img" enctype="multipart/form-data">'+
				'<input onchange="return upload_img(\'#form'+img_count+'\')" name="image" type="file" id="file'+img_count+'" style="display:none;" accept="image/*">'+
				'<input name="count" type="hidden" value="'+img_count+'"/>'+
				'</form></div>';
	$("#product_images").append(new_img);
	$("#file"+img_count).click();
	$("#img_count").val(img_count);
}
function filter(name){
	var new_filter=($("#product_property").val()=="")?name:$("#product_property").val()+','+name;
	$("#product_property").val(new_filter);
}
function r_filter(name){
	var a=$("#product_property").val().split(",");
	var b=new Array();
	for(i=0;i<a.length;i++)
	{
		if(a[i]!=name) b[i]=a[i];
	}
	var c=b.join(",");
	$("#product_property").val(c);
}