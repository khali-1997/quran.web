<?php
namespace content_m\magazine\add;

class view
{
	public static function config()
	{
		$myTitle   = T_("Add new magazine");
		$myDesc    = T_("Posts can contain keyword and category with title and descriptions.");

		$myBadgeLink = \dash\url::this();
		$myBadgeText = T_('Back to list of magazine');

		\dash\data::listCats(\dash\app\term::cat_list());


		\dash\data::page_title($myTitle);
		\dash\data::page_desc($myDesc);

		\dash\data::badge_text($myBadgeText);
		\dash\data::badge_link($myBadgeLink);

		\content_m\magazine\main\view::myDataType();
	}
}
?>