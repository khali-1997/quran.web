<?php
namespace content_lms\home;


class view
{
	public static function config()
	{
		\dash\data::page_title(T_("Learning mechanism system"));

		\dash\data::page_pictogram('info');

		$groupList = \lib\app\lm_group::public_list();
		\dash\data::groupList($groupList);
	}
}
?>