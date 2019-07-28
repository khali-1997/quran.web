<?php
namespace content_lms\level\exam;


class view
{
	public static function config()
	{
		$loadLevel = \lib\app\lm_level::public_load_level(\dash\request::get('id'));
		\dash\data::loadLevel($loadLevel);

		$userstar = \lib\app\lm_star::user_level_star(\dash\request::get('id'));
		\dash\data::userStar($userstar);

		$question = \lib\app\lm_question::public_load('exam', \dash\request::get('id'));

		\dash\data::questionList($question);


	}
}
?>