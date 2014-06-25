<div class="side-cat">
	<ul>
	<?php foreach($cat as $item):?>
		<li class="cat">
			<a href="/shopping?cat=<?=$item->cat_id?>" class="cat-tit"><?=$item->cat_name?></a>
			<span class="arrow icon-common"></span>
			<span class="showPos"><i></i></span>
			<div class="subCat">
				<dl class="lists">
					<?php foreach($item->subcat as $i):?>
						<dd>
							<a href="/shopping?cat=<?=$item->cat_id?>&scat=<?=$i->cat_id?>">
								<img src="<?=$i->cat_img?>"/>
								<?=$i->cat_name?>
							</a>
						</dd>
					<?php endforeach;?>
				</dl>
			</div>
		</li>
	<?php endforeach;?>
	</ul>
	<img src="/assets/img/index/side.jpg" width="230px" height="78px">
</div>