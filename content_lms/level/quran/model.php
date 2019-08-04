<?php
namespace content_lms\level\quran;


class model
{
	public static function post()
	{
		if(!\dash\user::id())
		{
			\dash\notif::error(T_("Please login to continue"));
			return false;
		}

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

		if(\dash\engine\process::status())
		{
			\dash\redirect::to(\dash\url::this(). '/result?id='. \dash\request::get('id'));
		}

	}
}
?>
