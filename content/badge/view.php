<?php
namespace content\badge;


class view
{
	public static function config()
	{
		\dash\data::page_title(T_('Badge list'));
		\dash\data::badgeList(\lib\badge::list());
	}
}
?>