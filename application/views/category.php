<div class="side-cat">
	<ul>
	<?php foreach($cat as $item):?>
		<li class="cat">
			<a class="cat-tit"><?=$item->cat_name?></a>
			<span class="arrow icon-common"></span>
			<span class="showPos"><i></i></span>
			<div class="subCat">
				<dl class="lists">
					<?php foreach($item->subcat as $i):?>
						<dd>
							<a href="/shopping?cat=<?=$item->cat_id?>&scat=<?=$i->cat_id?>">
								<img src="/assets/img/cate/tm.jpg"/>
								<?=$i->cat_name?>
							</a>
						</dd>
					<?php endforeach;?>
				</dl>
			</div>
		</li>
	<?php endforeach;?>
	</ul>
</div>