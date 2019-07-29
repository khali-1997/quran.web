<?php
namespace content_m\audio\edit;


class controller
{
	public static function routing()
	{
		\dash\permission::access('aOfficeEdit');
	}
}
?>