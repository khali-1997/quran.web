<?php
namespace content_lms\level\quran;


class model
{
	public static function post()
	{
		if(\dash\request::post('ActionType') === 'listenfirst')
		{
			\dash\notif::warn(\dash\request::post('ActionType'));

		}
		elseif(\dash\request::post('ActionType') === 'listensecond')
		{
			\dash\notif::warn(\dash\request::post('ActionType'));

		}
		elseif(\dash\request::post('ActionType') === 'debate')
		{
			\dash\notif::warn(\dash\request::post('ActionType'));
		}
	}
}
?>
