<?php
namespace content_lms\level\quranvideo;


class model
{
	public static function post()
	{
		if(\dash\request::post('ActionType') === 'listenfirst')
		{
			\lib\app\lm_star::level_quran('listenfirst', \dash\request::get('id'));

		}
		elseif(\dash\request::post('ActionType') === 'listensecond')
		{
			\lib\app\lm_star::level_quran('listensecond', \dash\request::get('id'));

		}
		elseif(\dash\request::post('ActionType') === 'debate')
		{
			\lib\app\lm_star::level_quran('debate', \dash\request::get('id'));
		}

		\dash\redirect::pwd();
	}
}
?>
