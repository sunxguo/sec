<script charset="utf-8" src="/assets/js/uc.js"></script>
<ul class="uc-left">
	<li class="l1">我是买家</li>
	<li class="<?=(isset($ucNaviPOrders     ) && $ucNaviPOrders     ) ? 'cur' : '' ?>" onclick="window.location='/uc/purchaser_orders'">订单管理<!--<span id="new_orders_num" class="new_orders_num">0</span>--></li>
	<li class="l1">我是卖家</li>
	<li class="<?=(isset($ucNaviSOrders     ) && $ucNaviSOrders     ) ? 'cur' : '' ?>" onclick="window.location='/uc/seller_orders'">订单管理</li>
	<li class="<?=(isset($ucNaviProducts     ) && $ucNaviProducts     ) ? 'cur' : '' ?>" onclick="window.location='/uc/products'">所有商品</li>
	<li class="<?=(isset($ucNaviPublish     ) && $ucNaviPublish     ) ? 'cur' : '' ?>" onclick="window.location='/uc/publish'">发布商品</li>
	<li class="l1">账户管理</li>
	<li class="<?=(isset($ucNaviInfo     ) && $ucNaviInfo     ) ? 'cur' : '' ?>" onclick="window.location='/uc/info'">个人资料</li>
	<li class="<?=(isset($ucNaviMessages     ) && $ucNaviMessages     ) ? 'cur' : '' ?>" onclick="window.location='/uc/messages'">消息管理</li>	
</ul>