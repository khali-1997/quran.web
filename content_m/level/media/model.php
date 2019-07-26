<?php
namespace content_m\level\media;


class model
{
	public static function post()
	{

		if(\dash\request::post('removeFile'))
		{
			$post =	['file' => null];
		}
		else
		{
			$file = \dash\app\file::upload_quick('file1');

			if($file)
			{
				$post['file'] = $file;
			}
			else
			{
				\dash\notif::error(T_("Plese upload a file"));
				return false;
			}
		}

		\lib\app\lm_level::edit($post, \dash\request::get('id'));

		if(\dash\engine\process::status())
		{
			// \dash\redirect::to(\dash\url::this());
			\dash\redirect::pwd();
		}

	}
}
?>