<?php
namespace content_lms\level\result;

class controller
{

	public static function routing()
	{
		if(!\dash\user::login())
		{
			\dash\redirect::to(\dash\url::kingdom(). '/enter?referer='. \dash\url::pwd());
			return;
		}
	}
}
?>