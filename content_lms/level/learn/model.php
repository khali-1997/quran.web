<?php
namespace content_lms\level\learn;


class model
{
	public static function post()
	{
		if(\dash\request::post('ActionType') === 'showvideo')
		{
			\lib\app\lm_star::level_learn('showvideo', \dash\request::get('id'));
		}

		\dash\redirect::pwd();
	}
}
?>
