<?php
namespace content_m\badge\edit;


class controller
{
	public static function routing()
	{
		\dash\permission::access('aOfficeEdit');
	}
}
?>