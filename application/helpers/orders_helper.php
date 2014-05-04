<?php
	/**获取唯一订单号
	 * Gets a prefixed unique identifier based on the current time in microseconds.
	 */
	function build_order_no()
	{
		return date('Ymd').substr(implode(NULL, array_map('ord', str_split(substr(uniqid(), 7, 13), 1))), 0, 8);
	}
?>

