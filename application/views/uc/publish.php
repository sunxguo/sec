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
		$("#subcat").html("");
		get_subcat($("#cat  option:selected").val());
		$("#cat").change(function(){
			$("#subcat").html("");
			get_subcat($("#cat  option:selected").val());
		});
	});
	function get_subcat(cat){
		$.get("/cuc/get_subCat",{cat:cat},
					function(data){
						var obj = eval(data);
						$(obj).each(function(index) {
							var val = obj[index];
							$("#subcat").append("<option value='"+val.cat_id+"'>"+val.cat_name+"</option>");
							//alert(val.cat_id + " " + val.cat_fid + " " + val.cat_name);
						});
					}
		);
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
					'<input name="image" type="file" id="file'+img_count+'" style="display:none;" accept="image/*">'+
					'<input name="count" type="hidden" value="'+img_count+'"/>'+
					'</form></div>';
		$("#product_images").append(new_img);
		$("#file"+img_count).click();
		$("#img_count").val(img_count);
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
				<div class="upload" onclick="add_new_img()">+ 增加物品照片</div><第一张默认为封面>
				<div class="product-info">
					<ul>
						<li><span>发布人：</span> <?=$_SESSION['name']?></li>
						<li><span>类别：</span>
							<select name="cat" id="cat">
								<?php foreach($cat as $item):?>
								<option value="<?=$item->cat_id?>"><?=$item->cat_name?></option>
								<?php endforeach;?>
							</select>
							<select name="subcat" id="subcat">
								<option>手机</option>
								<option>电脑</option>
							</select>
						</li>
						<li><span>成色：</span>
							<select name="new">
								<option value="0">--选择--</option>
								<option value="100">全新</option>
								<option value="95">95成新</option>
								<option value="9">9成新</option>
								<option value="85">85成新</option>
								<option value="8">8成新</option>
							</select>
						</li>
						<li><span>卖价：</span><input name="price" type="number"/>&nbsp;元</li>
						<li><span>原价：</span><input name="oriprice" type="number"/>&nbsp;元</li>
						<li><span>电话：</span>
							<?php if(isset($_SESSION['phone']) && $_SESSION['phone']!=""){
									echo  $_SESSION['phone']; }else{ ?>
								未留<<font color="red">重要信息</font>>可以去<a href="/uc/info"><font color="blue">个人资料</font></a>添加
							<?php }?>
						</li>
						<li><span>QQ：</span>
							<?php if(isset($_SESSION['qq']) && $_SESSION['qq']!=""){
									echo  $_SESSION['qq']; }else{ ?>
								未留<<font color="red">重要信息</font>>可以去<a href="/uc/info"><font color="blue">个人资料</font></a>添加
							<?php }?>
						</li>
						<li><span>Email：</span>
							<?php if(isset($_SESSION['email']) && $_SESSION['email']!=""){
									echo  $_SESSION['email']; }else{ ?>
								未留<<font color="red">重要信息</font>>可以去<a href="/uc/info"><font color="blue">个人资料</font></a>添加
							<?php }?>
						</li>
						<li><span>交易地点：</span><input name="address" type="text" placeholder="请选择公共场合"/></li>
						<li><span>标题：</span><input name="title" type="text"/></li>
						<li><span>状态：</span>
							<input name="position" type="radio" value="true" class="radio" checked="true"/>马上发布
							<input name="position" type="radio" value="false" class="radio"/>保存到仓库
						</li>
						<li>
							<span>详细描述：</span>
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