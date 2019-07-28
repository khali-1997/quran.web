<?php
namespace content_lms\level\learn;


class view
{
	public static function config()
	{
		$loadLevel = \lib\app\lm_level::public_load_level(\dash\request::get('id'));
		\dash\data::loadLevel($loadLevel);

		$userstar = \lib\app\lm_star::user_level_star(\dash\request::get('id'));
		\dash\data::userStar($userstar);


	}
}
?>