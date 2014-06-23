<link rel="stylesheet" href="/assets/css/uc.css" type="text/css">
<link rel="stylesheet" href="/assets/kindEditor/themes/default/default.css" />
<script charset="utf-8" src="/assets/kindEditor/kindeditor-min.js"></script>
<script charset="utf-8" src="/assets/kindEditor/lang/zh_CN.js"></script>
<script charset="utf-8" src="/assets/js/jquery.form.js"></script>
<script charset="utf-8" src="/assets/js/publish.js"></script>

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
							<?php if(isset($_SESSION['phone']) && $_SESSION['phone']!="" && $_SESSION['phone']!=0){
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