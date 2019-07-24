<?php
namespace content_m\level\add;


class model
{
	public static function post()
	{
		$post =
		[
			'title'         => \dash\request::post('title'),
			'learngroup_id' => \dash\request::get('gid'),
		];

		$result = \lib\app\learnlevel::add($post);

		if(\dash\engine\process::status())
		{
			if(isset($result['id']))
			{
				\dash\redirect::to(\dash\url::this(). '/edit?gid='. \dash\request::get('gid'). '&id='.$result['id']);
			}
			else
			{
				\dash\redirect::to(\dash\url::this());
			}
		}

	}
}
?>