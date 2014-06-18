<link rel="stylesheet" href="/assets/css/admin.css" type="text/css">
<ul class="admin-left">
	<li class="l1">用户管理</li>
	<li class="<?=(isset($adminNaviUsers     ) && $adminNaviUsers     ) ? 'cur' : '' ?>" onclick="window.location='/admin/users'">全部用户<span id="new_orders_num" class="new_orders_num">0</span></li>
	<li class="l1">分类管理</li>
	<li class="<?=(isset($adminNaviCats     ) && $adminNaviCats     ) ? 'cur' : '' ?>" onclick="window.location='/admin/cats'">全部分类</li>
	<li class="<?=(isset($adminNaviAddCat     ) && $adminNaviAddCat     ) ? 'cur' : '' ?>" onclick="window.location='/admin/addCat'">添加分类</li>
</ul>