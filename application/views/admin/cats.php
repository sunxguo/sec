<script src="/assets/js/admin.js"></script>
<div class="admin-main">
	<ul class="cats">
		<li class="list-header">
			<span class="c1">分类名</span>
			<span class="c2">图标</span>
			<span class="c3">属性</span>
			<span class="c4">操作</span>			
		</li>
		<?php foreach($categories as $cat):?>
		<!--一级分类   start-->
		<li>
			<form method="post" action="/cadmin/saveCat" enctype="multipart/form-data">
				<span class="c1 t_l"><?=$cat->cat_name?></span>
				<span class="c2">
					<img src="<?=$cat->cat_img?>" onclick="$('#img<?=$cat->cat_id?>').click();"/>
					<input type="file" name="img" id="img<?=$cat->cat_id?>" style="display:none;"/>
					<input type="hidden" name="id" value="<?=$cat->cat_id?>"/>
				</span>
				<span class="c3"><input id="property<?=$cat->cat_id?>" name="property" value="<?=$cat->cat_property?>"/></span>
				<span class="c4">
					<input value="删除" type="button" class="delete" onclick="del_cat('<?=$cat->cat_id?>');"/> 
					<input value="保存" type="submit" class="save"/>
				</span>
			</form>
		</li>
		<!--一级分类   end-->
		<?php foreach($cat->subcat as $scat):?>
		<!--二级分类   start-->
		<li class="subcat">
			<form method="post" action="/cadmin/saveCat" enctype="multipart/form-data">
				<span class="c1 t_l"><?=$scat->cat_name?></span>
				<span class="c2">
					<img src="<?=$scat->cat_img?>" onclick="$('#img<?=$scat->cat_id?>').click();"/>
					<input type="file" name="img" id="img<?=$scat->cat_id?>" style="display:none;"/>
					<input type="hidden" name="id" value="<?=$scat->cat_id?>"/>
				</span>
				<span class="c3"><input id="property<?=$scat->cat_id?>" name="property" value="<?=$scat->cat_property?>"/></span>
				<span class="c4">
					<input value="删除" type="button" class="delete" onclick="del_cat('<?=$scat->cat_id?>');"/> 
					<input value="保存" type="submit" class="save"/>
				</span>
			</form>
		</li>
		<!--二级分类   end-->
		<?php endforeach;?>
		<?php endforeach;?>
	</ul>
</div>