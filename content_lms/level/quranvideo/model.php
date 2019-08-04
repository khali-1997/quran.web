<?php
namespace content_lms\level\quranvideo;


class model
{
	public static function post()
	{
		if(!\dash\user::id())
		{
			\dash\notif::error(T_("Please login to continue"));
			return false;
		}

		if(\dash\engine\process::status())
		{
			\dash\redirect::to(\dash\url::this(). '/result?id='. \dash\request::get('id'));
		}

	}
}
?>
