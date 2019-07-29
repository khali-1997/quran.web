<?php
namespace content_lms\level\home;

class controller
{

	public static function routing()
	{
		\dash\redirect::to(\dash\url::here());
	}
}
?>