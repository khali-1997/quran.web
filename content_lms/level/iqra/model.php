<?php
namespace content_lms\level\iqra;


class model
{
	public static function post()
	{
		$file = \dash\app\file::upload_quick('file1');

		if($file)
		{
			\lib\app\lm_audio::add_new($file, \dash\request::get('id'));
		}
		else
		{
			\dash\notif::error(T_("Please upload a file"));
			return false;
		}


		if(\dash\engine\process::status())
		{
			\dash\redirect::to(\dash\url::this(). '/result?id='. \dash\request::get('id'));
		}
	}
}
?>
