<link rel="stylesheet" href="/assets/css/index.css" type="text/css">
<script src="/assets/js/unslider.min.js"></script>
<script>
	$(function() {
		var slidey=$('#slider').unslider();
		var data = slidey.data('unslider');
		$('#previous').click(function(){
			data.prev();
		});
		$('#next').click(function(){
			data.next();
		});
		$('.products .floor .floor-head .filter ul li:last-child').css({border:"none"});
		/*
		$(".products .floor .lists .box").mouseover(function(){
			$(this).children(".product-info").show();
		});*/
	});
</script>
<div class="admin-main">
</div>