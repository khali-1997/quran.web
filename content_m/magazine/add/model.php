<?php
namespace content_m\magazine\add;


class model
{
	public static function post()
	{
		$posts = \content_m\magazine\main\model::getPost();

		if(!$posts || !\dash\engine\process::status())
		{
			return false;
		}

		$post_detail = \dash\app\posts::add($posts);

		if(\dash\engine\process::status() && isset($post_detail['post_id']))
		{
			\dash\redirect::to(\dash\url::this(). '/edit?id='. $post_detail['post_id']);
			return;
		}

		if(\dash\engine\process::status())
		{
			\dash\redirect::pwd();
		}
	}
}
?>
