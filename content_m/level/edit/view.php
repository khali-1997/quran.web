<?php
namespace content_m\level\edit;


class view
{
	public static function config()
	{
		\dash\data::page_title(T_("Edit learn level"));
		\dash\data::page_desc(' ');
		\dash\data::page_pictogram('edit');

		\dash\data::badge_link(\dash\url::this());
		\dash\data::badge_text(T_('Back to level list'));

		$id     = \dash\request::get('id');
		$result = \lib\app\lm_level::get($id);
		if(!$result)
		{
			\dash\header::status(403, T_("Invalid level id"));
		}

		\dash\data::dataRow($result);

		\dash\data::lmGroupList(\lib\app\lm_group::site_list());
		\dash\data::typeList(\lib\app\lm_level::type_list());
	}
}
?>