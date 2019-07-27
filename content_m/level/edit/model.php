<?php
namespace content_m\level\edit;


class model
{
	public static function post()
	{
		$post =
		[
			'title'       => \dash\request::post('title'),
			'lm_group_id' => \dash\request::post('lm_group_id'),
			'sort'        => \dash\request::post('sort'),
			'type'        => \dash\request::post('type'),
		];

		$file = \dash\app\file::upload_quick('file1');

		if($file)
		{
			$post['file'] = $file;
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