<?php
namespace content_m\badge\add;


class controller
{
	public static function routing()
	{
		\dash\permission::access('mBadgeAdd');
	}
}
?>