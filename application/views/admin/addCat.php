<script src="/assets/js/admin.js"></script>
<script>
$(document).ready(function(){
});
</script>
<div class="admin-main">
	添加
	<div><--二级分类-->
		<form method="post" action="/cadmin/addNewCat" enctype="multipart/form-data">
			<select name="cat">
				<?php foreach($categories as $item):?>
				<option value="<?=$item->cat_id?>"><?=$item->cat_name?></option>
				<?php endforeach;?>
			</select>
			<input type="hidden" name="type" value="2"/>
			<input type="text" name="catname" placeholder="新二级分类"/>
			<input type="text" name="property" placeholder="属性"/>
			<input type="file" name="image" accept="image/*"/>
			<input type="submit" value="添加"/>
		</form>
	</div>
	<div><--一级分类-->
		<form method="post" action="/cadmin/addNewCat" enctype="multipart/form-data">
			<input type="hidden" name="type" value="1"/>
			<input type="text" name="catname" placeholder="新一级分类"/>
			<input type="text" name="property" placeholder="属性"/>
			<input type="file" name="image" accept="image/*"/>
			<input type="submit" value="添加"/>
		</form>
	</div>
</div>