<?php
namespace content_m\level\exam;


class model
{
	public static function post()
	{

		$post          = [];
		$post['title'] = \dash\request::post('title');
		$post['opt1']  = \dash\request::post('opt1');
		$post['opt2']  = \dash\request::post('opt2');
		$post['opt3']  = \dash\request::post('opt3');
		$post['opt4']  = \dash\request::post('opt4');
		$post['lm_level_id'] = \dash\request::get('id');

		\lib\app\lm_question::add($post);

		if(\dash\engine\process::status())
		{
			\dash\redirect::pwd();
		}

	}
}
?>