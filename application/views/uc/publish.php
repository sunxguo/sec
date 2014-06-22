<link rel="stylesheet" href="/assets/css/uc.css" type="text/css">
<link rel="stylesheet" href="/assets/kindEditor/themes/default/default.css" />
<script charset="utf-8" src="/assets/kindEditor/kindeditor-min.js"></script>
<script charset="utf-8" src="/assets/kindEditor/lang/zh_CN.js"></script>
<script charset="utf-8" src="/assets/js/jquery.form.js"></script>
<script>
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
	});
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
				$(a).each(function(index) {
					var val = unescape(a[index]);
					if(val!="")$("#property").append('<dd class="propertyitem">'+val+'</dd><input type="hidden" value="false"/>');
				});
				var  obj = $('\<script\>$(document).ready(function(){'+
					'$(".propertyitem").click(function(){'+
						'$(this).toggleClass("check");'+
						'if($(this).next().val()=="false"){ '+
							'filter($(this).text());'+
							'$(this).next().val("true");'+
						'}else{'+
							'r_filter($(this).text());'+
							'$(this).next().val("false");'+
						'}'+
					'});'+
				'});\</script\>');
				$("#property").append(obj);
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
</script>
<div class="uc">
	<?php require("uc-left.php");?>
	<div class="uc-main">
		<div class="uc-header">
			<h3>发布我的二手商品</h3>
		</div>
		
		<div class="uc-publish clearfix">
			<form method="post" action="/cuc/publish_product" enctype="multipart/form-data">
				<div class="images" id="product_images"></div>
				<input type="hidden" name="img_count" id="img_count" value="0"/>
				<div class="upload" onclick="add_new_img()">+ 增加物品照片</div><font color="red">*</font><第一张默认为该商品<font color="red">封面</font>,图片大小不要超过<font color="red">1M</font>>
				<div class="product-info">
					<ul>
						<li><span>发布人：<font color="red">*</font></span> <?=$_SESSION['name']?></li>
						<li><span>类别：<font color="red">*</font></span>
							<select name="cat" id="cat">
								<?php foreach($cat as $item):?>
								<option value="<?=$item->cat_id?>"><?=$item->cat_name?></option>
								<?php endforeach;?>
							</select>
							<select name="subcat" id="subcat">
								<?php foreach($fscat as $item):?>
								<option value="<?=$item->cat_id?>"><?=$item->cat_name?></option>
								<?php endforeach;?>
							</select>
						</li>
						<li><span>属性：</span>
							<dl id="property" class="property">
							</dl>
							<input type="hidden" id="product_property" name="property"/>
						</li>
						<li style="clear:both;"><span>成色：<font color="red">*</font></span>
							<select name="new">
								<option value="0">--选择--</option>
								<option value="100">全新</option>
								<option value="95">95成新</option>
								<option value="9">9成新</option>
								<option value="85">85成新</option>
								<option value="8">8成新</option>
							</select>
						</li>
						<li><span>卖价：<font color="red">*</font></span><input name="price" type="number"/>&nbsp;元</li>
						<li><span>原价：</span><input name="oriprice" type="number"/>&nbsp;元</li>
						<li><span>电话：</span>
							<?php if(isset($_SESSION['phone']) && $_SESSION['phone']!=""){
									echo  $_SESSION['phone']; }else{ ?>
								未留该<<font color="red">重要信息</font>>可以去<a href="/uc/info"><font color="blue">个人资料</font></a>添加
							<?php }?>
						</li>
						<li><span>QQ：<font color="red">*</font></span>
							<?php if(isset($_SESSION['qq']) && $_SESSION['qq']!=""){
									echo  $_SESSION['qq']; }else{ ?>
								未留该<<font color="red">重要信息</font>>可以去<a href="/uc/info"><font color="blue">个人资料</font></a>添加
							<?php }?>
						</li>
						<li><span>Email：</span>
							<?php if(isset($_SESSION['email']) && $_SESSION['email']!=""){
									echo  $_SESSION['email']; }else{ ?>
								未留该<<font color="red">重要信息</font>>可以去<a href="/uc/info"><font color="blue">个人资料</font></a>添加
							<?php }?>
						</li>
						<li><span>交易地点：<font color="red">*</font></span><input name="address" type="text" placeholder="请选择公共场合"/></li>
						<li><span>标题：<font color="red">*</font></span><input name="title" type="text"/></li>
						<li><span>状态：</span>
							<input name="position" type="radio" value="true" class="radio" checked="true"/>马上发布
							<input name="position" type="radio" value="false" class="radio"/>保存到仓库
						</li>
						<li>
							<span>详细描述：<font color="red">*</font></span>
							（越详细越容易受到青睐，如转让原因、物品来源、可否议价、如何交易、物品亮点/瑕疵等方面。）
						</li>
						<textarea name="description"></textarea>
						<li>
							<input type="submit" value="提交" class="confirm_bt"/>
						</li>
					</ul>
				</div>
			</form>
		</div>
	</div>
</div>