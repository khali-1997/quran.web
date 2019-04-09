<?php
namespace content_m\magazine\edit;

class model
{
	public static function post()
	{
		$myType = \dash\request::get('type');
		switch ($myType)
		{
			case 'page':
				\dash\permission::access('cpPageEdit');
				break;

			case 'help':
				\dash\permission::access('cpHelpCenterEdit');
				break;

			case 'post':
			default:
				\dash\permission::access('cpPostsEdit');
				break;
		}

		$posts = \content_m\magazine\main\model::getPost();

		if(!$posts || !\dash\engine\process::status())
		{
			return false;
		}

		$post_detail = \dash\app\posts::edit($posts);

		if(\dash\engine\process::status())
		{
			\dash\redirect::pwd();
		}
	}
}
?>
