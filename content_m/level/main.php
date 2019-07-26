<?php
namespace content_m\level;


class main
{
	public static function view()
	{
		\dash\data::badge_link(\dash\url::this());
		\dash\data::badge_text(T_('Back to level list'));

		$id     = \dash\request::get('id');
		$result = \lib\app\lm_level::get($id);
		if(!$result)
		{
			\dash\header::status(403, T_("Invalid level id"));
		}

		\dash\data::dataRow($result);

	}
}
?>