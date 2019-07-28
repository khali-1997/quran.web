<?php
namespace content_lms\group\home;


class view
{
	public static function config()
	{
		\content_lms\group\main::group();

		$level = \lib\app\lm_level::public_group_list(\dash\request::get('id'));

		\dash\data::levelList($level);

	}
}
?>